<!DOCTYPE html>
<html lang="en">
<?php
    //Starting Session
    session_start();
    ?>
    <?php
    //logged-User Checking
    $daycare = $people = $userlogged = "";
    if (isset($_SESSION["daycare-name"])) {
        $daycare = $_SESSION['daycare-name'];
    }
    if (isset($_SESSION["user-name"])) {
        $people = $_SESSION['user-name'];
    }

    if ($daycare != "") {
        $userlogged = $daycare;
    }
    if ($people != "") {
        $userlogged = $people;
    }
    require_once "../config.php";
    $booking_id = array();
    $k = -1;
    ?>


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--Bootstrap Link-->
    <link rel="stylesheet" href="../css/bootstrap.min.css">

    <!--Customize css link-->
    <link rel="stylesheet" href="../css/booking.css">
    <link rel="stylesheet" href="../css/form.css">


    <!--Swiper cdn-->
    <link rel=" stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
    <link rel="stylesheet" href="../css/swiper.css">

    <!-- Link Swiper's CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css" />

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">


    <!--comapny logo font-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lobster&family=Poppins:ital,wght@0,300;0,400;0,500;1,400&display=swap" rel="stylesheet">

    <title>Booking Checklist Confirmed</title>
</head>

<body>


    <header class="header container-fluid">
        <section class="header-in fixed-top">
            <div class="header-1">
                <div id="company-logo"><img src="../images/company-logo-removebg-preview.png" alt="">
                    <a href="#"> Cloud
                        Children </a>
                </div>
                <li class="user-drop nav-item dropdown ">
                    <a class="link nav-link dropdown-toggle " href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user" id="login-btn"></i>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="user-dropdown">
                        <li><a class="dropdown-item" href="">Profile</a></li>
                        <hr>
                        <li><a class="dropdown-item" href="">My booking</a></li>
                        <hr>
                        <li><a class="dropdown-item" href="">Sign
                                out</a></li>

                    </ul>
                </li>
            </div>

            <!--navigation Bar-->

            <nav class="header-2 navigation-bar navbar navbar-expand-lg">

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon" style="font-weight: 900"><img src="images/menu-burger.png"
                            style="height: 2rem;" alt=""></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarScroll">
                    <ul class="navbar-nav me-auto  ms-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                        <li><a href="#home" class="nav-link">Home</a></li>
                        <li><a href="#about" class="nav-link">About Us</a></li>
                        <li><a href="#services" class="nav-link">Services</a></li>

                        <li class="nav-item dropdown">
                            <a class="link nav-link dropdown-toggle " href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Child-Care Categories
                            </a>
                            <ul class="dropdown-menu" id="dropmenu" aria-labelledby="navbarDropdown">

                                <li><a class="dropdown-item" href="#">Toddler</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="#">Pre-School</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="#">School-Age</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="#">Special-Child</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="#">Foreigner-Child</a></li>
                            </ul>
                        </li>


                        <li><a href="#parenting-blogs" class="nav-link">Parenting-Guides</a></li>
                    </ul>

                </div>

            </nav>


        </section>
    </header>
    <main>
        <div class="container home-sec">
            <h5 class="h1 book-state"><span>Confirmed Bookings
            </span></h5>
            <?php
            
            $confirm = "Yes";
            $query = $mysqli->prepare("SELECT booking_id FROM booking_info WHERE demail=? AND confirmed=?");
            $query->bind_param("ss", $_SESSION['daycare-email'], $confirm);
            $query->execute();
            $result_prev = $query->get_result();
            $query->close();
            ?>
            <form  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <?php
            while ($row_prev = $result_prev->fetch_assoc()) {
                $k++;
                $booking_id[$k] = $row_prev['booking_id'];
                ?>
            <div class="row g-4 ms-auto  book-state-detail ">

                <div class="col-lg-6 col-10 booking-detail"> <span class="h3 id">Booking Id</span> <span class="info"><?php echo $row_prev['booking_id']?></span></div>
                <div class="col-lg-4"></div>
                <?php
                       
                $m = (string)$row_prev['booking_id'] . '_' . "details";
                ?>
                <div class="col-lg-2 col-2"><button class=" see-details"type="submit" name="<?php echo $m; ?>">See details</button></div>


            </div>
            <?php
            }
            ?>
            </form>
            <?php
            for($i=0;$i<sizeof($booking_id);$i++)
            {
                if(isset($_POST[(string)$booking_id[$i]."_"."details"]))
                {
                $_SESSION['booking_id']=$booking_id[$i];
                echo '<script>window.location.href = "book_details_design.php"</script>';
                }
            }
        
            ?>
        </div>

    </main>