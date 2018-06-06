<?php

include 'config.php';
$id = $_POST['id'];
$password = sha1($_POST['password']);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_POST["password"] === $_POST["confirm_password"]) {
    $sql = "UPDATE users SET password='$password' WHERE id='$id';";
}

if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conn->error;
}

$conn->close();

?>