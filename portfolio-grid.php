<?php include('common/db-connection.php');?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Required Meta Tags Always Come First -->
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

        <!-- Title -->
        <title>Portfolio Grid</title>

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
              background-image: url("assets/img/portfolio.png");
              height: 500px;
              background-position: center;
              background-repeat: no-repeat;
              background-size: 100%;
              position: relative;
            }
            
            /* Styling the button */
            /*.btn {
                cursor: pointer;
                border: 1px solid #3498db;
                background-color: transparent;
                height: 50px;
                width: 200px;
                color: #3498db;
                font-size: 1.5em;
                box-shadow: 0 6px 6px rgba(0, 0, 0, 0.6);
            }*/
        </style>
    </head>

    <body>
        <!-- ========== HEADER ========== -->
        <?php include('common/header.php') ?>
        <!--  -->
        <!-- ========== END HEADER ========== -->

        <!-- ========== MAIN CONTENT ========== -->
        <main id="content" role="main">
            <div class="content-space-t-3 content-space-t-lg-5 content-space-b-2 content-space-b-lg-3 hero-image ">
                <!-- Hero -->
                <div class="text-center "></div>
            </div>
            <!-- End Hero -->

            <!-- Card Grid -->
            <div class="container content-space-b-2 content-space-b-lg-3">
                <!-- Nav Scroller -->
                <div class="js-nav-scroller hs-nav-scroller-horizontal mb-7">
                    <span class="hs-nav-scroller-arrow-prev" style="display: none;">
                        <a class="hs-nav-scroller-arrow-link" href="javascript:;">
                            <i class="bi-chevron-left"></i>
                        </a>
                    </span>

                    <span class="hs-nav-scroller-arrow-next" style="display: none;">
                        <a class="hs-nav-scroller-arrow-link" href="javascript:;">
                            <i class="bi-chevron-right"></i>
                        </a>
                    </span>
<?php

    $tab_query = "SELECT * FROM portfolio ";

 ?>
                    <!-- Nav -->
                    <ul class="js-filter-options nav nav-segment nav-pills d-flex mx-auto" style="max-width: 30rem;margin-top: 20px;">
                        <li class="nav-item">
                            <a class="nav-link active" href="javascript:;" data-group="all">All</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="javascript:;" data-group="branding">Branding</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="javascript:;" data-group="product">Product</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="javascript:;" data-group="design">Design</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="javascript:;" data-group="illustration">Illustration</a>
                        </li>
                    </ul>
                    <!-- End Nav -->
                </div>
                <!-- End Nav Scroller -->


                <div class="js-shuffle row row-cols-1 row-cols-sm-2 row-cols-md-3">
                    <?php
                        $pSql = "SELECT * FROM portfolio";
                        $portfolios = mysqli_query($conn, $pSql);
                        // print_r($portfolios);

                        if(mysqli_num_rows($portfolios) > 0) {
                            while($row = mysqli_fetch_assoc($portfolios)) {
                    ?>
                     <div class="js-shuffle-item col mb-5" data-groups='["<?= $row['category'] ?>"]'>
                        <!-- Card -->
                        <a class="card card-flush card-transition" href="#">
                            <img class="card-img-top" src="assets/img/uploaded/<?= $row['img_url'] ?>" alt="Image Description" />
                            <div class="card-body">
                                <span class="card-subtitle text-body"><?= $row['name'] ?></span>
                                <h3 class="card-title"><?= $row['category'] ?></h3>
                            </div>
                        </a>
                        <!-- End Card -->
                    </div>
                    <?php
                            }
                        }
                    ?>
                    

                </div>
                <!-- End Row -->
            </div>
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
