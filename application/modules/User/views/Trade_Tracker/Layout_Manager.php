<?php
//! Security issue
//TODO: perform scan to see whether this user has a table and the wallets are available
$cuID                                        = $this->session->userdata('user_id');
$this->db->select('email, username');
$this->db->from('bf_users');
$this->db->where('id', $cuID);
$getUserInfo                                = $this->db->get();
foreach ($getUserInfo->result_array() as $userInfo) {
    $cuEmail                                = $userInfo['email'];
    $cuUsername                                = $userInfo['username'];
}
$tradeForm                                    = trim(file_get_contents('php://input'));
$tradeForm                                    = json_decode($tradeForm, true);

$trade = $tradeForm['trade'];

/**
 * What the response of this api will look like;
 * @var $msg string
 * @var $status '1' | '0' | '2'
 *
 * - 1: Success
 * - 0: Failure
 * - 2: Alternative
 */


function throwMsg($msg, $status = '0')
{

    $response = array('status' => $status, 'message' => $msg);

    header('Content-Type: application/json');
    if ($status == '0') {
        http_response_code(400);
    } else {
        http_response_code(200);
    }
    echo json_encode($response);
    ob_flush();
    flush();
    exit;
}

/**
 * Checks if a string has the possibility of being an array
 */
function strIsArray($str)
{
    return (substr_count($str, '[') == 1 && strpos($str, '[') == 0) && (substr_count($str, ']') == 1 && strrpos($str, '[', -0) == (strlen($str) - 1));
}


/**
 * Checks if a string is a string array
 */
function strIsStrArray($str)
{
    if (strIsArray($str)) {
        foreach (json_decode($str) as $value) {
            if (gettype($value) != 'string') return false;
        }
        return true;
    }
    return false;
}

function checkAndPrepTrade($trade)
{

    //LINE BELOW FIXES A PRINCIPE IN FRONTEND TRADES
    //* REFER TO RULES#1
    if ($trade['closed_ref'] != "-1" && $trade['closed_ref'] != "[]") throwMsg('The trade has meaningless presence of both a closed_ref and a closed_list');

    $checkedTrade = [];

    foreach ($trade as $key => $value) {
        //Here we are checking that the data we get is completely in string format
        if (empty($trade[$key])) {
            $checkedTrade['key'] = '';
        } else {
            if (gettype($value) != 'string') throwMsg('The ' + $key + ' field does not hold a string value: '+ value);

            switch ($key) {
                case 'json_user_fields':
                    if (json_decode($value) == null) throwMsg('The juf field is not valid json: '+ value);
                    break;
                case 'saved_sorting':
                    if (intval($value) == 0) throwMsg('The saved sorting is not a valid integer or is 0: '+ value);
                    break;
                case 'closed_ref':
                    if (intval($value) != 0 && intval($value) < -1) throwMsg('The closed ref is a negative integer: '+ value);
                    break;
                // case 'stats_interpolated_fields':
                //     if (!strIsStrArray($value)) throwMsg('The closed list is not a valid array: '+ value);
                //     break;

                    /*
                    TODO: Do more checking: 
                    - Wallet ownership and whether the given wallet can be edited. 
                    - Valid closed_list ids
                    */
            }
            //Do not include useless keys in the object
            switch ($key) {
                case 'legend':
                case 'id':
                case 'pseudo_id':
                case 'save':
                case 'cancel':
                case 'delete':
                case 'closed_list':
                    //Only the child updates the closed list
                    break;
                default:
                    $checkedTrade[$key] = $value;
            }
        }
    }
    return $checkedTrade;
}

if (empty($tradeForm)) {
    throwMsg('The received obj was empty');
} else {
    switch ($tradeForm['tag']) {
            //For edit and new we are receiving an object which is stripped of the extended juf, but still has irrelevant properties - or properties that should not exist in the db.
        case 'New':
            if (count($this->db->get_where('bf_users_trades', array('id' => $trade['id']))->result_array()) != 0)
                throwMsg('Trade with ' + $trade['id'] + ' already exists');

            if ($trade['pseudo_id'] == $trade['id'])
                throwMsg('New trade contained equal id and pseudoId');

            //Clean all the unnecessary elements and
            //Check the validity of the given trade and create the db tradeobj
            $newTrade = checkAndPrepTrade($trade);

            //Add user information
            $postedTrade = $newTrade;
            $postedTrade['user_id'] = $cuID;
            $postedTrade['user_email'] = $cuEmail;
            $postedTrade['username'] = $cuUsername;

            $parentList = [];
            if ($trade['closed_ref'] != '-1') {
                $parentList = $this->db->get_where('bf_users_trades', array('id' => $trade['closed_ref']))->result_array();
            }

            //Insert the row
            $this->db->insert('bf_users_trades', $tradeData);
            $newTrade['id'] = $newTrade['pseudo_id'] = $this->db->insert_id();

            //The parent trade will have either already appeared or still have to come up.
            if (count($parentList) == 1) {
                //The backend is the only one to up the closed list.
                $childList = json_decode($parentList[0]['closed_list']);
                //The child list won't include the child until this is has been saved to the db, so we can just push it.
                array_push($childList, $newTrade['id']);


                $this->db->set('closed_list', json_encode($childList));
                //We already know this yelds one result
                $this->db->where('id', $trade['closed_ref']);
                $this->db->update('bf_users_trades');
            } else if (count($parentList) > 1) {
                //! Log error
            }



            throwMsg(json_encode($newTrade), '1');

            break;
        case 'Edit':
            if ($trade['id'] == '') throwMsg('Received to-edit trade with no id');
            if ($trade['id'] != $trade['pseudo_id']) throwMsg('Received to-edit trade with no id');
            if ($trade['id'] != $trade['pseudo_id']) throwMsg('Editing non-saved trade');


            $postedTrade = checkAndPrepTrade($trade);
            $postedTrade['user_id'] = $cuID;
            $postedTrade['user_email'] = $cuEmail;
            $postedTrade['username'] = $cuUsername;

            //Edit the trade with the given id in the database
            $this->db->where('id', $trade['id']);
            if (!$this->db->update('bf_users_trades', $postedTrade)) throwMsg('Failed updating the trade in the DB');

            throwMsg(json_encode($postedTrade), '1');
            break;
        case 'Delete':
            //TODO: Move to archived db

            $walkingDead = $this->db->get_where('bf_users_trades', array('id' => $trade['id']))->result_array();

            if (count($walkingDead) == 0) throwMsg('Called trade did not exist anymore: id-' + $trade['id'], '2');
            if ($walkingDead[0]['closed_list'] != '[]') throwMsg("Trying to delete parent trade without having eliminated all of its children");

            $this->db->delete('bf_users_trades', array('id' => $trade['id']));
            $parentList = [];
            if ($trade['closed_ref'] != '-1') {
                $parentList = $this->db->get_where('bf_users_trades', array('id' => $trade['closed_ref']))->result_array();
            }


            //The parent trade will have either already appeared or still have to come up.
            if (count($parentList) == 1) {

                //We can expect the list to be in the right format because we don't allow otherwise - FUTUREBUG
                $childList = json_decode($parentList[0]['closed_list']);

                //! This if should be always true if everything goes as expected
                if (array_search($trade['pseudo_id'], $childList))
                    array_splice(
                        $childList,
                        array_search($trade['pseudo_id'], $childList),
                        1
                    );

                $this->db->set('closed_list', json_encode($childList));
                //We already know this yelds one result
                $this->db->where('id', $trade['closed_ref']);
                $this->db->update('bf_users_trades');
            } else if (count($parentList) > 1) {
                //! Log error
            }

            throwMsg('Trade deleted succesfully', '1');
            break;
        default:
            throwMsg('The tag obj was not of type New|Edit|Delete');
    }
}
?>