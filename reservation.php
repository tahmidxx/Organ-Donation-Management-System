<?php
$active = 'need';
include('head.php');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "organ_donation";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$name = '';
$age = '';
$gender = '';
$bloodGroup = '';
$organName = '';
$neededMonths='';
$mobileNo = '';
$eMail = '';
$address = '';
$alertMessage = ''; // Initialize $alertMessage here

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $age = isset($_POST['age']) ? $_POST['age'] : '';
    $gender = isset($_POST['gender']) ? $_POST['gender'] : '';
    $bloodGroup = $_POST['blood'];
    $organName = isset($_POST['organ_name']) ? $_POST['organ_name'] : '';
    $neededMonths = isset($_POST['needed_months']) ? $_POST['needed_months'] : '';
    $mobileNo = $_POST['mobileno'];
    $eMail  = $_POST['email'];
    $address = isset($_POST['address']) ? $_POST['address'] : '';

    $insertSql = "INSERT INTO reservation (name, age, gender, blood_group, organ_name, needed_months, mobile_no, email,address, time)
                  VALUES (?, ?,?, ?, ?, ?, ?, ?,?, NOW())";

    $stmtInsert = $conn->prepare($insertSql);
    $stmtInsert->bind_param("sisssssss", $name, $age, $gender, $bloodGroup, $organName, $neededMonths, $mobileNo, $eMail, $address);

    if ($stmtInsert->execute()) {
        $alertMessage = '<div class="alert alert-success" role="alert">Reservation has been successfully saved.</div>';
        $name = '';
        $age = '';
        $gender = '';
        $bloodGroup = '';
        $organName = '';
        $neededMonths='';
        $mobileNo = '';
        $eMail = '';
        $address='';
    } else {
        $alertMessage = '<div class="alert alert-danger" role="alert">Error saving reservation: ' . $stmtInsert->error . '</div>';
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Make a Reservation</title>
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> -->
    <style>
    /* Inline CSS */
    .container {
        margin-top: 20px;
    }
    .form-group {
        width: calc(33.33% - 20px); /* 33.33% width with spacing */
        margin-right: 20px;
        float: left;
        margin-bottom: 20px;
    }
    .form-group:nth-child(3n+3) {
        margin-right: 0; /* No margin on the last element of each row */
    }
    .form-control {
        width: 100%;
    }
    .footer {
        position: fixed;
        bottom: 0;
        left: 0;
        width: 100%;
        background-color: #f8f9fa;
        padding: 20px;
        text-align: center;
    }
    footer {
        width: 100%;
    }
    /* Remove underline from header menu items on hover */
    .navbar-nav li a:hover {
        text-decoration: none;
    }
</style>

</head>
<body>
<div id="page-container">
    <div class="container">
        <div id="content-wrap">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="mt-4 mb-3"><b>Make a Reservation</b></h1>
                </div>
            </div>
            <?php echo $alertMessage; ?>
            <form method="post" onsubmit="return validateForm()">
                <div class="form-group">
                    <label for="name">Name<span style="color:red">*</span></label>
                    <input type="text" name="name" class="form-control" value="<?php echo $name; ?>" placeholder="Enter Your Name" required>
                </div>
                <div class="form-group">
                    <label for="age">Age<span style="color:red">*</span></label>
                    <input type="text" name="age" class="form-control" value="<?php echo $name; ?>" placeholder="Enter Your Age" required>
                </div>
                <div class="form-group">
                    <label for="gender">Gender<span style="color:red">*</span></label>
                    <select name="gender" class="form-control" required>
                        <option value="" disabled selected>Select Gender</option>
                        <option value="Male"<?php if ($gender === 'Male') echo ' selected'; ?>>Male</option>
                        <option value="Female"<?php if ($gender === 'Female') echo ' selected'; ?>>Female</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="blood">Blood Group<span style="color:red">*</span></label>
                    <select name="blood" class="form-control" required>
                        <option value="" disabled selected>Select Blood group</option>
                        <option value="A+"<?php if ($bloodGroup === 'A+') echo ' selected'; ?>>A+</option>
                        <option value="A-"<?php if ($bloodGroup === 'A-') echo ' selected'; ?>>A-</option>
                        <option value="B+"<?php if ($bloodGroup === 'B+') echo ' selected'; ?>>B+</option>
                        <option value="B-"<?php if ($bloodGroup === 'B-') echo ' selected'; ?>>B-</option>
                        <option value="AB+"<?php if ($bloodGroup === 'AB+') echo ' selected'; ?>>AB+</option>
                        <option value="AB-"<?php if ($bloodGroup === 'AB-') echo ' selected'; ?>>AB-</option>
                        <option value="O+"<?php if ($bloodGroup === 'O+') echo ' selected'; ?>>O+</option>
                        <option value="O-"<?php if ($bloodGroup === 'O-') echo ' selected'; ?>>O-</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="organ">Organ Name<span style="color:red">*</span></label>
                    <select name="organ_name" class="form-control" required>
                        <option value="" disabled selected>Select Organ</option>
                        <option value="Heart"<?php if ($organName === 'Heart') echo ' selected'; ?>>Heart</option>
                        <option value="Lungs"<?php if ($organName === 'Lungs') echo ' selected'; ?>>Lungs</option>
                        <option value="Liver"<?php if ($organName === 'Liver') echo ' selected'; ?>>Liver</option>
                        <option value="Kidneys"<?php if ($organName === 'Kidneys') echo ' selected'; ?>>Kidneys</option>
                        <option value="Pancreas"<?php if ($organName === 'Pancreas') echo ' selected'; ?>>Pancreas</option>
                        <option value="Intestines"<?php if ($organName === 'Intestines') echo ' selected'; ?>>Intestines</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="age">When do you need the organ (in months)?<span style="color:red">*</span></label>
                    <input type="text" name="needed_months" class="form-control" value="<?php echo $neededMonths; ?>" placeholder="" required>
                </div>
                
                <div class="form-group">
                    <label for="mobileNo">Mobile Number<span style="color:red">*</span></label>
                    <input type="text" name="mobileno" class="form-control" value="<?php echo $mobileNo; ?>" placeholder="Enter Mobile Number" required>
                </div>

                

                <div class="form-group">
                    <label for="eMail">Email</label>
                    <input type="email" name="email" class="form-control" value="<?php echo $eMail; ?>" placeholder="example@gmail.com" required>
                </div>
                <div class="form-group">
                <label for="address">Select Division<span style="color:red">*</span></label>
                <select name="address" class="form-control" required>
                    <option value="" disabled selected>Select Division</option>
                    <option value="Dhaka"<?php if ($address === 'Dhaka') echo ' selected'; ?>>Dhaka</option>
                    <option value="Chittagong"<?php if ($address === 'Chittagong') echo ' selected'; ?>>Chittagong</option>
                    <option value="Rajshahi"<?php if ($address === 'Rajshahi') echo ' selected'; ?>>Rajshahi</option>
                    <option value="Khulna"<?php if ($address === 'Khulna') echo ' selected'; ?>>Khulna</option>
                    <option value="Barisal"<?php if ($address === 'Barisal') echo ' selected'; ?>>Barisal</option>
                    <option value="Sylhet"<?php if ($address === 'Sylhet') echo ' selected'; ?>>Sylhet</option>
                    <option value="Rangpur"<?php if ($address === 'Rangpur') echo ' selected'; ?>>Rangpur</option>
                    <option value="Mymensingh"<?php if ($address === 'Mymensingh') echo ' selected'; ?>>Mymensingh</option>
                </select>
            </div>
                
                <div class="row">
    <div class="row-lg-12">
        <div class="form-group">
            
            <br>
            <input type="submit" name="submit" class="btn btn-primary" value="Submit">
        </div>
    </div>
</div>

            </form>
        </div>
    </div>
</div>
<div class="footer">
    <footer>
        <?php include('footer.php');?>
    </footer>
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
