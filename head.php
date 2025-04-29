<html>

<head>

<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<style>

.header {
  overflow:hidden;
  background-color: #005A5B;

  width:100%;
  padding: 0px 0px;
  color:#FF0404  ;
  font-size: 30px;
  font-weight: bold;
  font-family: 'Open Sans', Arial, sans-serif;
}

/* Style the header links */
.header a {
  float: left;
  color: white;
  text-align: center;
  padding: 5px 12px ;
  text-decoration: none;
  font-size: 18px;
  line-height: 80px;
  border-radius: 4px;
  font-weight:bold;
}

/* Style the logo link (notice that we set the same value of line-height and font-size to prevent the header to increase when the font gets bigger */
.header a.logo {
  font-size: 25px;
  font-weight: bold;
  color:#FFf  ;
}

/* Change the background color on mouse-over */
.header a:hover {
  color: yellow;
}




/* Float the link section to the right */
.header-right {
  float: right;
}

/* Add media queries for responsiveness - when the screen is 500px wide or less, stack the links on top of each other */
@media screen and (max-width: 500px) {
  .header a {
    float: none;
    display: block;
    text-align: left;
  }
  .header-right {
    float: none;
  }
}
/* Style the active/current link*/
a.act {
  /* background: linear-gradient(to right, #004aad 0%, #0056C8 100%); */
  color: yellow;
  border-radius: 10px;
  padding: 5px 10px; /* Adjust the padding values as needed */
}


</style>
</head>

<body>
  <div class="header">
  <a href="home.php" class="logo"<?php if($active=='home') echo "class='logo2'"; ?>>
      <img src="gift.png" alt="Gift of Life Logo" style="width: 80px; height: 80px;">
      Gift of Life
    </a>
    <div class="header-right">
      <a href="why_donate_blood.php"  <?php if($active=='why') echo "class='act'"; ?>>Why Donate Organ</a>
      <a href="donate_organ.php"  <?php if($active=='donate') echo "class='act'"; ?>>Become A Donor</a>
      <a href="need_organ.php" <?php if($active=='need') echo "class='act'"; ?>>Need Organ</a>
      <a href="patient_info.php" <?php if($active=='hos') echo "class='act'"; ?>>Patient Info</a>
      <a href="about_us.php"  <?php if($active=='about') echo "class='act'"; ?>>About Us</a>
      <a href="contact_us.php" <?php if($active=='contact') echo "class='act'"; ?>>Contact Us</a>
      <!-- <a href="admin/login.php" <?php if($active=='login') echo "class='act'"; ?>>Admin Login</a> -->
      <a href="admin/login.php" class="custom-link <?php if($active=='login') echo 'act'; ?>" style="color: yellow;" target="_blank">Admin Login</a>



    </div>
  </div>
  <script>
    // JavaScript to remove underline from header menu items on hover
    var menuItems = document.querySelectorAll('.navbar-nav li a');
    menuItems.forEach(function(item) {
        item.addEventListener('mouseover', function() {
            item.style.textDecoration = 'none';
        });
    });
</script>

</body>

</html>
