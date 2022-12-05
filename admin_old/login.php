

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../assets/css/main.css" rel="stylesheet" />
    <link href="../assets/css/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <title>Login - Admin</title>
</head>
<body>
<section class="material-half-bg">
    <div class="cover"></div>
</section>
<section class="login-content">
    <div class="logo">
        <h1>Admin</h1>
    </div>
    <div class="login-box">
        <form class="login-form" action="login.php" method="POST">
            <h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i>LOGIN</h3>
            <div class="form-group">
                <label class="control-label" for="email">Email Address</label>
                <input class="form-control" type="email" id="username" name="username" placeholder="Email address">
            </div>
            <div class="form-group">
                <label class="control-label" for="password">Password</label>
                <input class="form-control" type="password" id="password" name="password" placeholder="Password">
            </div>
            <!-- <div class="form-group">
                <div class="utility">
                    <div class="animated-checkbox">
                        <label>
                            <input type="checkbox" name="remember"><span class="label-text">Remember me</span>
                        </label>
                    </div>
                </div>
            </div> -->
            <div class="form-group btn-container">
                <button class="btn btn-primary btn-block" type="submit"><i class="fa fa-sign-in fa-lg fa-fw"></i>SIGN IN</button>
            </div>
        </form>
    </div>
</section>

<?php 
    session_start ();
    require_once "../db/db.php";
        if ( isset($_REQUEST['username'], $_REQUEST['password']) ) {
            $a = $_REQUEST['username'];
            $b = $_REQUEST['password'];

            $res = mysqli_query($conn,"SELECT * FROM users where username ='$a' AND password='$b'");
            $result=mysqli_fetch_array($res);
            if($result)
            {
                session_regenerate_id();
                $_SESSION['loggedin'] = TRUE;
                $_SESSION['name'] = $_POST['username'];
                $_SESSION["login"]="1";
                header("location:index.php");
            }
            else	
            {
                
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit;
                
            }
        }
    ?>
<script src="../assets/js/js/jquery-3.2.1.min.js" type="text/javascript"></script>
<script src="../assets/js/js/popper.min.js" type="text/javascript"></script>
<script src="../assets/js/js/bootstrap.min.js" type="text/javascript"></script>
<script src="../assets/js/js/main.js" type="text/javascript"></script>
<script src="../assets/js/js/plugins/pace.min.js" type="text/javascript"></script>
</body>
</html>