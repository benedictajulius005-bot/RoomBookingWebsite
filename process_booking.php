<?php
session_start();
include("connection.php");

$user_id = $_SESSION['user_id'] ?? 1;

$room_id = $_POST['room_id'] ?? '';
$number_of_rooms = $_POST['number_of_rooms'] ?? '';
$adults = $_POST['adults'] ?? '';
$children = $_POST['children'] ?? 0;
$check_in = $_POST['check_in'] ?? '';
$check_out = $_POST['check_out'] ?? '';

if (empty($room_id) || empty($number_of_rooms) || empty($adults) || empty($check_in) || empty($check_out)) {
    $_SESSION['error_message'] = "Please fill all required fields.";
    header("Location: booking.php");
    exit();
}

$prices = [
    1 => 250,
    2 => 200,
    3 => 750,
    4 => 200
];

$price_per_night = $prices[$room_id] ?? 0;

$today = new DateTime();
$today->setTime(0,0,0);
$start = new DateTime($check_in);
$end = new DateTime($check_out);

if ($start < $today) {
    $_SESSION['error_message'] = "You cannot book past dates.";
    header("Location: booking.php");
    exit();
}

$nights = $start->diff($end)->days;

if ($nights <= 0) {
    $_SESSION['error_message'] = "Check-out must be after check-in.";
    header("Location: booking.php");
    exit();
}

$total_price = $price_per_night * $number_of_rooms * $nights;

$sql = "INSERT INTO bookings 
(user_id, room_id, number_of_rooms, adults, children, check_in, check_out, total_price, booking_date)
VALUES 
('$user_id', '$room_id', '$number_of_rooms', '$adults', '$children', '$check_in', '$check_out', '$total_price', NOW())";

if (mysqli_query($conn, $sql)) {
    $_SESSION['success_message'] = "Booking Successful!";
    $_SESSION['total_price'] = $total_price;
} else {
    $_SESSION['error_message'] = "Booking failed. Try again.";
}

header("Location: booking.php");
exit();