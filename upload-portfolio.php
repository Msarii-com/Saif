<?php 
// Initialize the session
session_start();
 

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) && !isset($_SESSION["username"]) === true){
    header("location: login.php");
    exit;
}

include('common/db-connection.php');
if(isset($_POST['submit'])){
    // $id = mysqli_real_escape_string($conn,$_POST['category']);
    $portfolio_name = mysqli_real_escape_string($conn,$_POST['portfolio_name']);
    $category = mysqli_real_escape_string($conn,$_POST['category']);
    $image = $_FILES['picture']['name'];
    $image_temp = $_FILES['picture']['tmp_name'];
    $random_degit = rand(0000000,99999999);
    $new_image = $random_degit.$image;

   
     // echo $category;
     // echo $portfolio_name;
     // echo $new_image;
    if($image==""){

        $insert = "INSERT INTO portfolio(name,category) VALUES('$portfolio_name','$category') ";
        
         if(mysqli_query($conn,$insert)) {
         echo"<script>alert('portfolio updated')</script>";
         echo"<script>window.open('portfolio-grid.php','_self')</script>"; 
          }
    }
    
    else{                  
        move_uploaded_file($image_temp,"assets/img/uploaded/$new_image");
        $insert = "INSERT INTO portfolio(name,category,img_url) VALUES('$portfolio_name','$category','$new_image') "; 
          if(mysqli_query($conn,$insert)){
            // echo"<script>alert('portfolio uploaded')</script>"; 
              echo"<script>window.open('portfolio-grid.php','_self')</script>";                    
      }             
    }


}



?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Required Meta Tags Always Come First -->
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

        <!-- Title -->
        <title>Upload Portfolio</title>

        <!-- Favicon -->
        <link rel="shortcut icon" href="./favicon.ico" />

        <!-- Font -->
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet" />

        <!-- CSS Implementing Plugins -->
        <link rel="stylesheet" href="./assets/vendor/bootstrap-icons/font/bootstrap-icons.css" />
        <link rel="stylesheet" href="./assets/vendor/hs-mega-menu/dist/hs-mega-menu.min.css" />

        <!-- CSS Front Template -->
        <link rel="stylesheet" href="./assets/css/theme.min.css" />
        <style type="text/css">
.hero-image {
  background-image: url("assets/img/uploadz.jpg");
  height: 500px;
  background-position: center;
  background-repeat: no-repeat;
  background-size: 100%;
  position: relative;
}
            * {
  box-sizing: border-box;
}

input[type=text], select, textarea {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  resize: vertical;
}

label {
  padding: 12px 12px 12px 0;
  display: inline-block;
}

input[type=submit] {
  background-color: #3598DB;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  width: 25%;
  margin-top:10px; 
  text-align: center;
}

input[type=submit]:hover {
  background-color: #45a049;
}

.container_form {
  margin-top:30px;
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
}

.col-25 {
  float: left;
  width: 25%;
  margin-top: 6px;
}

.col-75 {
  float: left;
  width: 75%;
  margin-top: 6px;
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}

input[type="file"].custom {
  border: 0;
  clip: rect(0, 0, 0, 0);
  height: 1px;
  overflow: hidden;
  padding: 0;
  position: absolute !important;
  white-space: nowrap;
  width: 1px;
}
/* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
@media screen and (max-width: 600px) {
  .col-25, .col-75, input[type=submit] {
    width: 100%;
    margin-top: 0;
  }
}
        </style>
    </head>
    <!-- Header -->
    <?php include('common/header.php') ?>
    <!-- Header -->

    <body>
        
        <!-- ========== MAIN CONTENT ========== -->
        <main id="content" role="main" >
            <div class="content-space-t-3 content-space-t-lg-5 content-space-b-2 content-space-b-lg-3 hero-image ">
                <!-- Hero -->
                <div class="text-center "></div>
            </div>
            <!-- End Hero -->
               
           <!-- form  -->
          

                <div class="container_form container">
                    <h2 style="text-align: center;">Upload Portfolio</h2>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-25">
                                <label for="fname">Portfolio Name</label>
                            </div>
                            <div class="col-75">
                                <input type="text" id="fname" name="portfolio_name" placeholder="Portfolio name.." required="" />
                            </div>
                        </div>
                        <!-- <div class="row">
                            <div class="col-25">
                                <label for="lname">Last Name</label>
                            </div>
                            <div class="col-75">
                                <input type="text" id="lname" name="lastname" placeholder="Your last name.." />
                            </div>
                        </div> -->
                        <div class="row">
                            <div class="col-25">
                                <label for="country">Category</label>
                            </div>
                            <div class="col-75">
                                <select id="category" name="category" required>
                                    <option value="">Category</option>
                                    <option value="branding">Branding</option>
                                    <option value="product">Product</option>
                                    <option value="design">Design</option>
                                    <option value="illustration">Illustration</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-25">
                                <label for="subject">Picture</label>
                            </div>
                            <div class="col-75">
                                <!-- <textarea id="subject" name="subject" placeholder="Write something.." style="height: 200px;"></textarea> -->
                                <input type="file" name="picture" accept="image/*" required >
                            </div>
                        </div>
                        <div class="row">
                            <center><input type="submit" name="submit" value="Submit" style="" / ></center>
                        </div>
                    </form>
                </div>

           <!-- End form  -->
            <!-- End Card Grid -->
        </main>
        <!-- ========== END MAIN CONTENT ========== -->

        <!-- ========== FOOTER ========== -->

        <!-- ========== END FOOTER ========== -->

        <!-- ========== SECONDARY CONTENTS ========== -->
        <!-- Sign Up -->
        <div class="modal fade" id="signupModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <!-- Header -->
                    <div class="modal-close">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <!-- End Header -->

                    <!-- Body -->
                    <div class="modal-body">
                        <!-- Log in -->
                        <div id="signupModalFormLogin" style="display: none; opacity: 0;">
                            <!-- Heading -->
                            <div class="text-center mb-7">
                                <h2>Log in</h2>
                                <p>
                                    Don't have an account yet?
                                    <a
                                        class="js-animation-link link"
                                        href="javascript:;"
                                        role="button"
                                        data-hs-show-animation-options='{
                         "targetSelector": "#signupModalFormSignup",
                         "groupName": "idForm"
                       }'
                                    >
                                        Sign up
                                    </a>
                                </p>
                            </div>
                            <!-- End Heading -->

                            <div class="d-grid gap-2">
                                <a class="btn btn-white btn-lg" href="#">
                                    <span class="d-flex justify-content-center align-items-center">
                                        <img class="avatar avatar-xss me-2" src="./assets/svg/brands/google-icon.svg" alt="Image Description" />
                                        Log in with Google
                                    </span>
                                </a>

                                <a
                                    class="js-animation-link btn btn-primary btn-lg"
                                    href="#"
                                    data-hs-show-animation-options='{
                       "targetSelector": "#signupModalFormLoginWithEmail",
                       "groupName": "idForm"
                     }'
                                >
                                    Log in with Email
                                </a>
                            </div>
                        </div>
                        <!-- End Log in -->

                        <!-- Log in with Modal -->
                        <div id="signupModalFormLoginWithEmail" style="display: none; opacity: 0;">
                            <!-- Heading -->
                            <div class="text-center mb-7">
                                <h2>Log in</h2>
                                <p>
                                    Don't have an account yet?
                                    <a
                                        class="js-animation-link link"
                                        href="javascript:;"
                                        role="button"
                                        data-hs-show-animation-options='{
                         "targetSelector": "#signupModalFormSignup",
                         "groupName": "idForm"
                       }'
                                    >
                                        Sign up
                                    </a>
                                </p>
                            </div>
                            <!-- End Heading -->

                            <form class="js-validate needs-validation" novalidate>
                                <!-- Form -->
                                <div class="mb-3">
                                    <label class="form-label" for="signupModalFormLoginEmail">Your email</label>
                                    <input type="email" class="form-control form-control-lg" name="email" id="signupModalFormLoginEmail" placeholder="email@site.com" aria-label="email@site.com" required />
                                    <span class="invalid-feedback">Please enter a valid email address.</span>
                                </div>
                                <!-- End Form -->

                                <!-- Form -->
                                <div class="mb-3">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <label class="form-label" for="signupModalFormLoginPassword">Password</label>

                                        <a
                                            class="js-animation-link form-label-link"
                                            href="javascript:;"
                                            data-hs-show-animation-options='{
                       "targetSelector": "#signupModalFormResetPassword",
                       "groupName": "idForm"
                     }'
                                        >
                                            Forgot Password?
                                        </a>
                                    </div>

                                    <input
                                        type="password"
                                        class="form-control form-control-lg"
                                        name="password"
                                        id="signupModalFormLoginPassword"
                                        placeholder="8+ characters required"
                                        aria-label="8+ characters required"
                                        required
                                        minlength="8"
                                    />
                                    <span class="invalid-feedback">Please enter a valid password.</span>
                                </div>
                                <!-- End Form -->

                                <div class="d-grid mb-3">
                                    <button type="submit" class="btn btn-primary form-control-lg">Log in</button>
                                </div>
                            </form>
                        </div>
                        <!-- End Log in with Modal -->

                        <!-- Sign up -->
                        <div id="signupModalFormSignup">
                            <!-- Heading -->
                            <div class="text-center mb-7">
                                <h2>Sign up</h2>
                                <p>
                                    Already have an account?
                                    <a
                                        class="js-animation-link link"
                                        href="javascript:;"
                                        role="button"
                                        data-hs-show-animation-options='{
                         "targetSelector": "#signupModalFormLogin",
                         "groupName": "idForm"
                       }'
                                    >
                                        Log in
                                    </a>
                                </p>
                            </div>
                            <!-- End Heading -->

                            <div class="d-grid gap-3">
                                <a class="btn btn-white btn-lg" href="#">
                                    <span class="d-flex justify-content-center align-items-center">
                                        <img class="avatar avatar-xss me-2" src="./assets/svg/brands/google-icon.svg" alt="Image Description" />
                                        Sign up with Google
                                    </span>
                                </a>

                                <a
                                    class="js-animation-link btn btn-primary btn-lg"
                                    href="#"
                                    data-hs-show-animation-options='{
                       "targetSelector": "#signupModalFormSignupWithEmail",
                       "groupName": "idForm"
                     }'
                                >
                                    Sign up with Email
                                </a>

                                <div class="text-center">
                                    <p class="small mb-0">By continuing you agree to our <a href="#">Terms and Conditions</a></p>
                                </div>
                            </div>
                        </div>
                        <!-- End Sign up -->

                        <!-- Sign up with Modal -->
                        <div id="signupModalFormSignupWithEmail" style="display: none; opacity: 0;">
                            <!-- Heading -->
                            <div class="text-center mb-7">
                                <h2>Sign up</h2>
                                <p>
                                    Already have an account?
                                    <a
                                        class="js-animation-link link"
                                        href="javascript:;"
                                        role="button"
                                        data-hs-show-animation-options='{
                         "targetSelector": "#signupModalFormLogin",
                         "groupName": "idForm"
                       }'
                                    >
                                        Log in
                                    </a>
                                </p>
                            </div>
                            <!-- End Heading -->

                            <form class="js-validate need-validate" novalidate>
                                <!-- Form -->
                                <div class="mb-3">
                                    <label class="form-label" for="signupModalFormSignupEmail">Your email</label>
                                    <input type="email" class="form-control form-control-lg" name="email" id="signupModalFormSignupEmail" placeholder="email@site.com" aria-label="email@site.com" required />
                                    <span class="invalid-feedback">Please enter a valid email address.</span>
                                </div>
                                <!-- End Form -->

                                <!-- Form -->
                                <div class="mb-3">
                                    <label class="form-label" for="signupModalFormSignupPassword">Password</label>
                                    <input type="password" class="form-control form-control-lg" name="password" id="signupModalFormSignupPassword" placeholder="8+ characters required" aria-label="8+ characters required" required />
                                    <span class="invalid-feedback">Your password is invalid. Please try again.</span>
                                </div>
                                <!-- End Form -->

                                <!-- Form -->
                                <div class="mb-3" data-hs-validation-validate-class>
                                    <label class="form-label" for="signupModalFormSignupConfirmPassword">Confirm password</label>
                                    <input
                                        type="password"
                                        class="form-control form-control-lg"
                                        name="confirmPassword"
                                        id="signupModalFormSignupConfirmPassword"
                                        placeholder="8+ characters required"
                                        aria-label="8+ characters required"
                                        required
                                        data-hs-validation-equal-field="#signupModalFormSignupPassword"
                                    />
                                    <span class="invalid-feedback">Password does not match the confirm password.</span>
                                </div>
                                <!-- End Form -->

                                <div class="d-grid mb-3">
                                    <button type="submit" class="btn btn-primary form-control-lg">Sign up</button>
                                </div>

                                <div class="text-center">
                                    <p class="small mb-0">By continuing you agree to our <a href="#">Terms and Conditions</a></p>
                                </div>
                            </form>
                        </div>
                        <!-- End Sign up with Modal -->

                        <!-- Reset Password -->
                        <div id="signupModalFormResetPassword" style="display: none; opacity: 0;">
                            <!-- Heading -->
                            <div class="text-center mb-7">
                                <h2>Forgot password?</h2>
                                <p>Enter the email address you used when you joined and we'll send you instructions to reset your password.</p>
                            </div>
                            <!-- En dHeading -->

                            <form class="js-validate need-validate" novalidate>
                                <div class="mb-3">
                                    <!-- Form -->
                                    <div class="d-flex justify-content-between align-items-center">
                                        <label class="form-label" for="signupModalFormResetPasswordEmail" tabindex="0">Your email</label>

                                        <a
                                            class="js-animation-link form-label-link"
                                            href="javascript:;"
                                            data-hs-show-animation-options='{
                         "targetSelector": "#signupModalFormLogin",
                         "groupName": "idForm"
                       }'
                                        >
                                            <i class="bi-chevron-left small"></i> Back to Log in
                                        </a>
                                    </div>

                                    <input
                                        type="email"
                                        class="form-control form-control-lg"
                                        name="email"
                                        id="signupModalFormResetPasswordEmail"
                                        tabindex="1"
                                        placeholder="Enter your email address"
                                        aria-label="Enter your email address"
                                        required
                                    />
                                    <span class="invalid-feedback">Please enter a valid email address.</span>
                                    <!-- End Form -->
                                </div>

                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary form-control-lg">Submit</button>
                                </div>
                            </form>
                        </div>
                        <!-- End Reset Password -->
                    </div>
                    <!-- End Body -->

                    <!-- Footer -->
                    <div class="modal-footer d-block text-center py-sm-5">
                        <small class="text-cap mb-4">Trusted by the world's best teams</small>

                        <div class="w-85 mx-auto">
                            <div class="row justify-content-between">
                                <div class="col">
                                    <img class="img-fluid" src="./assets/svg/brands/gitlab-gray.svg" alt="Logo" />
                                </div>
                                <!-- End Col -->

                                <div class="col">
                                    <img class="img-fluid" src="./assets/svg/brands/fitbit-gray.svg" alt="Logo" />
                                </div>
                                <!-- End Col -->

                                <div class="col">
                                    <img class="img-fluid" src="./assets/svg/brands/flow-xo-gray.svg" alt="Logo" />
                                </div>
                                <!-- End Col -->

                                <div class="col">
                                    <img class="img-fluid" src="./assets/svg/brands/layar-gray.svg" alt="Logo" />
                                </div>
                                <!-- End Col -->
                            </div>
                        </div>
                        <!-- End Row -->
                    </div>
                    <!-- End Footer -->
                </div>
            </div>
        </div>

        <!-- Go To -->
        <a
            class="js-go-to go-to position-fixed"
            href="javascript:;"
            style="visibility: hidden;"
            data-hs-go-to-options='{
       "offsetTop": 700,
       "position": {
         "init": {
           "right": "2rem"
         },
         "show": {
           "bottom": "2rem"
         },
         "hide": {
           "bottom": "-2rem"
         }
       }
     }'
        >
            <i class="bi-chevron-up"></i>
        </a>
        <!-- ========== END SECONDARY CONTENTS ========== -->

        <!-- JS Global Compulsory  -->
        <script src="./assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

        <!-- JS Implementing Plugins -->
        <script src="./assets/vendor/hs-header/dist/hs-header.min.js"></script>
        <script src="./assets/vendor/hs-mega-menu/dist/hs-mega-menu.min.js"></script>
        <script src="./assets/vendor/hs-show-animation/dist/hs-show-animation.min.js"></script>
        <script src="./assets/vendor/hs-go-to/dist/hs-go-to.min.js"></script>
        <script src="./assets/vendor/hs-nav-scroller/dist/hs-nav-scroller.min.js"></script>
        <script src="./assets/vendor/typed.js/lib/typed.min.js"></script>
        <script src="./assets/vendor/shufflejs/dist/shuffle.js"></script>

        <!-- JS Front -->
        <script src="./assets/js/theme.min.js"></script>

        <!-- JS Plugins Init. -->
        <script>
            (function () {
                // INITIALIZATION OF HEADER
                // =======================================================
                new HSHeader("#header").init();

                // INITIALIZATION OF MEGA MENU
                // =======================================================
                new HSMegaMenu(".js-mega-menu", {
                    desktop: {
                        position: "left",
                    },
                });

                // INITIALIZATION OF SHOW ANIMATIONS
                // =======================================================
                new HSShowAnimation(".js-animation-link");

                // INITIALIZATION OF BOOTSTRAP VALIDATION
                // =======================================================
                HSBsValidation.init(".js-validate", {
                    onSubmit: (data) => {
                        data.event.preventDefault();
                        alert("Submited");
                    },
                });

                // INITIALIZATION OF BOOTSTRAP DROPDOWN
                // =======================================================
                HSBsDropdown.init();

                // INITIALIZATION OF GO TO
                // =======================================================
                new HSGoTo(".js-go-to");

                // INITIALIZATION OF TEXT ANIMATION (TYPING)
                // =======================================================
                HSCore.components.HSTyped.init(".js-typedjs");

                // INITIALIZATION OF NAV SCROLLER
                // =======================================================
                new HsNavScroller(".js-nav-scroller");

                // INITIALIZATION OF SHUFFLE
                // =======================================================
                class ShufflePorfolio {
                    constructor(element) {
                        this.element = element;
                        this.shuffle = new Shuffle(element, {
                            itemSelector: ".js-shuffle-item",
                            speed: 500,
                        });

                        this.addFilterButtons();
                    }

                    addFilterButtons() {
                        const options = document.querySelector(".js-filter-options");
                        if (!options) {
                            return;
                        }

                        const filterButtons = Array.from(options.children);
                        const onClick = this._handleFilterClick.bind(this);
                        filterButtons.forEach((button) => {
                            button.addEventListener("click", onClick, false);
                        });
                    }

                    _handleFilterClick(evt) {
                        const btn = evt.currentTarget.firstElementChild;
                        const isActive = btn.classList.contains("active");
                        const btnGroup = btn.getAttribute("data-group");

                        this._removeActiveClassFromChildren(btn.parentNode.parentNode);

                        let filterGroup;
                        if (isActive) {
                            btn.classList.remove("active");
                            filterGroup = Shuffle.ALL_ITEMS;
                        } else {
                            btn.classList.add("active");
                            filterGroup = btnGroup;
                        }

                        this.shuffle.filter(filterGroup);
                    }

                    _removeActiveClassFromChildren(parent) {
                        const { children } = parent;
                        for (let i = children.length - 1; i >= 0; i--) {
                            children[i].firstElementChild.classList.remove("active");
                        }
                    }
                }

                new ShufflePorfolio(document.querySelector(".js-shuffle"));
            })();
        </script>
    </body>
</html>
