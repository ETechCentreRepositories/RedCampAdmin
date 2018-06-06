<?php
include 'config.php';
$getToken=$_GET['token'];

$query_get_user = "SELECT * FROM users WHERE forgotPassword = '$getToken';";

if($conn){
    $checktoken = CheckToken($conn, $query_get_user);
    if($checktoken != []){
    $user = $checktoken[0];
    $userid = $user['id'];
    ?>
    <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
    <script>
    	function myFunction() {
    var x = document.getElementById("password");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}
    </script>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
    <form action="resetpassword.php" method="post">
        <div class="col-md-8">
            <div class="form-group row">
                <div class="col-md-6">
                    <input id="id" type="hidden"  class="form-control" name="id" value="<?php echo "$userid"; ?>" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="password" class="col-md-4 col-form-label text-md-right">New Password</label>

                <div class="col-md-6">
                    <input id="password" type="password" class="form-control" name="password" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="confirm_password" class="col-md-4 col-form-label text-md-right">Re-enter New Password</label>

                <div class="col-md-6">
                    <input id="confirm_password" type="password" class="form-control" name="confirm_password" required>
                </div>
            </div>
            <br>
            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        Change password
                    </button>
                </div>
            </div>
        </div>
        </form>
    </div>
</div>
    
</body>
</html>
    
    <?php
       
    }else{
        JSONResponse(404, "No users with the corresponding token");
    }
}else{
    JSONResponse(403,"Unauthorised",null);
}


function JSONResponse($status, $status_message, $data) {
    $response['status'] = $status;
    $response['message'] = $status_message;
    $response['result'] = $data;

    $json_response = json_encode($response);
    echo $json_response;
}

function CheckToken($conn, $query) {
    $resultset = mysqli_query($conn, $query) or die(json_encode($response["error"] = mysqli_error($conn)));
    $data = array();
    while ($rows = mysqli_fetch_assoc($resultset)) {
        $data[] = $rows;
    }
    return $data;
}
?>