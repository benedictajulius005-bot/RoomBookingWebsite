<?php
session_start();
include("connection.php");

/* ================= REGISTER ================= */
if(isset($_POST['register'])){

    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // CHECK IF EMAIL EXISTS
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0){
        $error = "Email already exists.";
    } else {

        // INSERT USER (SAFE)
        $stmt = $conn->prepare("INSERT INTO users (full_name, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $full_name, $email, $password);

        if($stmt->execute()){
            $success = "Registration successful! You can now login.";
        } else {
            $error = "Registration failed.";
        }
    }
}

/* ================= LOGIN ================= */
if(isset($_POST['login'])){

    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows == 1){

        $user = $result->fetch_assoc();

        if(password_verify($password, $user['password'])){

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['full_name'] = $user['full_name'];

            header("Location: index.php");
            exit();

        } else {
            $error = "Incorrect password.";
        }

    } else {
        $error = "Email not found.";
    }
}
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Register - Royal Hotel</title>

    <!-- Required meta tags -->
    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="image/favicon.png" type="image/png">
    <title>Royal Hotel</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="vendors/linericon/style.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="vendors/owl-carousel/owl.carousel.min.css">
    <link rel="stylesheet" href="vendors/bootstrap-datepicker/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" href="vendors/nice-select/css/nice-select.css">
    <link rel="stylesheet" href="vendors/owl-carousel/owl.carousel.min.css">
    <!-- main css -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
    

    
</head>

<body>

<!-- HEADER -->
<header class="header_area">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="navbar-brand logo_h" href="index.php">
                <img src="image/Logo.png" alt="">
            </a>
            <div class="collapse navbar-collapse offset">
               <ul class="nav navbar-nav menu_nav ml-auto">

    <li class="nav-item">
        <a class="nav-link" href="index.php">Home</a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="about.php">About us</a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="booking.php">Booking</a>
    </li>

    <li class="nav-item">
        <a class="nav-link active" href="register.php">Register/Login</a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="contact.php">Contact</a>
    </li>

    <?php if(isset($_SESSION['user_id'])): ?>

        <li class="nav-item">
            <a class="nav-link">
                Welcome <?php echo $_SESSION['full_name']; ?>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="logout.php">Logout</a>
        </li>

    <?php endif; ?>

</ul>
            </div>
        </nav>
    </div>
</header>

<!-- BANNER -->
<section class="banner_area">
    <div class="booking_table d_flex align-items-center">
        <div class="overlay bg-parallax"></div>
        <div class="container">
            <div class="banner_content text-center">
                <h2>Create Your Account</h2>
                <p>Join Royal Hotel and manage your bookings easily</p>
            </div>
        </div>
    </div>
</section>

<!-- REGISTER FORM SECTION -->
<section class="section_gap">
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-lg-6">

                <div class="hotel_booking_table p-4 shadow">

                 <h3 class="text-center mb-4" id="formTitle">Register</h3>

                 <?php if(isset($error)): ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php endif; ?>

                <?php if(isset($success)): ?>
                    <div class="alert alert-success"><?php echo $success; ?></div>
                <?php endif; ?>

<!-- REGISTER FORM -->
<form method="POST" id="registerForm">

    <div class="form-group">
        <input type="text" name="full_name"
        class="form-control"
        placeholder="Full Name"
        required>
    </div>

    <div class="form-group">
        <input type="email" name="email"
        class="form-control"
        placeholder="Email Address"
        required>
    </div>

    <div class="form-group">
        <input type="password" name="password"
        class="form-control"
        placeholder="Password"
        required>
    </div>

    <div class="text-center mt-4">
        <button type="submit" name="register"
        class="btn theme_btn button_hover w-100">
        Create Account
    </button>
</div>

</form>

<!-- LOGIN FORM -->
<form method="POST" id="loginForm" style="display:none;">

    <div class="form-group">
        <input type="email" name="email"
        class="form-control"
        placeholder="Email Address"
        required>
    </div>

    <div class="form-group">
        <input type="password" name="password"
        class="form-control"
        placeholder="Password"
        required>
    </div>

    <div class="text-center mt-4">
        <button type="submit" name="login"
        class="btn theme_btn button_hover w-100">
        Login
    </button>
</div>

</form>

<div class="text-center mt-3">
    <p id="toggleText">
        Already have an account?
        <a href="#" onclick="toggleForms()">Login here</a>
    </p>
</div>

</div>
</div>

</div>
</section>

<!--================ start footer Area  =================-->    
<footer class="footer-area section_gap">
    <div class="container">
        <div class="row">
            <div class="col-lg-3  col-md-6 col-sm-6">
                <div class="single-footer-widget">
                    <h6 class="footer_title">About Agency</h6>
                    <p>The world has become so fast paced that people don’t want to stand by reading a page of information, they would much rather look at a presentation and understand the message. It has come to a point </p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="single-footer-widget">
                    <h6 class="footer_title">Navigation Links</h6>
                    <div class="row">
                        <div class="col-4">
                            <ul class="list_style">
                                <li><a href="index.php">Home</a></li>
                                <li><a href="#">Feature</a></li>
                                <li><a href="#">Services</a></li>
                                <li><a href="about.php">Portfolio</a></li>
                            </ul>
                        </div>
                        <div class="col-4">
                            <ul class="list_style">
                                <li><a href="#">Pricing</a></li>
                                
                                <li><a href="contact.php">Contact</a></li>
                            </ul>
                        </div>                                      
                    </div>                          
                </div>
            </div>                          
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="single-footer-widget">
                    <h6 class="footer_title">Newsletter</h6>
                    <p>For business professionals caught between high OEM price and mediocre print and graphic output, </p>     
                    <div id="mc_embed_signup">
                        <form target="_blank" action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&amp;id=92a4423d01" method="get" class="subscribe_form relative">
                            <div class="input-group d-flex flex-row">
                                <input name="EMAIL" placeholder="Email Address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email Address '" required="" type="email">
                                <button class="btn sub-btn"><span class="lnr lnr-location"></span></button>     
                            </div>                                  
                            <div class="mt-10 info"></div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="single-footer-widget instafeed">
                    <h6 class="footer_title">InstaFeed</h6>
                    <ul class="list_style instafeed d-flex flex-wrap">
                        <li><img src="image/instagram/Image-01.jpg" alt=""></li>
                        <li><img src="image/instagram/Image-02.jpg" alt=""></li>
                        <li><img src="image/instagram/Image-03.jpg" alt=""></li>
                        <li><img src="image/instagram/Image-04.jpg" alt=""></li>
                        <li><img src="image/instagram/Image-05.jpg" alt=""></li>
                        <li><img src="image/instagram/Image-06.jpg" alt=""></li>
                        <li><img src="image/instagram/Image-07.jpg" alt=""></li>
                        <li><img src="image/instagram/Image-08.jpg" alt=""></li>
                    </ul>
                </div>
            </div>                      
        </div>
        <div class="border_line"></div>
        <div class="row footer-bottom d-flex justify-content-between align-items-center">
            <p class="col-lg-8 col-sm-12 footer-text m-0"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
<div class="col-lg-4 col-sm-12 footer-social">
    <a href="#"><i class="fa fa-facebook"></i></a>
    <a href="#"><i class="fa fa-twitter"></i></a>
    <a href="#"><i class="fa fa-dribbble"></i></a>
    <a href="#"><i class="fa fa-behance"></i></a>
</div>
</div>
</div>
</footer>
<!--================ End footer Area  =================-->


</script>

<script>
    function toggleForms(){

        var registerForm = document.getElementById("registerForm");
        var loginForm = document.getElementById("loginForm");
        var title = document.getElementById("formTitle");
        var toggleText = document.getElementById("toggleText");

        if(loginForm.style.display === "none" || loginForm.style.display === ""){

            registerForm.style.display = "none";
            loginForm.style.display = "block";
            title.innerText = "Login";
            toggleText.innerHTML =
            'Don\'t have an account? <a href="#" onclick="toggleForms(); return false;">Register here</a>';

        } else {

            registerForm.style.display = "block";
            loginForm.style.display = "none";
            title.innerText = "Register";
            toggleText.innerHTML =
            'Already have an account? <a href="#" onclick="toggleForms(); return false;">Login here</a>';
        }
    }
</script>
</body>
</html>