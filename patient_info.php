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

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        #page-container {
            margin-top: 50px;
            position: relative;
            min-height: 84vh;
        }
        .mt-4 {
            margin-top: 4rem;
        }
        .mb-3 {
            margin-bottom: 3rem;
        }
        .form-inline {
            margin-bottom: 20px;
        }
        #hospitalSelect {
            width: 200px;
        }
        .btn-primary {
            background-color: #f51a14;
            border-color: #f51a14;
        }
        .table {
            border: 1px solid #dee2e6;
        }
        .table th, .table td {
            border: 1px solid #dee2e6;
        }
        
    </style>

</head>

<body>
<?php
$active = 'patients';
include('head.php');
    
include 'conn.php';

if (isset($_GET['admitted_hospital'])) {
    $selectedHospital = $_GET['admitted_hospital'];
    $sql = "SELECT * FROM patient_details WHERE admitted_hospital = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $selectedHospital);
    $stmt->execute();
    $result = $stmt->get_result();
    if (!$result) {
        echo "Query failed: " . $stmt->error;
    }
}
?>

<div id="page-container">
    <div class="container">
        <div id="content-wrap" style="padding-bottom: 90px;">
            <div class="row">
                <div class="col-lg-6">
                    <h1 class="mt-4 mb-3"><b>All Patient Informations</b></h1>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <form action="#" method="get" class="form-inline">
                        <div class="form-group">
                            <label for="admitted_hospital">Select Hospital:</label>
                            <select class="form-control" id="admitted_hospital" name="admitted_hospital">
                                <option value="" selected disabled>Select</option>
                                <option value="BSMMU">BSMMU</option>
                                <option value="DMC">DMC</option>
                                <option value="CMH">CMH</option>
                                <!-- Add more hospitals here -->
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary ml-2">Search</button>
                    </form>
                </div>
            </div>




            <?php if (isset($result) && $result->num_rows > 0): ?>
                <div class="row mt-6">
                    <div class="col-lg-22">
                    <div class="table-responsive">
                        <table class="table">
                        <thead>
                                <tr>
                                    <th class="text-center">SL</th>
                                    <th class="text-center">Patient Name</th>
                                    <th class="text-center">Age</th>
                                    <th class="text-center">Gender</th>
                                    <th class="text-center">BL Group</th>
                                    <th class="text-center">Needed Organ</th>
                                    <th class="text-center">Admitted Hospital</th>
                                    <th class="text-center">Address</th>
                                    <th class="text-center">Mobile</th>
                                    <th class="text-center">Email</th>
                                </tr>
                            </thead>
                            <tbody>
                    <?php
                    $count = 1; // Initialize the count variable
                    while ($row = $result->fetch_assoc()):
                    ?>
                    <tr>
                        <td class="text-center"><?php echo $count++; ?></td>
                                        <td class="text-center"><?php echo $row['p_name']; ?></td>
                                        <td class="text-center"><?php echo $row['age']; ?></td>
                                        <td class="text-center"><?php echo $row['sex']; ?></td>
                                        <td class="text-center">
                                            
                                        
                                        <?php
                                            $bloodId = $row['blood_group'];
                                            $bloodSql = "SELECT blood_group FROM blood WHERE blood_id = ?";
                                            $bloodStmt = $conn->prepare($bloodSql);
                                            $bloodStmt->bind_param("i", $bloodId);
                                            $bloodStmt->execute();
                                            $bloodResult = $bloodStmt->get_result();
                                            $bloodRow = $bloodResult->fetch_assoc();
                                            echo $bloodRow['blood_group'];
                                            ?>
                                    
                                    </td>
                                        <td class="text-center">
                                            <?php
                                            // Fetch the organ name based on the organ_id
                                            $organId = $row['needed_organ'];
                                            $organSql = "SELECT organ_group FROM organ WHERE organ_id = ?";
                                            $organStmt = $conn->prepare($organSql);
                                            $organStmt->bind_param("i", $organId);
                                            $organStmt->execute();
                                            $organResult = $organStmt->get_result();
                                            $organRow = $organResult->fetch_assoc();
                                            echo $organRow['organ_group'];
                                            ?>
                                        </td>
                                        <td class="text-center"><?php echo $row['admitted_hospital']; ?></td>
                                        <td class="text-center"><?php echo $row['address']; ?></td>
                                        <td class="text-center"><?php echo $row['mobile_no']; ?></td>
                                        <td class="text-center"><?php echo $row['email']; ?></td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                </div>

 <!-- Add the "Download PDF" button -->
 <!-- <div class="row mt-4">
            <div class="col-lg-12">
                <form action="generate_pdf.php" method="post">
                    <button type="submit" class="btn btn-primary">Download PDF</button>
                </form>
            </div>
        </div> -->

            <?php endif; ?>

        </div>
    </div>
</div>

<footer style="position: relative; width: 100%; margin-top: 30px">
        <?php include('footer.php');?>
    </footer>
</body>
</html>