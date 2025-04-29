<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection
    $conn = mysqli_connect("localhost", "root", "", "organ_donation") or die("Connection error");

    // Get form data
    $name = $_POST['fullname'];
    $number = $_POST['mobileno'];
    $email = $_POST['emailid'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $organ_group = $_POST['organ'];
    $blood_group = $_POST['blood'];
    $address = $_POST['address'];
    $whenavailable = $_POST['available'];

    // Insert data into the database
    $sql = "INSERT INTO donor_details (donor_name, donor_number, donor_mail, donor_age, donor_gender, donor_organ, donor_blood, donor_address, when_available) 
            VALUES ('$name', '$number', '$email', '$age', '$gender', '$organ_group', '$blood_group', '$address','$whenavailable')";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        // Get the ID of the last inserted record
        $donor_id = mysqli_insert_id($conn);

        // Directory paths for storing uploaded files
        $nidDir = "C:/xampp/htdocs/BDMS/nids/";
        $prescriptionDir = "C:/xampp/htdocs/BDMS/prescriptions/";

        // File paths with unique identifiers (using donor ID)
        $nidPath = $nidDir . $donor_id . "_nid.jpg";
        $prescriptionPath = $prescriptionDir . $donor_id . "_pres.jpg";

        // Upload NID card
        if (move_uploaded_file($_FILES["nid_card"]["tmp_name"], $nidPath)) {
            // Update the database with NID card filename
            $nidFilename = $donor_id . "_nid.jpg";
            mysqli_query($conn, "UPDATE donor_details SET nid_card_filename = '$nidFilename' WHERE donor_id = $donor_id");
        } else {
            // Display error message if uploading fails
            $alertMessage = '<div class="alert alert-danger" role="alert">Error uploading NID card file.</div>';
        }

        // Upload prescription
        if (move_uploaded_file($_FILES["prescription"]["tmp_name"], $prescriptionPath)) {
            // Update the database with prescription filename
            $prescriptionFilename = $donor_id . "_pres.jpg";
            mysqli_query($conn, "UPDATE donor_details SET prescription_filename = '$prescriptionFilename' WHERE donor_id = $donor_id");
        } else {
            // Display error message if uploading fails
            $alertMessage = '<div class="alert alert-danger" role="alert">Error uploading prescription file.</div>';
        }

        // Close database connection
        mysqli_close($conn);

        // Display success message
        $alertMessage = '<div class="alert alert-success" role="alert">Your data has been successfully submitted.</div>';

    } else {
        // Display error message if insertion fails
        $alertMessage = '<div class="alert alert-danger" role="alert">Error: ' . mysqli_error($conn) . '</div>';
        mysqli_close($conn);
    }
} else {
    // Redirect to error page if accessed directly
    header("Location: error.php");
    exit();
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

      <!-- Display alert message -->
      <?php echo isset($alertMessage) ? $alertMessage : ''; ?>

      <form name="donor" action="savedata.php" method="post" enctype="multipart/form-data">
        <!-- Your form fields here -->
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
