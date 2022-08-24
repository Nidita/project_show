<!DOCTYPE html>
<html lang="en">
<?php
session_start();

?>
<?php
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
?>
<?php
            //Connecting to database
            require_once "../config.php";

            $email=$_SESSION['daycare-email'];
            
            $query = $mysqli->prepare("SELECT * FROM daycare_info WHERE demail=?");
            $query->bind_param("s", $email);
            $query->execute();
            $result = $query->get_result();
            $row= $result->fetch_assoc();
            $query->close();
            $name=$row['dname'];
            $number=$row['dnumber'];
            $adress=$row['dadress'];
            $oldpasswordErr="";
            $confirmpasswordErr="";
            $district=$row['district'];
            $zipcode=$row['zipcode'];
            $starttime=$row['starttime'];
            $endtime=$row['endtime'];
            $food=$row['food_nutrition'];
            $medical=$row['medication_doctor'];
            $sanitary=$row['sanitary_hygiene'];
            $transportation=$row['transportation'];
            $entertainment=$row['entertainment'];



            if (isset($_POST["edit"]))
            {
                if(!empty($_POST['name']))
                {
                    $name=$_POST['name'];
                
                    $query = $mysqli->prepare("UPDATE daycare_info SET dname = ? WHERE demail = ?");
                    $query->bind_param("ss", $name,$email);
                    $query->execute();
                    $query->close();
                }
                if(!empty($_POST['number']))
                {
                    $number=$_POST['number'];
                
                    $query = $mysqli->prepare("UPDATE daycare_info SET dnumber = ? WHERE demail = ?");
                    $query->bind_param("is", $number,$email);
                    $query->execute();
                    $query->close();
                }
                if(!empty($_POST['adress']))
                {
                    $adress=$_POST['adress'];
                
                    $query = $mysqli->prepare("UPDATE daycare_info SET dadress = ? WHERE demail = ?");
                    $query->bind_param("ss", $adress,$email);
                    $query->execute();
                    $query->close();
                }
                if(!empty($_POST['district']))
                {
                    $district=$_POST['district'];
                
                    $query = $mysqli->prepare("UPDATE daycare_info SET district = ? WHERE demail = ?");
                    $query->bind_param("ss", $district,$email);
                    $query->execute();
                    $query->close();
                }
                if(!empty($_POST['zipcode']))
                {
                    $zipcode=$_POST['zipcode'];
                
                    $query = $mysqli->prepare("UPDATE daycare_info SET zipcode = ? WHERE demail = ?");
                    $query->bind_param("is", $zipcode,$email);
                    $query->execute();
                    $query->close();
                }
                if(!empty($_POST['starttime']))
                {
                    $starttime=$_POST['starttime'];
                
                    $query = $mysqli->prepare("UPDATE daycare_info SET starttime = ? WHERE demail = ?");
                    $query->bind_param("ss", $starttime,$email);
                    $query->execute();
                    $query->close();
                }
                if(!empty($_POST['endtime']))
                {
                    $endtime=$_POST['endtime'];
                
                    $query = $mysqli->prepare("UPDATE daycare_info SET endtime = ? WHERE demail = ?");
                    $query->bind_param("ss", $endtimr,$email);
                    $query->execute();
                    $query->close();
                }
                if(!empty($_POST['food']))
                {
                    $food=$_POST['food'];
                
                    $query = $mysqli->prepare("UPDATE daycare_info SET food_nutrition = ? WHERE demail = ?");
                    $query->bind_param("ss", $food,$email);
                    $query->execute();
                    $query->close();
                }
                if(!empty($_POST['medical']))
                {
                    $medical=$_POST['medical'];
                
                    $query = $mysqli->prepare("UPDATE daycare_info SET medication_doctor = ? WHERE demail = ?");
                    $query->bind_param("ss", $medical,$email);
                    $query->execute();
                    $query->close();
                }
                if(!empty($_POST['sanitary']))
                {
                    $sanitary=$_POST['sanitary'];
                
                    $query = $mysqli->prepare("UPDATE daycare_info SET sanitary_hygiene = ? WHERE demail = ?");
                    $query->bind_param("ss", $sanitary,$email);
                    $query->execute();
                    $query->close();
                }
                if(!empty($_POST['transportation']))
                {
                    $transportation=$_POST['transportation'];
                
                    $query = $mysqli->prepare("UPDATE daycare_info SET transportation = ? WHERE demail = ?");
                    $query->bind_param("ss", $transportation,$email);
                    $query->execute();
                    $query->close();
                }
                if(!empty($_POST['entertainment']))
                {
                    $entertainment=$_POST['entertainment'];
                
                    $query = $mysqli->prepare("UPDATE daycare_info SET entertainment = ? WHERE demail = ?");
                    $query->bind_param("ss", $entertainment,$email);
                    $query->execute();
                    $query->close();
                }
                if(!empty($_POST['oldpassword']))
                {
                   
                   if(password_verify($_POST['oldpassword'],$row['dpassword']))
                   {
                    $oldpasswordErr="";
                    if($_POST['password']!=$_POST['confirmpassword'])
                    {
                        $confirmpasswordErr="Password hasn't been matched!";
                    }
                    else
                    {
                    $confirmpasswordErr="";
                    $password=$_POST['password'];
                
                    $query = $mysqli->prepare("UPDATE daycare_info SET dpassword = ? WHERE demail = ?");
                    $query->bind_param("ss", password_hash($password, PASSWORD_BCRYPT),$email);
                    $query->execute();
                    $query->close();

                    }
                   }
                   else
                   {
                    $oldpasswordErr="Wrong old Password";
                   }
                }
            }
            ?>


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--Bootstrap Link-->
    <link rel="stylesheet" href="../css/bootstrap.min.css">

    <!--Customize css link-->
    <link rel="stylesheet" href="../css/edit_profile.css">


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
    <link
        href="https://fonts.googleapis.com/css2?family=Lobster&family=Poppins:ital,wght@0,300;0,400;0,500;1,400&display=swap"
        rel="stylesheet">

    <title>Your Profile</title>
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
                    <a class="link nav-link dropdown-toggle " href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user" id="login-btn"></i>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="user-dropdown">
                        <li><a class="dropdown-item" href="">Profile</a></li>
                        <hr>
                        <li><a class="dropdown-item" href="../booking/booking_checklist_daycare.php">My booking</a></li>
                        <hr>
                        <li><a class="dropdown-item" href="">Sign
                                out</a></li>

                    </ul>
                </li>
            </div>

            <!--navigation Bar-->

            <nav class="header-2 navigation-bar navbar navbar-expand-lg">

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll"
                    aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon" style="font-weight: 900"><img src="images/menu-burger.png"
                            style="height: 2rem;" alt=""></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarScroll">
                    <ul class="navbar-nav me-auto  ms-auto my-2 my-lg-0 navbar-nav-scroll"
                        style="--bs-scroll-height: 100px;">
                        <li><a href="#home" class="nav-link">Home</a></li>
                        <li><a href="#about" class="nav-link">About Us</a></li>
                        <li><a href="#services" class="nav-link">Services</a></li>

                        <li class="nav-item dropdown">
                            <a class="link nav-link dropdown-toggle " href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
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
    <form  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="home-sec">
            <div class="container ">
                <div class="row all-info">
                    <div class="col-lg-4">
                        <div class="row  profile">
                            <div class="col-lg-12">
                                <div class="info-img">
                                    <img src="../images/company-logo-removebg-preview.png" alt="" srcset="">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <ul>
                                    <!-- <li class="info-edit"><a href="">Profile</a>

                                        <hr>
                                    </li>
                                    <li class="info-edit">
                                        <a href="">Booking list
                                            <hr>
                                        </a>
                                    </li>
                                    <li class="info-edit"><a href="">Settings and security
                                            <hr>
                                        </a></li> -->
                                </ul>


                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="col-lg-12 field">
                            <div class="row">
                                <div class="col-lg-3  root">Day Care Center name</div>
                                <input type="text"  name="name" value="<?php echo $name; ?>" >
                                <hr>
                            </div>
                        </div>
                        <div class="col-lg-12 field">
                            <div class="row">
                                <div class="col-lg-3 root">Old Password</div>
                                <input type="password"  name="oldpassword" >
                                <label><span style="color:red;font-size:1rem ;">*<?php echo $oldpasswordErr; ?></span> </label>
                                <hr>
                            </div>
                        </div>
                        <div class="col-lg-12 field">
                            <div class="row">
                                <div class="col-lg-3 root">New Password</div>
                                <input type="password"  name="password" >
                                <hr>
                            </div>
                        </div>
                        <div class="col-lg-12 field">
                            <div class="row">
                                <div class="col-lg-3 root">Confirm New Password</div>
                                <input type="password"  name="confirmpassword" >
                                <label><span style="color:red;font-size:1rem ;">*<?php echo $confirmpasswordErr; ?></span> </label>
                                <hr>
                            </div>
                        </div>
                        <div class="col-lg-12 field">
                            <div class="row">
                                <div class="col-lg-3 root">Street address</div>
                                <input type="text"  name="adress" value="<?php echo $adress; ?>" >
                                <hr>
                            </div>
                        </div>
                        <div class="col-lg-12 field">
                            <div class="row">
                                <div class="col-lg-3 root">Phone Number</div>
                                <input type="number"  name="number" value="<?php echo $number; ?>" >
                                <hr>
                            </div>
                        </div>
                        <div class="col-lg-12 field">
                            <div class="row">
                                <div class="col-lg-3 root">District </div>
                                <input type="text"  name="district" value="<?php echo $district; ?>" >
                                <hr>
                            </div>
                        </div>
                        <div class="col-lg-12 field">
                            <div class="row">
                                <div class="col-lg-3 root">Zipcode</div>
                                <input type="number"  name="zipcode" value="<?php echo $zipcode; ?>" >
                                <hr>
                            </div>
                        </div>

                        
                        <div class="col-lg-12 field">
                            <div class="row">
                                <div class="col-lg-3 root"> Start Time </div>
                                <input type="text"  name="starttime" value="<?php echo $starttime; ?>" >
                                <hr>
                            </div>
                        </div>
                        <div class="col-lg-12 field">
                            <div class="row">
                                <div class="col-lg-3 root"> End Time </div>
                                <input type="text"  name="endtime" value="<?php echo $endtime; ?>" >
                                <hr>
                            </div>
                        </div>
                        
                        <div class="col-lg-12 fac">
                            <h1>Facilites</h1>
                        </div>
                        <div class=" col-lg-12 field">
                            <div class="row">
                                <div class="col-lg-3 root"> Food and Nutrition </div>
                                <input type="text"  name="food" value="<?php echo $food; ?>" >
                                <hr>
                            </div>
                        </div>
                        <div class="col-lg-12 field">
                            <div class="row">
                                <div class="col-lg-3 root">Medication,Treatment and Doctor </div>
                                <input type="text"  name="medical" value="<?php echo $medical; ?>" >
                                <hr>
                            </div>
                        </div>
                        <div class="col-lg-12 field">
                            <div class="row">
                                <div class="col-lg-3 root">Sanitary and hygiene</div>

                                <input type="text"  name="sanitary" value="<?php echo $sanitary; ?>" >
                                <hr>
                            </div>

                            <div class="col-lg-12 field">
                                <div class="row">
                                    <div class="col-lg-3 root">Transportation </div>
                                    <input type="text"  name="transportation" value="<?php echo $transportation; ?>" >
                                    <hr>
                                </div>
                            </div>
                            <div class="col-lg-12 field">
                                <div class="row">
                                    <div class="col-lg-3 root">Entertainment </div>
                                    <input type="text"  name="firstname" value="<?php echo $entertainment; ?>" >
                                    <hr>
                                </div>
                            </div>
                        </div>




                    </div>

                </div>
            </div>
            </div>
        <div class="col-lg-12 mt-3">
        <input type="submit" value="Edit" name="edit" class="form-btn w-100">
        </div>
        </form>
    </main>
    <script src="../js/bootstrap.bundle.min.js"></script>
</body>