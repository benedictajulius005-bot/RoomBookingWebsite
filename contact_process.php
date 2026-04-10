<?php
session_start();
include("connection.php");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // CHECK IF USER IS LOGGED IN
    if(isset($_SESSION['user_id'])){

        $user_id = $_SESSION['user_id'];

         $result = mysqli_query($conn, "SELECT full_name, email FROM users WHERE id='$user_id'");
        $row = mysqli_fetch_assoc($result);

        $full_name = $row['full_name'];
        $email = $row['email'];

        $sql = "INSERT INTO messages (user_id, full_name, email, subject, message_text)
                VALUES ('$user_id','$full_name','$email', '$subject', '$message')";

    } else {

        // GUEST USER
        $name = $_POST['name'];
        $email = $_POST['email'];

        $sql = "INSERT INTO messages (full_name, email, subject, message_text)
                VALUES ('$name', '$email', '$subject', '$message')";
    }

    if(mysqli_query($conn,$sql)){
        header("Location: contact.php?status=success");
        exit();
    }else{
        header("Location: contact.php?status=error");
        exit();
    }

}
?>