<?php 
session_start();
include("connect.php");

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"
/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="tab.css">
</head>
<body>

        
<header class="header">
    <a href="#" class="logo"> <img src="logo.jpg" >  GREASE <span> MONKEY</span> </a>
    <nav class="navbar">
       <a href="#home"> home </a>
       <a href="#service"> service </a>
       <a href="#contact"> contact </a>
       <a href="#faq"> FAQ </a>
       <a href="#aboutus"> About Us </a>
       
    </nav>
    
</header>

<div class="circle"> 
    
    <div class="content"> 
    <h2> <span> EXPERT</span> CAR CARE </h2>
    <br>
    <br>
    <p> You Deserve The Best Repair Service For Your Car.</p>
    <br>
    <button type="button"> MAKE AN APPOINTMENT</button>

    <div class="circle2" > 
        <img src="frd.png">
    </div>
    

</div>
</div>


<section> 

        <div class="about" >
                <h3>ABOUT <span> US </span></h3>
                <BR>
                <h2> The Most Experienced Mechanics
                    You Ever Met</h2>
                    <BR>
                <p> Started during pandemic which is 2020 and is established  by the owner named Ryan Salazar. <br>
                    At first they only do home service repair because customers during that time scared <br> to go outside because they are  avoiding the so called virus back then.
                 They are located at M. De Leon st., Gen. T. De Leon,  Valenzuela City  and has a 4 Mechanic <br> and 1 Technician and 1 Sales Manager.</p> <br>
                 <button type="submit"> MORE ABOUT US </button>
             </div>
            
             <div class="title">
        <h2>OUR <span> SERVICE</span></h2>
        <div class="container"> <br> <p>
            Grease Monkey offer full service auto repair <br> and maintenance such as  changing oil, <br> abs repair module, engline repair, and transmission
        </p>
             </div>

             

             <div class="slideshow swiper">
    <div class="slides">
        <ul class="slide swiper-wrapper">
            <li class="pics swiper-slide"> 
            <a href="#" class="cards"> 
            <img src="1.jpeg" alt="Service 1" class="card-1">
            <h2>Change Oil 1</h2>
            <p>Description of Service 1.</p>
        </a>
        </li>

        <li class="pics swiper-slide"> 
            <a href="#" class="cards"> 
            <img src="1.jpeg" alt="Service 1" class="card-1">
            <h2>Change Oil 1</h2>
            <p>Description of Service 1.</p>
        </a>
        </li>

        <li class="pics swiper-slide"> 
            <a href="#" class="cards"> 
            <img src="1.jpeg" alt="Service 1" class="card-1">
            <h2>Change Oil 1</h2>
            <p>Description of Service 1.</p>
        </a>
        </li>

        <li class="pics swiper-slide"> 
            <a href="#" class="cards"> 
            <img src="1.jpeg" alt="Service 1" class="card-1">
            <h2>Change Oil 1</h2>
            <p>Description of Service 1.</p>
        </a>
        </li>

        </ul>
        <div class="swiper-pagination"></div>

        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
        </div>
    </div>
</div>
</div>
</section>



 



<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="script.js"></script>
    


</body>
</html>