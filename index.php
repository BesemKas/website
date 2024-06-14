<?php
    session_start();

    if(isset($_SESSION["AccountID"])){
        $_SESSION["Page"] = "Index";
    }
    
    
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title>Home</title>
    <link rel="icon" href="./Media/logo.jpg">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        body{
            background-color: #d4d3d3 !important;
        }
    </style>
</head>

<body>
    <div id="nav"></div>

    <div class="main__container">
        <div class="container-fluid">
            <div class="row" id="top">
                <img class="img-fluid" src="./Media/trybest.jpg" alt="">

            </div>
            <div class="row g-0" id="description">
                <div class="col-md-4 mt-3"">
                    <div class=" mission">
                        <h1>Our Mission</h1>
                        <p>
                            At Washmore, we believe in delivering more than just a shine. We are committed to providing a
                            meticulous,
                            full-service experience for your vehicle.
                            From thorough cleaning to paying attention to every detail, we strive to combine efficiency with
                            value for
                            money.<br><br>
                            We take pride in our work and aim to exceed your expectations in all that we do.
                            Trust us to keep your car looking its best, because at Washmore, your car’s shine is our
                            mission!
                        </p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <img class="img-fluid" src="./Media/carwash.jpg" alt="">
                </div>
            </div>
        </div>

    </div>
    <div class="container-fluid" id="services__container">

       <div class="row">
            <h1> Carwash Services</h1>
       </div>
       <div class="row" id="service__images">
            <div class="col-md-3" id="left__column">
                <div class="icon"><img src="./Media/Polish.png" alt="" /></div>
                <div class="icon"><img src="./Media/SafeChemicals.png" alt="" /></div>
                <div class="icon"><img src="./Media/Interior.png" alt="" /></div>
                
            </div>
            <div class="col-md-6" id="center__image"><img src="./Media/mini.png" alt=""></div>
            <div class="col-md-3" id="right__column">
                <div class="icon"><img src="./Media/Tire Car (2).png" alt="" /></div>
                <div class="icon"><img src="./Media/Tire Car.png" alt="" /></div>
                <div class="icon"><img src="./Media/Wash.png" alt="" /></div>
                
            </div>
       </div>

    </div>

    <div class="container-fluid" id="location__container">
        <div class="row">
            <h1>Our Locations</h1>
        </div>
        <div class="row">
        <div class="row" id="location__row">
            <div class="col-lg-3" id="locationbox">
                <div class="location__map">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3304.2754686192493!2d18.818605376562545!3d-34.08808293045142!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1dcdb5afa2986a85%3A0x50f7c1bbd71afba9!2sCar%20Wash%20at%20The%20Sanctuary!5e0!3m2!1sen!2sza!4v1710966840246!5m2!1sen!2sza" ></iframe>
                </div>
                <div class="location__details">
                    <p>
                      Our Sanctuary Carwash <br>
                      Address: 12 wash st <br>
                      Phone: (+27) 00 000 0000
                    </p>
                </div>
            </div>

            <div class="col-lg-3" id="locationbox">
                <div class="location__map">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3304.2754686192493!2d18.818605376562545!3d-34.08808293045142!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1dcdb5afa2986a85%3A0x50f7c1bbd71afba9!2sCar%20Wash%20at%20The%20Sanctuary!5e0!3m2!1sen!2sza!4v1710966840246!5m2!1sen!2sza" ></iframe>
                </div>
                <div class="location__details">
                    <p>
                      Our Sanctuary Carwash <br>
                      Address: 12 wash st <br>
                      Phone: (+27) 00 000 0000
                    </p>
                </div>
            </div>

            <div class="col-lg-3" id="locationbox">
                <div class="location__map">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3304.2754686192493!2d18.818605376562545!3d-34.08808293045142!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1dcdb5afa2986a85%3A0x50f7c1bbd71afba9!2sCar%20Wash%20at%20The%20Sanctuary!5e0!3m2!1sen!2sza!4v1710966840246!5m2!1sen!2sza" ></iframe>
                </div>
                <div class="location__details">
                    <p>
                      Our Sanctuary Carwash <br>
                      Address: 12 wash st <br>
                      Phone: (+27) 00 000 0000
                    </p>
                </div>
            </div>
        </div>
    </div>
    </div>

    <div id="footer"></div>

    <script src="js/getNavFooter.js"></script>


</body>

</html>