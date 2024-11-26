<?php
require 'database.php';
?>

<?php
session_start();

if (isset($_SESSION['user_id'])) {
    header('Location: welcome.php');
    exit();
} if (isset($_POST['clear_cart'])) {
    $_SESSION['cart'] = [];
    header("Location: index.php"); // Redirect to the front page
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <title>Amazon</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <header>
            <div class="navbar">
                <div class="nav-logo border">
                    <div class="logo"></div>
                </div>

                <div class="nav-address border">
                    <p class="add-first"> Deliver to <All-Over></All-Over></p>
                    <div class="add-icon">
                        <i class="fa-solid fa-location-dot"></i>
                        <p class="add-second">Bangladesh</p>
                    </div>
                </div>

                <div class="nav-search border">
                    <select class="search-select">
                        <option>All</option>
                    </select>
                    <input placeholder="Search Amar Bazaar" class="search-input">
                    <div class="search-icon">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </div>
                </div>

            <div class="nav-signin border">
                <p><span>Hello,sign in</span></p>
                <p class="nav-second">Account & Lists</p>
            </div>

            <div class="nav-return border">
                <p><span>Returns</span></p>
                <p class="nav-second">& Orders</p>
            </div>

           <!-- Cart -->
            <div class="nav-cart border">
                <a href="cart.php">
                <i class="fa-solid fa-cart-shopping"></i>
               Cart (<span id="cart-count">0</span>)
                 </a>
            </div> 

            <div class="nav-payment border ">
                <i class="fa-solid fa-money-bill"></i>
                Payment Method
            </div>
       </div>

            <div class="panel ">
                <div class="panel-all border">
                    <i class="fa-solid fa-bars"></i>
                    All
                </div>
                <div class="panel-ops">
                    <p>Today's Deals </p>
                    <p> Customer Service</p>
                    <p>Registry</p>
                    <p>Gift Cards</p>
                    <p>Sell</p>
                </div>
                <div class="panel-deals border">
                    Shop deals in Electronics
                </div>
        
               <!-- Register and Login Links -->
               <div class="auth-buttons">
                    <a href="register.php"><button>Register</button></a>
                    <a href="signin.php"><button>Signin</button></a>
                </div>
        </div>

        </header>
        <div class="hero-section">
            <div class="hero-msg">
                <p>You are on amarbazaar.com. You can also shop on Amar Bazaar Bangladesh for millions of products with fast local delivery. <a>  Click here to go to amarbazaar.bd</a></p>
            </div>
        </div>

        <div class="shop-section">
            <div class="box">
              <div class="box-content">
                <h2> Garments</h2>
                <div class="box-img" style="background-image: url('box1_image.jpg');"></div>
                   <a href="Garments.php?category_id=1"><p>See more</p></a>
              </div>
            </div>
            <div class="box">
                    <div class="box-content">
                      <h2> Sanitation Supplies</h2>
                      <div class="box-img" style="background-image: url('box2_image.jpg');"></div>
                      <p>See more</p>
                    </div>
            </div>
            <div class="box">
                    <div class="box-content">
                      <h2> Home Accessories</h2>
                      <div class="box-img" style="background-image: url('box3_image.jpg');"></div>
                      <p>See more</p>
                    </div>
            </div>
            <div class="box">
                    <div class="box-content">
                      <h2> Electronics </h2>
                      <div class="box-img" style="background-image: url('box4_image.jpg');"></div>
                      <p>See more</p>
                    </div>
            </div>
            <div class="box">
                <div class="box-content">
                  <h2> Skincare & Makeup</h2>
                  <div class="box-img" style="background-image: url('box5_image.jpg');"></div>
                  <p>See more</p>
                </div>
              </div>
              <div class="box">
                      <div class="box-content">
                        <h2> Pet Foods</h2>
                        <div class="box-img" style="background-image: url('box6_image.jpg');"></div>
                        <p>See more</p>
                      </div>
              </div>
              <div class="box">
                      <div class="box-content">
                        <h2> Stationery and Toys</h2>
                        <div class="box-img" style="background-image: url('box7_image.jpg');"></div>
                        <p>See more</p>
                      </div>
              </div>
              <div class="box">
                      <div class="box-content">
                        <h2> Ladies' Accessories</h2>
                        <div class="box-img" style="background-image: url('box8_image.jpg');"></div>
                        <p>See more</p>
                      </div>
              </div>
            <div class="box">
                     <div class="box-content">
                      <h2>Headphones & Musics</h2>
                     <div class="box-img" style="background-image: url('box9_image.jpg');"></div>
                     <p>See more</p>
                     </div>
               </div>
              <div class="box">
                     <div class="box-content">
                     <h2>Get Your Games</h2>
                     <div class="box-img" style="background-image: url('box10_image.jpg');"></div>
                     <p>See more</p>
                    </div>
               </div>
               <div class="box">
                     <div class="box-content">
                     <h2>Clean Your Home</h2>
                     <div class="box-img" style="background-image: url('box11_image.jpg');"></div>
                     <p>See more</p>
                    </div>
               </div>
               <div class="box">
                      <div class="box-content">
                     <h2>Medicines</h2>
                    <div class="box-img" style="background-image: url('box12_image.jpg');"></div>
                    <p>See more</p>
                    </div>
             </div>
        </div>

        <footer>
            <div class="foot-panel1">
                Back To Top
            </div>

            <div class="foot-panel2">
                <div class="logo"></div>
            </div> 
            <div class="foot-panel3">
             <p class="accept-msg">We Accept</p>
            <div class="payment-methods">
            <img src="visa.png" alt="VISA" class="payment-logo">
            <img src="master.png" alt="MasterCard" class="payment-logo">
            <img src="nexuspay.png" alt="Nexus Pay" class="payment-logo">
            <img src="bkash.png" alt="bKash" class="payment-logo">
            <img src="rocket.png" alt="Rocket" class="payment-logo">
            <img src="nagad.png" alt="Nagad" class="payment-logo">
        </div>
                 
        </footer>
 <script>
        function toggleForm(formType) {
            // Hide both forms initially
            document.getElementById('register-form').style.display = 'none';
            document.getElementById('signin-form').style.display = 'none';

            // Show the selected form
            if (formType === 'register') {
                document.getElementById('register-form').style.display = 'block';
            } else if (formType === 'signin') {
                document.getElementById('signin-form').style.display = 'block';
            }
        }
    </script>
    </body>
</html>
