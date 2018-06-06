<?php

include 'config.php';
$email = $_POST['email'];

$query_check_email = "SELECT email FROM users WHERE email = '$email'";

if ($conn) {

    $checkEmail = CheckEmail($conn, $query_check_email);
    if ($checkEmail != []) {
        $user = $checkEmail[0];
        
        $date = getDate();
        $gettoken = "";
        foreach ($date as $item) {
            $gettoken .= $item;
        }
        $gettoken .= $email;
        $token = sha1($gettoken);

        $query_update_email_password_token = "UPDATE users SET forgotPassword = '$token' WHERE email = '$email'";
        
        $storeToken = AddPasswordToken($conn, $query_update_email_password_token);
        if ($storeToken == true) {

            //send email
            $checkemail = SendEmail($email, "Change Password", $token);
            if ($checkemail) {
                JSONResponse(200, "An email has been sent to your email account.", $checkemail);
            }
        } else {
            JSONResponse(400, "Failed to store token", null);
        }
    } else {
        JSONResponse(404, "No such user", null);
    }
} else {
    JSONResponse(403, "Unauthorized", null);
}

function JSONResponse($status, $status_message, $data) {
    $response['status'] = $status;
    $response['message'] = $status_message;
    $response['result'] = $data;

    $json_response = json_encode($response);
    echo $json_response;
}

//To change this license header, choose License Headers in Project Properties.
//To change this template file, choose Tools | Templates
//and open the template in the editor.        
function AddPasswordToken($conn, $query) {
    $resultset = mysqli_query($conn, $query) or die(json_encode($response["error"] = mysqli_error($conn)));
    return $resultset;
}

function SendEmail($email, $subject, $token) {
    $headers = "From: " . "RedCamp <redcamp@np.edu.sg>" . "\r\n";
    $headers .= "Reply-To: " . "RedCamp <redcamp@np.edu.sg>" . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

    $message = "<html><body>";
    $message .= "<h1>Change Password</h1>";
    $message .= "<a href='http://ehostingcentre.com/redcampadmin/API/newpassword.php?token=$token'>Click here to change your password</a>";
   
    $message .= "</body></html>";
    if (mail($email, $subject, $message, $headers)) {
        return true;
    } else {
        return false;
    }
}

function CheckEmail($conn, $query) {
    $resultset = mysqli_query($conn, $query) or die(json_encode($response["error"] = mysqli_error($conn)));
    $data = array();
    while ($rows = mysqli_fetch_assoc($resultset)) {
        $data[] = $rows;
    }
    return $data;
}
