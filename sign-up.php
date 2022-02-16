<?php
// DB Connection 
include('common/db-connection.php');
 
// Define variables and initialize with empty values
$username = $email = $password = $confirm_password = "";
$username_err = $email_err = $password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    $profile_pic = $_POST['profile_pic'];
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter your username.";
    } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))){
        $username_err = "Username can only contain letters, numbers, and underscores.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    //validate email
     if(empty(trim($_POST["email"]))){
        $email_err = "Please enter your email.";     
     } 
         else{
            $email = trim($_POST["email"]);
         }

    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    
    //  
    echo $username."<br>";
    //  echo $email."<br>";
    //  echo $password."<br>";
    //  echo  $confirm_password."<br>";

    // Check input errors before inserting in database
    if(empty($username_err) && empty($email_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO users (username, email, password, image) VALUES (?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssss", $param_username, $param_email, $param_password, $param_profile);
            
            // Set parameters
            $param_profile = $profile_pic;
            $param_username = $username;
            $param_email = $email;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: login.php");
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
        <title>Register</title>
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
            <h1>Register</h1>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" autocomplete="off">
                
                 
                   <!--  <label for="username">
                        <i class="fas fa-user"></i>
                    </label> -->
                    <input class="mainLoginInput" type="text" name="username" placeholder="&#61447 Username" id="name" maxlength="50" required>
                    <center><span class="text-danger"><?php if (isset($username_err)) echo $username_err; ?></span>
                    </center>

                   <!--  <label for="email">
                        <i class="fas fa-envelope"></i>
                    </label> -->
                    <input class="mainLoginInput" type="email" name="email" placeholder="&#61443 Email" id="email" required>
                    <center><span class="text-danger"><?php if (isset($email_err)) echo $email_err; ?></span>
                    </center>
                    
                   <!--  <label for="password">
                        <i class="fas fa-lock"></i>
                    </label> -->
                    <input class="mainLoginInput" type="password" name="password" placeholder="&#61475 Password" id="password" required>
                    <center><span class="text-danger"><?php if (isset($password_err)) echo $password_err; ?></span></center>
                    
<!-- 
                    <label for="password">
                        <i class="fas fa-lock"></i>
                    </label> -->
                    <input class="mainLoginInput" type="password" name="confirm_password" placeholder="&#61475 Confirm Password" id="password" required>
                    <center><span class="text-danger"><?php if (isset($confirm_password)) echo $confirm_password_err; ?></span></center>
                    
                    <input type="hidden" name="profile_pic" value="assets/img/default_dummy.png">


                <input type="submit" value="Register" name="signup">
            </form>
        </div>
    </body>
</html>