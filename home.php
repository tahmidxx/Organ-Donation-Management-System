<!DOCTYPE html>

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
  .row {
      display: flex;
      justify-content: space-between;
    }
    .portfolio-item {
      background-color: #fff;
      padding: 5px;
      margin-bottom: 10px;
      border: 1px;
    }
    .card{
      
    }
    .card-text {
      white-space: nowrap;
      
    }
    body {
      color: rgb(0, 0, 0);
      font-family: 'Open Sans', Arial, sans-serif;
      text-align: justify;
      
    }
</style>
</head>

<body>
<div class="header">
<?php
$active="home";
include('head.php'); ?>

</div>
<?php include'ticker.php'; ?>

  <div id="page-container" style="margin-top:50px; position: relative;min-height: 84vh;   ">
    <div class="container">
    <div id="content-wrap"style="padding-bottom:75px;">
  <div id="demo" class="carousel slide" data-ride="carousel">

    <!-- Indicators -->
    <ul class="carousel-indicators">
      <li data-target="#demo" data-slide-to="0" class="active"></li>
      <li data-target="#demo" data-slide-to="1"></li>
      <li data-target="#demo" data-slide-to="2"></li>
    </ul>

    <!-- The slideshow -->
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="image\1.jpg" alt="image\1.jpg" width="100%" height="500">
      </div>
      <div class="carousel-item">
        <img src="image\2.jpg" alt="image\2.jpg" width="100%" height="500">
      </div>
      <div class="carousel-item">
        <img src="image\3.jpg" alt="image\3.jpg" width="100%" height="500">
      </div>

    </div>

    <!-- Left and right controls -->
    <a class="carousel-control-prev" href="#demo" data-slide="prev">
      <span class="carousel-control-prev-icon"></span>
    </a>
    <a class="carousel-control-next" href="#demo" data-slide="next">
      <span class="carousel-control-next-icon"></span>
    </a>
  </div>
<br>
        <h1 style="text-align:center;font-size:45px;"><strong> Welcome to Gift of Life</strong></h1>
<br>
        <div class="row">
            <div class="col-lg-4 mb-4">
                <div class="card" style="text-align:center;">
                    <h4 class="card-header card bg-info text-white"  >The need for organ</h4>

                        <p class="card-body overflow-auto" style="padding-left:2%;height:220px;text-align:left;">
                          <?php
                            include 'conn.php';
                            $sql=$sql= "select * from pages where page_type='needfororgan'";
                            $result=mysqli_query($conn,$sql);
                            if(mysqli_num_rows($result)>0)   {
                                while($row = mysqli_fetch_assoc($result)) {
                                  echo $row['page_data'];
                                }
                              }

                           ?>
                         </p>
                </div>
            </div>
            <div class="col-lg-4 mb-4">
            <div class="card" style="text-align:center;">
                    <h4 class="card-header card bg-info text-white">Concept of organ donation</h4>

                    <p class="card-body overflow-auto" style="padding-left:2%;height:220px;text-align:left;">
                      <?php
                        include 'conn.php';
                        $sql=$sql= "select * from pages where page_type='organtips'";
                        $result=mysqli_query($conn,$sql);
                        if(mysqli_num_rows($result)>0)   {
                            while($row = mysqli_fetch_assoc($result)) {
                              echo $row['page_data'];
                            }
                          }

                       ?>
                     </p>

                        </div>
            </div>
            <div class="col-lg-4 mb-4">
            <div class="card" style="text-align:center;">
                    <h4 class="card-header card bg-info text-white" >Who you could Help</h4>

                    <p class="card-body overflow-auto" style="padding-left:2%;height:220px;text-align:left;">
                      <?php
                        include 'conn.php';
                        $sql=$sql= "select * from pages where page_type='whoyouhelp'";
                        $result=mysqli_query($conn,$sql);
                        if(mysqli_num_rows($result)>0)   {
                            while($row = mysqli_fetch_assoc($result)) {
                              echo $row['page_data'];
                            }
                          }

                       ?>
                     </p>


                        </div>
            </div>
</div>



<!-- <h2>Enlisted Donors</h2> -->

<body>
  <div class="row" style="margin: 0 auto; width: fit-content;">
    <?php
      include 'conn.php';
      
      $sql = "SELECT COUNT(*) as total_donors
      FROM donor_details
      JOIN blood ON donor_details.donor_blood = blood.blood_id
      JOIN organ ON donor_details.donor_organ = organ.organ_id
      ORDER BY entry_date DESC LIMIT 4"; // Limit the result to 4 records
      $result = mysqli_query($conn, $sql);
      $row = mysqli_fetch_assoc($result);
      $total_donors = $row['total_donors'];
      
      echo "<div class='col-lg-12 col-sm-6 portfolio-item' style='border: 0px solid white;'>
              <div class='card'>
                <div class='card-body' style='padding-left: 8px;'>
                  <h2 class='card-title' style='text-align: center;'>Total Donors Joined so far: <span class='card-text'>$total_donors</span></h2>
                </div>
              </div>
            </div>";
    ?>
  </div>
</body>






<br>
        <!-- /.row -->

        <!-- Features Section -->
        <div class="row">
            <div class="col-lg-6">
                <h2>Donatable Organs</h2>
                <p>
                  <?php
                    include 'conn.php';
                    $sql=$sql= "select * from pages where page_type='organgroups'";
                    $result=mysqli_query($conn,$sql);
                    if(mysqli_num_rows($result)>0)   {
                        while($row = mysqli_fetch_assoc($result)) {
                          echo $row['page_data'];
                        }
                      }

                   ?></p>

            </div>
            <div class="col-lg-6">
                <img class="img-fluid rounded" src="image\4.jpg" alt="" >
            </div>
        </div>
        <!-- /.row -->

        <hr>

        <!-- Call to Action Section -->
        <div class="row mb-4">
            <div class="col-md-8">
            <h2>How can we increase transplants?</h2>
            <p>
              <?php
                include 'conn.php';
                $sql=$sql= "select * from pages where page_type='increase'";
                $result=mysqli_query($conn,$sql);
                if(mysqli_num_rows($result)>0)   {
                    while($row = mysqli_fetch_assoc($result)) {
                      echo $row['page_data'];
                    }
                  }

               ?></p>
              </div>
            <div class="col-md-4">
                <a class="btn btn-lg btn-secondary btn-block" href="donate_organ.php" style="align:center; background-color:#004aad;color:#fff ">Become a Donor </a>
                <a class="btn btn-lg btn-secondary btn-block" href="reservation.php" style="align:center; background-color :#005A5B;color:#fff ">Add a reservation </a>
              </div>

              <div class="container">
        <h2>Our Location</h2>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3642.720514166814!2d90.20901620935756!3d24.076144778359666!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755e3c3c7f81a81%3A0x25d288e2d6812f04!2sRumaisa%20General%20Hospital%20And%20Diagnostic%20Center!5e0!3m2!1sen!2sbd!4v1692640160578!5m2!1sen!2sbd" width="100%" height="350" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
</div>

        </div>
        

    </div>
  </div>
  <footer style="position: relative; width: 100%; margin-top: 30px">
        <?php include('footer.php');?>
    </footer>
</div>

</body>

</html>
