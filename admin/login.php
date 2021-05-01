<?php
session_start();
include_once 'dbh.inc.php';
global $failed_msg, $success_msg;

if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    if(!empty($_POST['aemail'])){
        
        $aemail = $_POST['aemail'];
        $password = $_POST['password'];
        
        $emailCheck = $link->query( "SELECT * FROM admin WHERE aemail = '$aemail' ");
        $rowCount = mysqli_num_rows($emailCheck);
        
        if ($rowCount ==0){
            $failed_msg = '
                    <div class="alert alert-danger" role="alert">
                        Email not exist. 
                    </div>
                ';
        }else{
            $sql = "SELECT aid FROM admin WHERE aemail = '$aemail' and password= '$password'";
            $result = mysqli_query($link,$sql);
            $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
        
            $count = mysqli_num_rows($result);

            if($count == 1) {
            $_SESSION['admin'] = $row['aid'];
            header("location: index.php");
            $success_msg = '<div class="alert alert-danger">
                Login Successful. 
            </div>';
            }else {
                $failed_msg = '<div class="alert alert-danger">
                    Wrong password. 
                </div>';
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Login - FAU Library</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.0/css/all.css">
</head>

<body class="bg-gradient-primary">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9 col-lg-12 col-xl-10">
                <div class="card shadow-lg o-hidden border-0 my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-flex">
								<div class="flex-grow-1 bg-login-image" style="background-image: url(&quot;assets/img/logo.png&quot;);"></div>
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h4 class="text-dark mb-4">Login</h4>
                                    </div>
                                    <form class="admin" method="post">
                                        <?php echo $failed_msg; ?>
                                        <?php echo $success_msg; ?>
                                        <div class="form-group"><input class="form-control form-control-user" type="email" id="aemail" aria-describedby="emailHelp" placeholder="Email" name="aemail"></div>
                                        <div class="form-group"><input class="form-control form-control-user" type="password" id="password" placeholder="Password" name="password"></div>
                                        <button class="btn btn-primary btn-block text-white btn-user" type="submit">Login</button>
                                        <hr>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <script src="assets/js/script.min.js"></script>
</body>

</html>