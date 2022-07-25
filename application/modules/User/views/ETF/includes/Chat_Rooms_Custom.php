<?php
// Set Page URI Segments
$pageURIA			= $this->uri->segment(1);
$pageURIB			= $this->uri->segment(2);
$pageURIC			= $this->uri->segment(3);
$pageURID			= $this->uri->segment(4);
$pageURIE			= $this->uri->segment(5);
$stockEx			= $pageURIB;
$stockSym			= $pageURIC;

//Get User Information
$currentUserID 					= isset($current_user->id) && ! empty($current_user->id) ? $current_user->id : '';
$currentUserRoleID 				= isset($current_user->role_id) && ! empty($current_user->role_id) ? $current_user->role_id : '';
$currentUserType				= isset($current_user->type) && ! empty($current_user->type) ? $current_user->type : '';
$currentUserUserName			= isset($current_user->username) && ! empty($current_user->username) ? $current_user->username : '';

$curl 				= curl_init();
$curlURL			= 'https://discord.com/api/channels/792943129581191261/messages';
curl_setopt_array($curl, array(
  CURLOPT_URL => $curlURL,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "cache-control: no-cache",
    //~ "Authorization: Bearer qR3usBX+nmaKe1YpNAVem+rGx7itMd3v5TiuyiUTi6HseA6+LEC+lPhygGBm2cjNFutH/ElNRcXApLqRLqs+KS1zXD1B89rab6RjxDEd9Qmqey+8nhO/kMKbOoJUvFkGrJDbm1lD0uPxfpolIbTBqh7vE6qzhwe7Xs9XSdU4w75VzxYgIsn8VC6SrxfDjGM4cqlUslZbLFn3nVrV61/J8gk35G2RpL3LNHzdgulSiuAlkUIo8L9duEAJQyf5+6YO8eLQjAZwIglRVARZRW+PV3/OkatiEhplgFepTane81TY3uo0QW9G1ukRZIg8r2qSZ3Bt7KKjJVBNh46P9fT6GOPlWAx3uEcFmpCuchf0K0cmiCOMp8BLve6kHVVMBtHxBURhFQgSmCzn/pRgrqnfHxhZbDqmifNEVtN/pUm+u0iR6TFYgFKiTfFBqJBJmVvTGbVlzHhFOrX/JD9yEzES1rT1DrNEgK4Z0AyNbAjpGLZEi8+82PLGSmlviFUMJ6tSjsR+5Rj/b+KAqVlIbgTexwSVblLmEhhAU6qn8100MQuG4LYrgoVi/JHHvlw0vm7dIyDxuV7Nro4L4wZVqm8WSodlvqsu0Ko+XJSqmJzAVkO1lnPlRcFMVS8qeStqPKAkEWz3pX+DIlIxILWoUFe1IPEQ5G2X+E0xs2KcoPDCvWQAUdI4WbiX9lL5ivFaIhmX0Z9+LeYKM7roN9X5Xk+c/C5HfpabU2+HF11VqY85nlvNa1EVMmNZd65sxypTUNqs94RxV0T8yN3mqwhuCml3qos83JKa4eqeOXR2X328h2sRlpNABhgLbhKoqbiFBobX7zN3tGe/b1i6cbX0FXSET14+mHx6spbpzAAJObaYRrXLzlLs/guCRn5iqGOnlppqNMoDHvlkeSEZQ0g975o2nOWktkPXGOZ/9gXKe3GJXHMDgVoLJlBioLsM+CVYWqK1oWvUwo0t2hPidvSdEdyOPhNI7itJM6Q2pTWmBKOn0am1uEK9J1mZMNp0qz0TxYcQ5hsizsWW2cWzwqkXV2mR93uTxhp5Wq2GFAkFr5dRdo4+sd1mq8ItOaSSpvUMrIqM+cdhuIyUqlGzQ3L2rwZWcXxSFpIwIeta212FD3x19z9sWBHDJACbC00B75E"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);
$response 			= json_decode($response, true); //because of true, it's in an array
?>
<h3 class="pl-3 pb-3"><?php echo $stockSym; ?> Chat Room - Join the Conversation</h3>
<hr>
<table class="table table-borderless full-width p-3" style="background-color: #E8E8E8; border-radius: 20px;">
	<tbody class="p-3">
		<?php
        $this->db->from('bf_chat_rooms');
        $this->db->where('stock', $stockSym);
        $getMessages		= $this->db->get();
        foreach ($getMessages->result_array() as $messInfo) {
            $date			= $messInfo['date'];
            $time			= $messInfo['time'];
            $message		= $messInfo['message'];
            echo '
			<tr>
				<td><small>' . $time . ':</small> <strong>' . $currentUserUserName . '</strong> ' . $message . '</td>
			</tr>
			';
        };
        ?>
	</tbody>
</table>
<?php
$this->load->view('Community/Stock_Chat');
?>
