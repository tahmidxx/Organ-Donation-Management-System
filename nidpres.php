<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection
    include 'conn.php';

    $fullname = $_POST['fullname'];
    $mobileno = $_POST['mobileno'];
    $emailid = $_POST['emailid'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $organ = $_POST['organ'];
    $blood = $_POST['blood'];
    $address = $_POST['address'];

    // File upload directories
    $nidDir = "C:/xampp/htdocs/BDMS/nids/";
    $prescriptionDir = "C:/xampp/htdocs/BDMS/prescriptions/";

    // File paths
    $nidPath = $nidDir . basename($_FILES["nid_card"]["name"]);
    $prescriptionPath = $prescriptionDir . basename($_FILES["prescription"]["name"]);

    // Upload NID card
    if (move_uploaded_file($_FILES["nid_card"]["tmp_name"], $nidPath)) {
        echo "NID card file uploaded successfully.";
    } else {
        echo "Error uploading NID card file.";
    }

    // Upload prescription
    if (move_uploaded_file($_FILES["prescription"]["tmp_name"], $prescriptionPath)) {
        echo "Prescription file uploaded successfully.";
    } else {
        echo "Error uploading prescription file.";
    }

    // Insert form data into database
    $sql = "INSERT INTO donor_details (fullname, mobileno, emailid, age, gender, organ, blood, nid_card, prescription, address)
            VALUES ('$fullname', '$mobileno', '$emailid', '$age', '$gender', '$organ', '$blood', '$nidPath', '$prescriptionPath', '$address')";
    if (mysqli_query($conn, $sql)) {
        echo "Record inserted successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>
