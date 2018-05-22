<?php

include "config.php";

$email = $_POST["email"];
$name = $_POST["name"];
$password = sha1($_POST["password"]);
$type = $_POST["type"];


$query_login = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
$query_social_login = "SELECT * FROM users WHERE email = '$email'";

$message_200 = "Success";
$message_user_403 = "Wrong Credentials";
$message_401 = "Unauthorized";
$message_user_404 = "No Users";

if ($conn) {
    //login facebook
    if ($type == 1) {
        $items = getUser($conn, $query_social_login);
        if ($items != []) {
            if ($items[0]['statuses_id'] == 1) {
                jsonResponse(201, $message_200, "Almost There!", "Your application to Red Camp is still pending\n\nIf you have not submitted your 'O'level 2018 entry proof, please do so to redcamp@np.edu.sg\n\nThank you for your patience!", $items);
            } else if ($items[0]['statuses_id'] == 3) {
                jsonResponse(203, $message_200, "Oops Sorry!", "Your application to Red Camp has been rejected as you did not meet the requirements to join. We apologize for any inconveniences caused and we hope to see you in the near future!", $items);
            } else {
                jsonResponse(200, $message_200, "$email", "$name", $items);
            }
        } else {
            jsonResponse(404, $message_user_404, "$email", "$name", null);
        }
    } else if ($type == 2) {
        $items = getUser($conn, $query_social_login);
        if ($items != []) {
            if ($items[0]['statuses_id'] == 1) {
                jsonResponse(201, $message_200, "Almost There!", "Your application to Red Camp is still pending\n\nIf you have not submitted your 'O'level 2018 entry proof, please do so to redcamp@np.edu.sg\n\nThank you for your patience!", $items);
            } else if ($items[0]['statuses_id'] == 3) {
                jsonResponse(203, $message_200, "Oops Sorry!", "Your application to Red Camp has been rejected as you did not meet the requirements to join. We apologize for any inconveniences caused and we hope to see you in the near future!", $items);
            } else {
                jsonResponse(200, $message_200, "$email", "$name", $items);
            }
        } else {
            jsonResponse(404, $message_user_404, "$email", "$name", null);
        }
    } else if ($type == 3) {
        $items = getUser($conn, $query_login);
        if ($items != []) {
            if ($items[0]['statuses_id'] == 1) {
                jsonResponse(201, $message_200, "Almost There!", "Your application to Red Camp is still pending\n\nIf you have not submitted your 'O'level 2018 entry proof, please do so to redcamp@np.edu.sg\n\nThank you for your patience!", $items);
            } else if ($items[0]['statuses_id'] == 3) {
                jsonResponse(203, $message_200, "Oops Sorry!", "Your application to Red Camp has been rejected as you did not meet the requirements to join. We apologize for any inconveniences caused and we hope to see you in the near future!", $items);
            } else {
                jsonResponse(200, $message_200, "$email", "$name", $items);
            }
        } else {
            jsonResponse(404, $message_user_404, "$email", "$name", null);
        }
    }
} else {
    jsonResponse(401, $message_user_401, "", "", null);
}

function jsonResponse($status, $status_message, $display_title, $display_message, $data) {
    $response['status'] = $status;
    $response['message'] = $status_message;
    $response['display_title'] = $display_title;
    $response['display_message'] = $display_message;
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

function checkEmail($conn, $query) {
    $resultset = mysqli_query($conn, $query) or die(json_encode($response["error"] = mysqli_error($conn)));

    return $resultset;
}

/*
     * To change this license header, choose License Headers in Project Properties.
     * To change this template file, choose Tools | Templates
     * and open the template in the editor.
     */

    