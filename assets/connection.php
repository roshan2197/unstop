<?php

$conn = mysqli_connect("localhost", "root", "", "train");
if (!$conn) {
    echo 'error';
    exit;
}