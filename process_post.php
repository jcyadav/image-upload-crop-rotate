<?php
include 'connection.php';

if (isset($_POST['submit'])) {
    $target_dir = "uploads/";

    $photo = $_FILES['photo']['name'];
    $photo_target = $target_dir . basename($photo);
    $aadhar_front = $_FILES['aadhar_front']['name'];
    $aadhar_front_target = $target_dir . basename($aadhar_front);
    $aadhar_back = $_FILES['aadhar_back']['name'];
    $aadhar_back_target = $target_dir . basename($aadhar_back);
    $driving_licence_front = $_FILES['driving_licence_front']['name'];
    $driving_licence_front_target = $target_dir . basename($driving_licence_front);
    $driving_licence_back = $_FILES['driving_licence_back']['name'];
    $driving_licence_back_target = $target_dir . basename($driving_licence_back);

    if (move_uploaded_file($_FILES['photo']['tmp_name'], $photo_target) && 
        move_uploaded_file($_FILES['aadhar_front']['tmp_name'], $aadhar_front_target) && 
        move_uploaded_file($_FILES['aadhar_back']['tmp_name'], $aadhar_back_target) && 
        move_uploaded_file($_FILES['driving_licence_front']['tmp_name'], $driving_licence_front_target) && 
        move_uploaded_file($_FILES['driving_licence_back']['tmp_name'], $driving_licence_back_target)) {

        $sql = "INSERT INTO users (photo, aadhar_front, aadhar_back, driving_licence_front, driving_licence_back) 
                VALUES ('$photo', '$aadhar_front', '$aadhar_back', '$driving_licence_front', '$driving_licence_back')";

        if ($con->query($sql) === TRUE) {
             echo "<script>alert('Date Saved successfully!'); window.location.href='index.php';</script>";
        } else {
            echo "Error: " . $sql . "<br>" . $con->error;
        }
    } else {
        echo "Error uploading the images.";
    }
}
?>
