<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/common.css">
    <script src="js/bootstrap.min.js"></script>
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js" defer></script>
    <title>Train reservation</title>
</head>
<?php
include 'assets/connection.php';
$max = 0;
$sql = mysqli_query($conn, "select * from tickets");
while ($row = mysqli_fetch_array($sql)) {
    $max += $row['seats_booked'];
}
if (80 - $max < 7 or 80 - $max <= 3)
    $num = 80 - $max;
else $max = 7;
?>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand " href="index.php"><i class='bx bxs-train'></i>Train Booking</a>
            <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarRightAlignExample" aria-controls="navbarRightAlignExample" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarRightAlignExample">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <div class="mt-5"></div>
    <div class="alert d-flex mx-auto me-auto justify-content-center fs-4 w-50 mb-3 mt-3 alert-danger" style="display: none !important;" role="alert">
        Sorry ! All seats are booked for today.
    </div>
    <div class="row row-cols-1 row-cols-md-3 g-4 d-flex justify-content-center align-items-start main">
        <div class="col-lg-6 col-10">
            <div class="card h-100 w-100 ">
                <div class="card-body">
                    <p class="card-text">
                    <form action="submit.php" class="p-3" method="post">
                        <h2 class="text-center my-3 ">Train ticket booking</h2>
                        <div class="mb-3">
                            <label for="formGroupExampleInput" class="form-label">Enter Name</label>
                            <input type="text" class="form-control" id="formGroupExampleInput" name="name" placeholder="" required>
                        </div>
                        <label for="customRange2" class="form-label">Range number of seats</label>
                        <input type="range" class="form-range mb-3 range" min="0" max="<?php echo $num; ?>" value="0" name="seat" onchange="fun();" id="range" required>
                        <input type="text" name="max" value="<?php echo $max; ?>" id="" hidden>
                        <input class="btn btn-primary" type="submit" name="submit" value="Book">
                    </form>
                    </p>
                </div>
            </div>
        </div>
        <div class=" col-lg-4 col-10">
            <div class="card shadow mb-3">
                <div class="card-body">
                    <h5 class="card-title text-decoration-underline">Current status</h5>
                    <h5 class="card-text">Total seats selected : <b id="range_value" class=" text-success fs-2">0</b></h5>
                    <!-- <h5 class="card-text">Total available : <b class="total_avl">7</b></h5> -->
                </div>
            </div>
            <div class="card shadow bg-warning ">
                <div class="card-body">
                    <h5 class="card-title text-decoration-underline">Current Availability</h5>
                    <h5 class="card-text">Total seats available : <b><?php echo 80 - $max; ?></b></h5>
                    <h5 class="card-text">Max. booking allowed : <b>7</b></h5>
                    <h5 class="card-text">Total seats in a coach : <b>80</b></h5>
                    <p class="card-text"><b>Note:</b> Max of 7(seven) tickets can be booked for one booking window.You
                        can book
                        more than 7(seven) tickets with multiple bookings from our site.</p>
                </div>
            </div>
        </div>
    </div>
    <?php
    $sql = mysqli_query($conn, "select * from tickets order by id desc");
    while ($row = mysqli_fetch_array($sql)) {
    ?>
        <div class="d-flex justify-content-center mt-3 row mx-0">
            <div class="card shadow bg-info col-6">
                <div class="card-body">
                    <h5 class="card-title text-decoration-underline">Booking details</h5>
                    </h5>
                    <h5 class="card-text">User Name: <?php echo $row['name']; ?></h5>
                    <h5 class="card-text">Total seats booked : <b><?php echo $row['seats_booked']; ?></b></h5>
                    <h5 class="card-text d-flex align-items-center"> Seat No:
                        <?php
                        for ($i = $row['seat_no']; $i < $row['seat_no'] + $row['seats_booked']; $i++) { ?>
                            <div class="ball mx-2"><?php echo $i + 1; ?></div>
                        <?php

                        } ?>
                    </h5>
                </div>
            </div>
            <div class="col-4 "></div>
        </div>
    <?php
    }
    ?>
    <footer class=" bg-light d-flex align-items-center justify-content-center">
        <p>©Roshan</p>
    </footer>

</body>
<script>
    let max = <?php echo $max; ?>;

    function fun() {
        document.getElementById("range_value").innerHTML = document.getElementById("range").value;
        if (max >= 77) document.getElementById("range").max = 80 - max;
        if (max == 80) {
            $(".alert").show();
            $("input").attr("disabled", "true");
            $('.row').css({
                opacity: 0.5
            });
        }
    }
    window.onload = function() {
        document.getElementById("range_value").innerHTML = document.getElementById("range").value;
        if (max == 80) {
            $(".alert").show();
            $("input").attr("disabled", "true");
            $('.main').css({
                opacity: 0.5
            });
        }

    }
</script>

</html>