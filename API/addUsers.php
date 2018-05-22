<?php

include "config.php";

$name = $_POST["name"];
$email = $_POST["email"];
$nric = $_POST["nric"];
$dob = $_POST["dob"];
$mobile = $_POST["mobile"];
$school = $_POST["school"];
$diet = $_POST["diet"];
$password = $_POST["password"];
$statuses_id = $_POST["statuses_id"];
$query_insert_user = "INSERT INTO users (name, email, nric, dob, mobile, school, diet_requirements, password, statuses_id) VALUES ('$name', '$email', '$nric', '$dob', '$mobile', '$school', '$diet', '$password', $statuses_id)";

$message_200 = "Success";
$message_401 = "Unauthorized";
$message_400 = "duplicate";
if ($conn) {
    $result = addUser($conn, $query_insert_user);
    if ($result != "") {
        if ($statuses_id == 1) {
            jsonResponse(200, $message_200, $result, "Almost There!", "Thanks! Your Registration is now pending confirmation\n\nPlease email the redcamp@np.edu.sg with your 'O'Level 2018 Entry Proof, showing clearly your name and identification number, to complete your registration",1);
        } else if ($statuses_id == 2) {
            jsonResponse(200, $message_200, $result, "Welcome to Red Camp!", "You Are In!\nMore deets coming through this app as we countdown to the most lit cmap of the year!\nSo, Dont forget to allow notification pop-ups for this RED Camp app!\n\nShare to get your friends on board too!",2);
        } else if ($statuses_id == 3) {
            jsonResponse(200, $message_200, $result, "Oops Sorry!", "Thanks! However, we are unable to accept your registration as RED Camp is open only to students taking their 'O'Level exams in 2018. Come back for it in your 'O'Levels.",3);
        }
    }
} else {
    jsonResponse(401, $message_user_401, null);
}

function jsonResponse($status, $status_message, $data, $display_title, $display_message,$type) {
    $response['status'] = $status;
    $response['message'] = $status_message;
    $response['result'] = $data;
    $response['display_title'] = $display_title;
    $response['display_message'] = $display_message;
    $response['type']= $type;


    $json_response = json_encode($response);
    echo $json_response;
}

function addUser($conn, $query) {
    $resultset = mysqli_query($conn, $query) or die(json_encode($response["error"] = mysqli_error($conn)));

//    $data = array();
//    while ($rows = mysqli_fetch_assoc($resultset)) {
//        $data[] = $rows;
//    }
    return $resultset;
}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */