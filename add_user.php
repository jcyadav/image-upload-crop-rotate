<!DOCTYPE html>
<html>
<head>
    <title>Add User</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h4>Add New User</h4>
    <form method="POST" action="process_post.php" enctype="multipart/form-data">
       <div class="container">
           <div class="row">
               <div class="col-md-8">
                    <div class="form-group">
                        <label>Image</label>
                        <input type="file" name="photo" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Aadhar Front</label>
                        <input type="file" name="aadhar_front" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Aadhar Back</label>
                        <input type="file" name="aadhar_back" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Driving Licence Front</label>
                        <input type="file" name="driving_licence_front" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Driving Licence Back</label>
                        <input type="file" name="driving_licence_back" class="form-control" required>
                    </div>
        
                    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                    <a href="index.php" class="btn btn-secondary">Back</a>
               </div>
           </div>
       </div>
    </form>
</div>
</body>
</html>
