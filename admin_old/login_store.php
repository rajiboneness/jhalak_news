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
            else{
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit;
                
            }
        }
    ?>