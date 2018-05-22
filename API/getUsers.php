<?php

include "config.php";

//type=all  is to get all users (select * from users;)
$query_status_all = "select * from users";
//type=accepted is to get approved users status=1 (select * from users where status = 1;)
$query_status_accepted = "select * from users where status = 1;";
//type=pending is to get pending users status=0 (select * from users where status = 0;)
$query_status_pending = "select * from users where status = 0;";
//type=rejected is to get al rejected users status=2 (select * from users where status = 2;)
$query_status_rejected = "select * from users where status = 2;";


$message_200 = "Success";
$message_user_404 = "no such status type";
$message_401 = "Unauthorized";
$message_no_users = "No Users";


$type = $_GET['type'];

//status=0 is to get pending users
//status=1 is to get accepted users
//status=2 is to get rejected users

if ($conn) {
    if ($type === "all") {
        $items = getUser($conn, $query_status_all);
        if($items!=[]){
        jsonResponse(200, $message_200, $items);
        }
        else{
        jsonResponse(404, $message_no_users, null);
        }
        
    } else if ($type === "accepted") {
        $items = getUser($conn, $query_status_accepted);
       if($items!=[]){
        jsonResponse(200, $message_200, $items);
        }
        else{
        jsonResponse(404, $message_no_users, null);
        }
    } else if ($type === "pending") {
        $items = getUser($conn, $query_status_pending);
        if($items!=[]){
        jsonResponse(200, $message_200, $items);
        }
        else{
        jsonResponse(404, $message_no_users, null);
        }
    } else if ($type === "rejected") {
        $items = getUser($conn, $query_status_rejected);
        if($items!=[]){
        jsonResponse(200, $message_200, $items);
        }
        else{
        jsonResponse(404, $message_no_users, null);
        }
    } else {
        jsonResponse(404, $message_user_404, null);
    }
}else{
     jsonResponse(401, $message_user_401, null);
}

function jsonResponse($status, $status_message, $data) {
    $response['status'] = $status;
    $response['message'] = $status_message;
    $response['users'] = $data;


    $json_response = json_encode($response);
    echo $json_response;
}

function getUser($conn, $query) {
    $resultset = mysqli_query($conn, $query) or die(json_encode($response["error"] = mysqli_error($conn)));

    $data = array();
    while ($rows = mysqli_fetch_assoc($resultset)) {
        $data[] = $rows;
    }
    return $data;
}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

