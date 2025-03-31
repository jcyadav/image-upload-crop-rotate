<?php
include 'connection.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM users WHERE id = $id";
    $result = $con->query($sql);
    $row = $result->fetch_assoc();

    if (!$row) {
        echo "User not found!";
        exit();
    }
}

if (isset($_POST['submit'])) {
    $target_dir = "uploads/";

    $photo = !empty($_FILES['photo']['name']) ? $_FILES['photo']['name'] : $_POST['existing_photo'];
    $photo_target = $target_dir . basename($photo);

    $aadhar_front = !empty($_FILES['aadhar_front']['name']) ? $_FILES['aadhar_front']['name'] : $_POST['existing_aadhar_front'];
    $aadhar_front_target = $target_dir . basename($aadhar_front);

    $aadhar_back = !empty($_FILES['aadhar_back']['name']) ? $_FILES['aadhar_back']['name'] : $_POST['existing_aadhar_back'];
    $aadhar_back_target = $target_dir . basename($aadhar_back);

    $driving_licence_front = !empty($_FILES['driving_licence_front']['name']) ? $_FILES['driving_licence_front']['name'] : $_POST['existing_driving_licence_front'];
    $driving_licence_front_target = $target_dir . basename($driving_licence_front);

    $driving_licence_back = !empty($_FILES['driving_licence_back']['name']) ? $_FILES['driving_licence_back']['name'] : $_POST['existing_driving_licence_back'];
    $driving_licence_back_target = $target_dir . basename($driving_licence_back);

    $update_files = true;

    if (!empty($_FILES['photo']['name']) && !move_uploaded_file($_FILES['photo']['tmp_name'], $photo_target)) {
        $update_files = false;
    }
    if (!empty($_FILES['aadhar_front']['name']) && !move_uploaded_file($_FILES['aadhar_front']['tmp_name'], $aadhar_front_target)) {
        $update_files = false;
    }
    if (!empty($_FILES['aadhar_back']['name']) && !move_uploaded_file($_FILES['aadhar_back']['tmp_name'], $aadhar_back_target)) {
        $update_files = false;
    }
    if (!empty($_FILES['driving_licence_front']['name']) && !move_uploaded_file($_FILES['driving_licence_front']['tmp_name'], $driving_licence_front_target)) {
        $update_files = false;
    }
    if (!empty($_FILES['driving_licence_back']['name']) && !move_uploaded_file($_FILES['driving_licence_back']['tmp_name'], $driving_licence_back_target)) {
        $update_files = false;
    }

    if ($update_files) {
        $user_id = $_GET['id'];;

        $sql = "UPDATE users 
                SET photo = '$photo', 
                    aadhar_front = '$aadhar_front', 
                    aadhar_back = '$aadhar_back', 
                    driving_licence_front = '$driving_licence_front', 
                    driving_licence_back = '$driving_licence_back' 
                WHERE id = $user_id";

        if ($con->query($sql) === TRUE) {
            echo "<script>alert('Data Updated successfully!'); window.location.href='index.php';</script>";
        } else {
            echo "Error: " . $sql . "<br>" . $con->error;
        }
    } else {
        echo "Error uploading the images.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://unpkg.com/cropperjs/dist/cropper.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://unpkg.com/cropperjs"></script>
    <style>
        .cropper-container {
            max-width: 100%;
            margin: 10px auto;
        }

        img {
            max-width: 100%;
            height: auto;
        }

        .img-preview {
            width: 100px;
            height: 80px;
            overflow: hidden;
            margin-top: 5px;
        }
    </style>
</head>

<body>

    <div class="container mt-5">
        <h4>Edit User</h4>
        <form method="POST" action="" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-8">
                    <!-- Photo Upload -->
                    <div class="form-group">
                        <label>Photo</label>
                        <input type="file" id="photo" class="form-control"><br>
                        <div class="img-preview">
                            <img id="photo-preview" src="uploads/<?php echo($row['photo']); ?>" width="100" height="80">
                        </div>
                        <button type="button" class="btn btn-warning crop-btn" data-target="photo-preview">Crop</button>
                        <button type="button" class="btn btn-info rotate-btn" data-target="photo-preview">Rotate</button>
                    </div>

                    <!-- Aadhar Front Upload -->
                    <div class="form-group">
                        <label>Aadhar Front</label>
                        <input type="file" id="aadhar_front" class="form-control"><br>
                        <div class="img-preview">
                            <img id="aadhar-front-preview" src="uploads/<?php echo($row['aadhar_front']); ?>" width="100"
                                height="80">
                        </div>
                        <button type="button" class="btn btn-warning crop-btn"
                            data-target="aadhar-front-preview">Crop</button>
                        <button type="button" class="btn btn-info rotate-btn"
                            data-target="aadhar-front-preview">Rotate</button>
                    </div>

                    <!-- Aadhar Back Upload -->
                    <div class="form-group">
                        <label>Aadhar Back</label>
                        <input type="file" id="aadhar_back" class="form-control"><br>
                        <div class="img-preview">
                            <img id="aadhar-back-preview" src="uploads/<?php echo($row['aadhar_back']); ?>" width="100"
                                height="80">
                        </div>
                        <button type="button" class="btn btn-warning crop-btn"
                            data-target="aadhar-back-preview">Crop</button>
                        <button type="button" class="btn btn-info rotate-btn"
                            data-target="aadhar-back-preview">Rotate</button>
                    </div>

                    <!-- Driving Licence Front Upload -->
                    <div class="form-group">
                        <label>Driving Licence Front</label>
                        <input type="file" id="driving_licence_front" class="form-control"><br>
                        <div class="img-preview">
                            <img id="driving-licence-front-preview"
                                src="uploads/<?php echo($row['driving_licence_front']); ?>" width="100" height="80">
                        </div>
                        <button type="button" class="btn btn-warning crop-btn"
                            data-target="driving-licence-front-preview">Crop</button>
                        <button type="button" class="btn btn-info rotate-btn"
                            data-target="driving-licence-front-preview">Rotate</button>
                    </div>

                    <!-- Driving Licence Back Upload -->
                    <div class="form-group">
                        <label>Driving Licence Back</label>
                        <input type="file" id="driving_licence_back" class="form-control"><br>
                        <div class="img-preview">
                            <img id="driving-licence-back-preview" src="uploads/<?php echo($row['driving_licence_back']); ?>"
                                width="100" height="80">
                        </div>
                        <button type="button" class="btn btn-warning crop-btn"
                            data-target="driving-licence-back-preview">Crop</button>
                        <button type="button" class="btn btn-info rotate-btn"
                            data-target="driving-licence-back-preview">Rotate</button>
                    </div>

                    <button type="submit" class="btn btn-primary" name="submit">Update</button>
                    <a href="index.php" class="btn btn-secondary">Back</a>
                </div>
            </div>
        </form>
    </div>

    <script>
        let cropperInstances = {};

        // Initialize cropper for a given image
        function initCropper(imageId) {
            const imageElement = document.getElementById(imageId);

            // Destroy existing cropper instance if it exists
            if (cropperInstances[imageId]) {
                cropperInstances[imageId].destroy();
                cropperInstances[imageId] = null;
            }

            // Initialize new cropper
            cropperInstances[imageId] = new Cropper(imageElement, {
                aspectRatio: 1,
                viewMode: 1,
                autoCropArea: 1,
                movable: true,
                scalable: true,
                zoomable: true
            });
        }

        // Handle file selection and preview
        function handleFileSelect(inputId, previewId) {
            document.getElementById(inputId).addEventListener('change', function (event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        const previewElement = document.getElementById(previewId);
                        previewElement.src = e.target.result;

                        // Re-initialize cropper on file change
                        initCropper(previewId);
                    };
                    reader.readAsDataURL(file);
                }
            });
        }

        // Initialize file inputs
        handleFileSelect('photo', 'photo-preview');
        handleFileSelect('aadhar_front', 'aadhar-front-preview');
        handleFileSelect('aadhar_back', 'aadhar-back-preview');
        handleFileSelect('driving_licence_front', 'driving-licence-front-preview');
        handleFileSelect('driving_licence_back', 'driving-licence-back-preview');

        // Crop button functionality
        document.querySelectorAll('.crop-btn').forEach(button => {
            button.addEventListener('click', function () {
                const imageId = this.getAttribute('data-target');
                const cropper = cropperInstances[imageId];

                if (cropper) {
                    const canvas = cropper.getCroppedCanvas();
                    if (canvas) {
                        document.getElementById(imageId).src = canvas.toDataURL("image/png");

                        // Destroy cropper after cropping to reset
                        cropperInstances[imageId].destroy();
                        cropperInstances[imageId] = null;
                    }
                }
            });
        });

        // Rotate button functionality
        document.querySelectorAll('.rotate-btn').forEach(button => {
            button.addEventListener('click', function () {
                const imageId = this.getAttribute('data-target');
                const cropper = cropperInstances[imageId];

                if (cropper) {
                    cropper.rotate(90); // Rotate image by 90 degrees
                }
            });
        });
    </script>

</body>

</html>



