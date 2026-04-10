<?php
if(session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<ul class="nav navbar-nav menu_nav ml-auto">

    <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
    <li class="nav-item"><a class="nav-link" href="about.php">About us</a></li>
    <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>

    <?php if(isset($_SESSION['user_id'])): ?>

        <li class="nav-item">
            <a class="nav-link">
                Welcome, <?php echo $_SESSION['full_name']; ?>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="booking.php">Booking</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="logout.php">Logout</a>
        </li>

    <?php else: ?>

        <li class="nav-item">
            <a class="nav-link" href="auth.php">Register / Login</a>
        </li>

    <?php endif; ?>

</ul>