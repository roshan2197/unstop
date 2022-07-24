<?php
include 'assets/connection.php';
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $seat = $_POST['seat'];
    $seatno = $_POST['max'];
    if (mysqli_query($conn, "insert into tickets (name,seats_booked,seat_no) values ('$name','$seat','$seatno') ")) {
        echo '<script>alert("Seats booked successfully");</script>';
    } else {
        echo 'data error';
        // echo ''
    }
    header('location:index.php');
}