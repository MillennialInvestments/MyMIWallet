<?php
// Logical definiton of what I mean with the variables
$user = $_SESSION["username"];
//This is just a method I found to get the post data
$request = json_decode(file_get_contents('php://input'), true);
// CHECK IF EVERYTHING IS ALRIGHT - like the tag and so on
if (error) {
    $response = array("status" => "error", "message" => "something went wrong in the preliminary phase");
    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    if ($request[tag] == "new") {
        //Check if the fields are valid (right type for each one of them + the user has access to all of them) - maybe use a checking function to re-use in all the other trades
        if (error) {
            //Manage error like above with new message
        } else {
            //Create new row with the trade
            //If something goes wrong, again, send error. An error-sending function could solve the problem of always copying the same code. Maybe one which gets the name of the error and prints the respective message
            if (error) {
                $response = array("status" => "error", "message" => "Exited with no tag matching");
                header('Content-Type: application/json');
                echo json_encode($response);
            } else {
                //get back the $new_trade_id
                $response = array("status" => "success", "message" => $new_trade_id);
                header('Content-Type: application/json');
                echo json_encode($response);
            }
        }
    } elseif ($request[tag] == "edit") {
        //run a query for $user trades and check if he has the $request["id"] one in his database,
        if (error) {
            //if not, error out - we can manage this better later on
        } else {
            //check if fields are valid
            if (error) {
                //error
            } else {
                //edit the trade with that id of that user
                //Again, check for errors and send to the frontend if something goes wrong
                if (error) {
                    //error
                } else {
                    $response = array("status" => "success", "message" => $request["id"]); //The fact that the message is the old trade id right now doesn't mean anything. It's a "checking" script for now - but can come in handy later
                    header('Content-Type: application/json');
                    echo json_encode($response);
                }
            }
        }
    } elseif ($request[tag] == "delete") {
        //guess what, check for id match again aaaaand
        if (error) {
            //error
        } else {
            //delete the row
            if (error) {
                //something went wrong while accessing the db/deleting the row
            } else {
                $response = array("status" => "success", "message" => $request["id"]); //The fact that the message is the old trade id right now doesn't mean anything. It's a "checking" script for now - but can come in handy later
                header('Content-Type: application/json');
                echo json_encode($response);
                //In the frontend I'm going to delete the row.
            }
        }
    } else {
        //For some weird reason the whole else-if got skipped.
        $response = array("status" => "error", "message" => "Exited with no tag matching");
        header('Content-Type: application/json');
        echo json_encode($response);
    }
}
//! All of the erroring out could be solved with either a function or a try catch, but I wanted to highlight where the breakpoints should be.
