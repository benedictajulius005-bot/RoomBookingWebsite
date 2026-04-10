<?php
session_start();
include("connection.php");

/* ================= REGISTER ================= */
if(isset($_POST['register'])){

    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");

    if(mysqli_num_rows($check) > 0){
        $error = "Email already exists.";
    } else {

        $sql = "INSERT INTO users (full_name, email, password)
        VALUES ('$full_name', '$email', '$password')";

        if(mysqli_query($conn, $sql)){
            $_SESSION['success'] = "Registration successful! Please login.";
        } else {
            $error = "Registration failed.";
        }
    }
}

/* ================= LOGIN ================= */
if(isset($_POST['login'])){

    $email = $_POST['email'];
    $password = $_POST['password'];

    $result = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    $user = mysqli_fetch_assoc($result);

    if($user && password_verify($password, $user['password'])){
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['full_name'] = $user['full_name'];

        header("Location: index.php");
        exit();
    } else {
        $error = "Invalid email or password.";
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Account - Royal Hotel</title>

    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">

    <style>
        .auth-box{
            background:white;
            padding:30px;
            border-radius:10px;
            box-shadow:0 5px 20px rgba(0,0,0,0.1);
        }
    </style>
</head>

<body>

    <header class="header_area">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light">
                <a class="navbar-brand logo_h" href="index.html">
                    <img src="image/Logo.png" alt="">
                </a>
            </nav>
        </div>
    </header>

    <section class="section_gap">
        <div class="container">
            <div class="row justify-content-center">

                <div class="col-lg-5">

                    <div class="auth-box mb-5">
                        <h3 class="text-center">Register</h3>

                        <?php if(isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
                        <?php if(isset($_SESSION['success'])){ 
                            echo "<div class='alert alert-success'>".$_SESSION['success']."</div>";
                            unset($_SESSION['success']);
                        } ?>

                        <form method="POST">
                            <input type="text" name="full_name" class="form-control mb-3" placeholder="Full Name" required>
                            <input type="email" name="email" class="form-control mb-3" placeholder="Email" required>
                            <input type="password" name="password" class="form-control mb-3" placeholder="Password" required>

                            <button type="submit" name="register" class="btn theme_btn button_hover w-100">
                                Create Account
                            </button>
                        </form>
                    </div>

                    <div class="auth-box">
                        <h3 class="text-center">Login</h3>

                        <form method="POST">
                            <input type="email" name="email" class="form-control mb-3" placeholder="Email" required>
                            <input type="password" name="password" class="form-control mb-3" placeholder="Password" required>

                            <button type="submit" name="login" class="btn theme_btn button_hover w-100">
                                Login
                            </button>
                        </form>
                    </div>

                </div>

            </div>
        </div>
    </section>

    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

</body>
</html>