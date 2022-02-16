<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["username"] === true){
    header("location: profile.php");
    exit;
}
 
// Include config file
include('common/db-connection.php');

 
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = $login_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // echo $username;
    // echo $password;
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id, username, password FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;                            
                            
                            // Redirect user to welcome page
                            header("location: profile.php");
                        } else{
                            // Password is not valid, display a generic error message
                            $login_err = "Invalid username or password.";
                        }
                    }
                } else{
                    // Username doesn't exist, display a generic error message
                    $login_err = "Invalid username or password.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Login</title>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
        <link rel="stylesheet" href="style.css">
        <style type="text/css">
            @import "//netdna.bootstrapcdn.com/font-awesome/3.0/css/font-awesome.css";

            .error {color: #FF0000;}
            body{
                 background-image: url("assets/img/loginbanner.png");
  background-position: center;
  background-repeat: no-repeat;
  background-size: 100%;
  position: relative;
            }

@import "//netdna.bootstrapcdn.com/font-awesome/3.0/css/font-awesome.css";

.mainLoginInput{
  height: 40px;
  padding: 0px;
  font-size: 20px;
  margin: 5px 0;
}

.mainLoginInput::-webkit-input-placeholder { 
font-family: FontAwesome;
font-weight: normal;
overflow: visible;
vertical-align: top;
display: inline-block !important;
padding-left: 5px;
padding-top: 2px;
color:#000;
}

.mainLoginInput::-moz-placeholder  { 
font-family: FontAwesome;
font-weight: normal;
overflow: visible;
vertical-align: top;
display: inline-block !important;
padding-left: 5px;
padding-top: 2px;
color: #3498DB;
}

.mainLoginInput:-ms-input-placeholder  { 
font-family: FontAwesome;
font-weight: normal;
overflow: visible;
vertical-align: top;
display: inline-block !important;
padding-left: 5px;
padding-top: 2px;
color: #3498DB;
}
        </style>
    </head>
    <body>
         
        <div class="register">

       
        <h1>Login</h1>
            <?php 
        if(!empty($login_err)){
            echo '<center><div class="text-danger">' . $login_err . '</div></center>';
        }        
        ?>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" autocomplete="off">
                  

                    <input type="text" name="username" placeholder="&#61447 Username" class="mainLoginInput form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                    <center><span class="text-danger"><?php echo $username_err; ?></span></center> 


                    <input type="password" placeholder="&#61475 Password" name="password" class="mainLoginInput form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                    <center><span class="text-danger"><?php echo $password_err; ?></span></center>
                   

                    <input type="submit" value="Login" name="signin">
            </form>
        </div>
    </body>
</html>