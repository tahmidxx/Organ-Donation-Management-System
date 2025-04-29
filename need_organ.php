<?php
// Database connection
$conn = mysqli_connect("localhost", "root", "", "organ_donation") or die("Connection error");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['search'])) {
    // Check if the form was submitted and the search button was clicked

    // Retrieve data from the form
    $bloodId = $_POST['blood'];
    $organId = $_POST['organ'];
    $neededMonths = $_POST['needed_months'];
    $address = $_POST['address'];
    $reason = $_POST['reason']; // Corrected variable name

    // Prepare SQL statement to insert data into the need_organ table
    $sql = "INSERT INTO need_organ (blood_id, organ_id, needed_months, address, reason) 
            VALUES (?, ?, ?, ?, ?)";

    // Prepare and bind parameters
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iiiis", $bloodId, $organId, $neededMonths, $address, $reason);

    // Execute the SQL statement
    if ($stmt->execute()) {
        // echo "Data inserted successfully.";
    } else {
        echo "Error: " . $conn->error;
    }

    // Close the prepared statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
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
</head>
<body>
    <?php
    $active = 'need';
    include('head.php');
    ?>

    <div id="page-container" style="margin-top:50px; position: relative;min-height: 84vh;">
        <div class="container">
            <div id="content-wrap" style="padding-bottom:90px;">
                <div class="row">
                    <div class="col-lg-6">
                        <h1 class="mt-4 mb-3"><b>Need Organ</b></h1>
                    </div>
                </div>
                <form name="searchForm" action="" method="post">
                    <div class="row" >
                        <div class="col-lg-4 mb-4 " >
                            <div class="font-italic">Blood Group<span style="color:red">*</span></div>
                            <div>
                                <select name="blood" class="form-control search-box" required>
                                    <option value="" selected disabled>Select</option>
                                    <?php
                                    include 'conn.php';
                                    $sql = "SELECT * FROM blood";
                                    $result = mysqli_query($conn, $sql);
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo '<option value="' . $row['blood_id'] . '">' . $row['blood_group'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 mb-4">
                            <div class="font-italic">Organ Name<span style="color:red">*</span></div>
                            <div>
                                <select name="organ" class="form-control search-box" required>
                                    <option value="" selected disabled>Select</option>
                                    <?php
                                    $sql = "SELECT * FROM organ";
                                    $result = mysqli_query($conn, $sql);
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo '<option value="' . $row['organ_id'] . '">' . $row['organ_group'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 mb-4">
                            <div class="font-italic">When do you need the organ (in months)?<span style="color:red">*</span></div>
                            <input type="number" name="needed_months" class="form-control" required>
                        </div>
                        <div class="col-lg-4 mb-4">
                            <div class="font-italic">Address<span style="color:red">*</span></div>
                            <select name="address" class="form-control search-box" required>
                                <option value="" selected disabled>Select</option>
                                <option value="all">All</option>
                                <?php
                                $sql = "SELECT * FROM division";
                                $result = mysqli_query($conn, $sql);
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo '<option value="' . $row['division_id'] . '">' . $row['division_name'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-lg-4 mb-4">
                            <div class="font-italic">Reason, For whom do you need organ?<span style="color:red">*</span></div>
                            <div><textarea class="form-control" name="reason" required></textarea></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 mb-4">
                            <div><input type="submit" name="search" class="btn btn-primary" value="Search" style="cursor:pointer"></div>
                        </div>
                    </div>
                </form>
                <?php
                if (isset($_POST['search'])) {
                    $bloodId = $_POST['blood'];
                    $organId = $_POST['organ'];
                    $address = $_POST['address'];

                    $sql = "SELECT donor_details.donor_name, organ.organ_group, blood.blood_group, donor_details.donor_gender, donor_details.donor_age, division.division_name, donor_details.donor_mail
        FROM donor_details
        JOIN blood ON donor_details.donor_blood = blood.blood_id
        JOIN organ ON donor_details.donor_organ = organ.organ_id
        JOIN division ON donor_details.donor_address = division.division_id
        WHERE blood.blood_id = ? AND organ.organ_id = ?";

                    
                    if ($address !== "all") {
                        $sql .= " AND donor_details.donor_address = ?";
                    }

                    $sql .= " ORDER BY RAND() LIMIT 5";

                    $stmt = $conn->prepare($sql);
                    if (!$stmt) {
                        echo '<div class="col-lg-12"><div class="alert alert-danger">Error in preparing statement: ' . $conn->error . '</div></div>';
                        exit;
                    }

                    if ($address !== "all") {
                        $stmt->bind_param("iis", $bloodId, $organId, $address);
                    } else {
                        $stmt->bind_param("ii", $bloodId, $organId);
                    }

                    if (!$stmt->execute()) {
                        echo '<div class="col-lg-12"><div class="alert alert-danger">Error in executing statement: ' . $stmt->error . '</div></div>';
                        exit;
                    }

                    $result = $stmt->get_result();

                    if ($result->num_rows > 0) {
                        ?>
                        <div class="row">
                            <div class="col-lg-12 text-center">
                                <h2 class="mt-4 mb-3 text-danger">Donor Details Matched</h2>
                            </div>
                        </div>
                        <div class="row">
                        <?php
                        while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                            <div class="col-lg-3 col-sm-5 portfolio-item" style="margin-bottom: 10px;">
                                <div class="card" style="border: 2px solid tomato;">
                                    <div class="card-body" style="padding-left: 8px; padding-top: 5px ; padding-bottom: 5px">
                                        <h4 class="card-title"><?php echo $row['donor_name']; ?></h4>
                                        <p class="card-text">
                                        <b>Organ Name: </b> <?php echo $row['organ_group']; ?><br>
                                        <b>Blood Group : </b> <?php echo $row['blood_group']; ?><br>
                                        <b>Gender : </b><?php echo $row['donor_gender']; ?><br>
                                        <b>Age : </b> <?php echo $row['donor_age']; ?><br>
                                        <b>Address : </b> <?php echo $row['division_name']; ?><br>
                                        <!-- <b>Mobile No : </b> <?php echo $row['donor_number']; ?><br>  -->
                                        <b>E-mail :   </b> <a href="mailto:<?php echo $row['donor_mail']; ?>"><?php echo $row['donor_mail']; ?></a><br>
                                    </p>

                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                        </div>
                        <?php
                    } else {
                        echo '<div class="col-lg-12"><div class="alert alert-danger">No Donor Found For your search. </div></div>';
                        echo '<div class="text-right mb-4"><a href="reservation.php" class="btn btn-primary" style="background-color: #DE3163;">Make a Reservation</a></div>';
                    }

                    $sql = "SELECT *
                    FROM doctor_details
                    JOIN organ ON doctor_details.doc_specialist = organ.organ_id
                    WHERE organ.organ_id = ?
                    ORDER BY RAND() LIMIT 5";

            $stmt = $conn->prepare($sql);
            if (!$stmt) {
                echo '<div class="col-lg-12"><div class="alert alert-danger">Error in preparing statement: ' . $conn->error . '</div></div>';
                exit;
            }

            $stmt->bind_param("i", $organId);
            if (!$stmt->execute()) {
                echo '<div class="col-lg-12"><div class="alert alert-danger">Error in executing statement: ' . $stmt->error . '</div></div>';
                exit;
            }

            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                ?>
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h2 class="mt-4 mb-3 text-danger">Specialist Doctors</h2>
                    </div>
                </div>
                <div class="row">
                    <?php
                    $count = 0;
                    while ($row = mysqli_fetch_assoc($result)) {
                        if ($count % 5 == 0 && $count > 0) {
                            echo '</div><div class="row">';
                        }
                        ?>
                        <div class="col-lg-3 col-sm-5 portfolio-item">
                        <div class="card" style="border: 2px solid tomato;">
                                <div class="card-body">
                                    <h4 class="card-title"><?php echo $row['doc_name']; ?></h4>
                                    <p class="card-text">
                                        <b>Specialist In: </b> <?php echo $row['organ_group']; ?><br>
                                        <b>Mobile No. : </b> <?php echo $row['doc_number']; ?><br>
                                        <b>Hospital Address : </b> <?php echo $row['doc_hospital']; ?><br>
                                        <td>
<a href="mailto:<?php echo $row['doc_mail']; ?>?subject=Appointment%20Request&body=Hello,%0D%0A%0D%0AI%20would%20like%20to%20request%20an%20appointment%20with%20Dr.%20<?php echo $row['doc_name']; ?>.%0D%0APlease%20let%20me%20know%20your%20availability.%20I%20would%20prefer%20to%20meet%20on%20[Your%20Suggested%20Time%20Here].%0D%0A%0D%0AThank%20you.%20Best%20regards,%20[Your%20Name]" class="btn btn-primary" style="background-color: tomato; border-radius: 3px; margin-top: 10px;">Make Appointment</a><br>
</td>

                                    </p>
                                </div>
                            </div>
                        </div>
                        <?php
                        $count++;
                    }
                    echo '</div>';
                } else {
                    echo '<div class="col-lg-12" style="margin-top: 20px;"><div class="alert alert-danger">No Doctors Found For your search.</div></div>';

                }

                }
                ?>
            </div>
        </div>
    </div>
    <footer style="position: relative; width: 100%;">
        <?php include('footer.php');?>
    </footer>
</body>
</html>
