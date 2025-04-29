<?php
if (isset($_POST['organ']) && isset($_POST['blood'])) {
    $organ_group=$_POST['organ'];
    $blood_group=$_POST['blood'];

    $conn = mysqli_connect("localhost", "root", "", "organ_donation") or die("Connection error");

    $sql = "SELECT * FROM donor_details
            JOIN blood ON donor_details.donor_blood = blood.blood_id
            JOIN organ ON donor_details.donor_organ = organ.organ_id
            WHERE blood.blood_group = '{$blood_group}'
            AND organ.organ_group = '{$organ_group}'
            ORDER BY RAND() LIMIT 5";

    $result = mysqli_query($conn, $sql) or die("Query unsuccessful.");

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <div class="row">
                <div class="col-lg-4 col-sm-6 portfolio-item"><br>
                    <div class="card" style="width:300px">
                        <!-- <img class="card-img-top" src="image\blood_drop_logo.jpg" alt="Card image" style="width:100%;height:300px"> -->
                        <div class="card-body">
                            <h3 class="card-title"><?php echo $row['donor_name']; ?></h3>
                            <p class="card-text">
                                <b>Organ Name : </b> <b><?php echo $row['organ_group']; ?></b><br>
                                <b>Blood Group : </b> <b><?php echo $row['blood_group']; ?></b><br>
                                <b>Mobile No. : </b> <?php echo $row['donor_number']; ?><br>
                                <b>Gender : </b><?php echo $row['donor_gender']; ?><br>
                                <b>Age : </b> <?php echo $row['donor_age']; ?><br>
                                <b>Address : </b> <?php echo $row['donor_address']; ?><br>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
    } else {
        echo '<div class="alert alert-danger">No Donor Found For your search.</div>';
    }
}
?>
