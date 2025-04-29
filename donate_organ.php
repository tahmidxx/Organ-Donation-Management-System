<?php
// Check if form is submitted
if(isset($_POST['submit'])){
    // Process form data here
    
    // Display success message
    $alertMessage = '<div class="alert alert-success" role="alert">Reservation has been successfully saved.</div>';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Donate Organ</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<style>
          .footer {
            
            background-color: #4B0082;
            color: #FF0404;
            padding: 0px 0px;
            text-align: center;
            width: 100%;
            position: relative;
            bottom: 0;
        }

        .footer a {
            color: white;
            text-decoration: none;
        }
</style>
<body>

<?php
$active = 'donate';
include('head.php');
?>

<div id="page-container" style="margin-top: 50px; position: relative; min-height: 84vh;">
  <div class="container">
    <div id="content-wrap" style="padding-bottom: 60px;">
      <div class="row">
        <div class="col-lg-6">
          <h1 class="mt-4 mb-3"><b>Donate Organ</b></h1>
        </div>
      </div>

      <form name="donor" action="savedata.php" method="post" enctype="multipart/form-data">
        <div class="row">
          <div class="col-lg-4 mb-4">
            <div class="font-italic">Full Name<span style="color:red">*</span></div>
            <input type="text" name="fullname" class="form-control" required>
          </div>
          <div class="col-lg-4 mb-4">
            <div class="font-italic">Mobile Number<span style="color:red">*</span></div>
            <input type="text" name="mobileno" class="form-control" required>
          </div>
          <div class="col-lg-4 mb-4">
            <div class="font-italic">Email Id</div>
            <input type="email" name="emailid" class="form-control">
          </div>
        </div>

        <div class="row">
          <div class="col-lg-4 mb-4">
            <div class="font-italic">Age<span style="color:red">*</span></div>
            <input type="text" name="age" class="form-control" required>
          </div>
          <div class="col-lg-4 mb-4">
            <div class="font-italic">Gender<span style="color:red">*</span></div>
            <select name="gender" class="form-control" required>
              <option value="">Select</option>
              <option value="Male">Male</option>
              <option value="Female">Female</option>
            </select>
          </div>
          <div class="col-lg-4 mb-4">
            <div class="font-italic">Organ Name<span style="color:red">*</span></div>
            <select name="organ" class="form-control" required>
              <option value="" selected disabled>Select</option>
              <?php
                include 'conn.php';
                $sql = "SELECT * FROM organ";
                $result = mysqli_query($conn, $sql) or die("Query unsuccessful.");
                while ($row = mysqli_fetch_assoc($result)) {
              ?>
                  <option value="<?php echo $row['organ_id'] ?>"><?php echo $row['organ_group'] ?></option>
              <?php
                }
                mysqli_close($conn);
              ?>
            </select>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-4 mb-4">
            <div class="font-italic">Blood Group<span style="color:red">*</span></div>
            <select name="blood" class="form-control" required>
              <option value="" selected disabled>Select</option>
              <?php
                include 'conn.php';
                $sql = "SELECT * FROM blood";
                $result = mysqli_query($conn, $sql) or die("Query unsuccessful.");
                while ($row = mysqli_fetch_assoc($result)) {
              ?>
                  <option value="<?php echo $row['blood_id'] ?>"><?php echo $row['blood_group'] ?></option>
              <?php
                }
                mysqli_close($conn);
              ?>
            </select>
          </div>
          
          <div class="col-lg-4 mb-4">
          <div class="font-italic">Address (Division)<span style="color:red">*</span></div>
            <select name="address" class="form-control" required>
              <option value="" selected disabled>Select</option>
              <?php
                include 'conn.php';
                $sql = "SELECT * FROM division";
                $result = mysqli_query($conn, $sql) or die("Query unsuccessful.");
                while ($row = mysqli_fetch_assoc($result)) {
              ?>
                  <option value="<?php echo $row['division_id'] ?>"><?php echo $row['division_name'] ?></option>
              <?php
                }
                mysqli_close($conn);
              ?>
            </select>
          </div>
          

          <div class="col-lg-4 mb-4">
        <div class="font-italic">When will you be available for it (in months)?<span style="color:red">*</span></div>
        <input type="number" name="available" class="form-control" required>
    </div>
        </div>
        </div>

        <div class="row">
          <!-- File upload for NID card -->
          <div class="col-lg-4 mb-4">
            <div class="font-italic">NID Card (.jpg, .jpeg, .png)<span style="color:red">*</span></div>
            <input type="file" name="nid_card" accept="image/jpeg, image/png" class="form-control-file" required>
          </div>
        

        
          <!-- File upload for Fitness Prescription -->
          <div class="col-lg-6  mb-4">
            <div class="font-italic">Fitness Prescription (.jpg, .jpeg, .png)<span style="color:red">*</span></div>
            <input type="file" name="prescription" accept="image/jpeg, image/png" class="form-control-file" required>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-4 mb-4">
          
            <input type="submit" name="submit" class="btn btn-primary" value="Submit" style="cursor:pointer">
          </div>
        </div>
      </form><br><br><br><br><br>


    </div>
  </div>
</div>

<div class="footer">
<footer style=" width: 100%;">
        <?php include('footer.php');?>
    </footer>
</div>

</body>
</html>
