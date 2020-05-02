<?php
    error_reporting (E_ALL ^ E_NOTICE);
    session_start([
        'cookie_lifetime'=>300,//5 minutes
    ]);
    $error = false;
    // $_SESSION['loggedin']='';

        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING );
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING );
        $fp       = fopen('F:\\Xampp\\htdocs\\HTML WEB\\crud\\data\\user.txt', 'r');
        if( $username && $password ) {
            $_SESSION['loggedin'] = false;
            $_SESSION['user']     = false;
            $_SESSION['role']     = false;
            while ( $data = fgetcsv( $fp ) ){
                if( $data[0] == $username && $data[1] == sha1( $password ) ) {
                    $_SESSION['loggedin'] = true;
                    $_SESSION['user'] = $username;
                    $_SESSION['role'] = $data[2];
                    header('location:index.php');
                }
            }
            if(!$_SESSION['loggedin']) {
                $error = true;
            }
        }

    if(isset($_GET['logout'] ) ) {
        $_SESSION['loggedin'] = false;
        $_SESSION['user'] = false;
        $_SESSION['role'] = false;
        session_destroy();
        header('location:index.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Hello World</title>
        <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Roboto:300,300italic,700,700italic">
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.css">
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/milligram/1.3.0/milligram.css">
        <style>
            body{
                margin-top:30px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="column column-60 column-offset-20">
                    <h2>Simple Auth Example</h2>
                </div>
            </div>
            <div class="row">
                <div class="column column-60 column-offset-20">
                <?php
                    if(true == $_SESSION['loggedin']){
                        echo "Hello Admin, Wellcome!";
                    }else{
                        echo " Hello Stranger, Login Below";
                    }
                ?>
                </div>
            </div>
            <div class="row" style="margin-top: 100px;">
                <div class="column column-60 column-offset-20">
                <?php
                //    echo md5("rabbit"). "<br/>";
                    if($error){
                        echo "<blockquote>Username and Password didn't match</blockquote>";
                    }
                    if(false == $_SESSION['loggedin']):
                ?>
                    <form method="POST">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password">
                        <button style="display:block;" type="submit" class="button-primary" name="submit">Log In</button>
                    </form>
                    <?php
                        else:
                    ?>
                        <form action="auth.php" method="POST">
                        <input type="hidden" name="logout" value="1">
                        <button style="display:block;" type="submit" class="button-primary" name="submit">Log Out</button>
                    </form>
                    <?php
                        endif;
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>