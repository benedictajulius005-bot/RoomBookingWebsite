<?php session_start(); ?>
<?php
$room_id = isset($_GET['room_id']) ? (int)$_GET['room_id'] : 0;
?>
<!doctype html>
<html lang="en">
<head>
    <style>
        .modal {
            display: block;
            position: fixed;
            z-index: 999;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.6);
        }

        .modal-content {
            background: white;
            padding: 30px;
            margin: 15% auto;
            width: 400px;
            border-radius: 10px;
            text-align: center;
            position: relative;
        }

        .close {
            position: absolute;
            right: 15px;
            top: 10px;
            font-size: 20px;
            cursor: pointer;
        }
    </style>

    <meta charset="utf-8">
    <title>Book Room - Royal Hotel</title>

    <!-- SAME CSS AS INDEX -->
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
</head>

<body>
 

   <!--================Header Area =================-->
   <header class="header_area">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light">
            <!-- Brand and toggle get grouped for better mobile display -->
            <a class="navbar-brand logo_h" href="index.php"><img src="image/Logo.png" alt=""></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                <ul class="nav navbar-nav menu_nav ml-auto">
                   <li class="nav-item "><a class="nav-link" href="index.php">Home</a></li> 
                  <?php if(isset($_SESSION['user_id'])): ?>

                            <li class="nav-item">
                                <a class="nav-link">
                                    Welcome <?php echo $_SESSION['full_name']; ?>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="logout.php">Logout</a>
                            </li>

                            
                            
                            <li class="nav-item"><a class="nav-link" href="about.php">About us</a></li>
                            
                            
                            <li class="nav-item active"><a class="nav-link" href="booking.php">Booking</a></li>
                        <?php else: ?>

                            
                            <li class="nav-item"><a class="nav-link" href="about.php">About us</a></li>
                            
                            
                            <li class="nav-item active"><a class="nav-link" href="booking.php">Booking</a></li>
                            <li class="nav-item">
                                <a class="nav-link" href="register.php">Register/Login</a>
                            </li>

                        <?php endif; ?>
                   <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
               </ul>
           </div> 
       </nav>
   </div>
</header>
<!--================Header Area =================-->

<!-- ================= BANNER ================= -->
<section class="banner_area">
    <div class="booking_table d_flex align-items-center">
        <div class="overlay bg-parallax"></div>
        <div class="container">
            <div class="banner_content text-center">
                <h2>Book Your Stay</h2>
                <p>Reserve your room and enjoy luxury experience</p>
            </div>
        </div>
    </div>
</section>

<!-- ================= BOOKING SECTION ================= -->
<section class="section_gap">
    <div class="container">

        <div class="section_title text-center">
            <h2 class="title_color">Room Reservation</h2>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">

                <div class="hotel_booking_table">

                    <form action="process_booking.php" method="POST">

                        <div class="row">

                            <div class="col-md-6 form-group">
                                <label>Room Type</label>
                                <select name="room_id" class="form-control" required>
                                    <option value="">Select Room</option>

                                    <option value="1" <?php if($room_id == 1) echo 'selected'; ?>>
                                        Double Deluxe
                                    </option>

                                    <option value="2" <?php if($room_id == 2) echo 'selected'; ?>>
                                        Single Deluxe
                                    </option>

                                    <option value="3" <?php if($room_id == 3) echo 'selected'; ?>>
                                        Honeymoon Suite
                                    </option>

                                    <option value="4" <?php if($room_id == 4) echo 'selected'; ?>>
                                        Economy Double
                                    </option>
                                </select>
                            </div>

                            <div class="col-md-6 form-group">
                                <label>Number of Rooms</label>
                                <input type="number" name="number_of_rooms" 
                                class="form-control" min="1" required>
                            </div>

                            <div class="col-md-6 form-group">
                                <label>Adults</label>
                                <input type="number" name="adults" 
                                class="form-control" min="1" required>
                            </div>

                            <div class="col-md-6 form-group">
                                <label>Children</label>
                                <input type="number" name="children" 
                                class="form-control" min="0" value="0">
                            </div>

                            <div class="col-md-6 form-group">
                                <label>Check In</label>
                                <input type="date" name="check_in" 
                                class="form-control" required>
                            </div>

                            <div class="col-md-6 form-group">
                                <label>Check Out</label>
                                <input type="date" name="check_out" 
                                class="form-control" required>
                            </div>

                        </div>

                        <div class="text-center mt-4">
                            <button type="submit" 
                            class="btn theme_btn button_hover">
                            Confirm Booking
                        </button>
                    </div>

                </form>

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

<!-- JS FILES -->
<script src="js/jquery-3.2.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<?php if(isset($_SESSION['success_message'])): ?>

    <div id="successModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2 style="color:green;">
                <?php echo $_SESSION['success_message']; ?>
            </h2>
            <p>Total Price: $<?php echo $_SESSION['total_price']; ?></p>
        </div>
    </div>

    <?php 
    unset($_SESSION['success_message']);
    unset($_SESSION['total_price']);
endif; 
?>

<?php if(isset($_SESSION['error_message'])): ?>

    <div id="errorModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2 style="color:red;">
                <?php echo $_SESSION['error_message']; ?>
            </h2>
        </div>
    </div>

    <?php 
    unset($_SESSION['error_message']);
endif; 
?>

<script>
    var closeBtns = document.querySelectorAll(".close");

    closeBtns.forEach(function(btn){
        btn.onclick = function(){
            this.parentElement.parentElement.style.display = "none";
        }
    });
</script>

</body>
</html>