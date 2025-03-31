<?php
include 'connection.php';

$limit = 5; 
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $limit;

$total_sql = "SELECT COUNT(id) AS total FROM users";
$total_result = $con->query($total_sql);
$total_row = $total_result->fetch_assoc();
$total_users = $total_row['total'];

$total_pages = ceil($total_users / $limit);

$sql = "SELECT * FROM users ORDER BY created_at DESC LIMIT $limit OFFSET $offset";
$result = $con->query($sql);

if (isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];
    $delete_sql = "DELETE FROM users WHERE id = $id";

    if ($con->query($delete_sql)) {
        echo "<script>alert('User Deleted successfully!'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Error Deleting User. Please try again.');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>All Users</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

<div class="container mt-5">
    <h2 class="text-center mb-4">All Users</h2>
    <a href="add_user.php" class="btn btn-primary mb-3">Add New User</a>

    <table class="table table-bordered table-striped">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Aadhar Front</th>
                <th>Aadhar Back</th>
                <th>Driving Licence Front</th>
                <th>Driving Licence Back</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()) { ?>                         
                    <td><?php echo $row['id']; ?></td>
                    <td>
                        <img src="uploads/<?php echo($row['photo']); ?>" alt="Blog Image" width="100" height="80">
                    </td>
                    <td>
                        <img src="uploads/<?php echo($row['aadhar_front']); ?>" alt="Blog Image" width="100" height="80">
                    </td>
                    <td>
                        <img src="uploads/<?php echo($row['aadhar_back']); ?>" alt="Blog Image" width="100" height="80">
                    </td>
                   <td>
                        <img src="uploads/<?php echo($row['driving_licence_front']); ?>" alt="Blog Image" width="100" height="80">
                    </td>
                     <td>
                        <img src="uploads/<?php echo($row['driving_licence_back']); ?>" alt="Blog Image" width="100" height="80">
                    </td>
                    <td>
                        <a href="edit_user.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="index.php?delete_id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <nav>
        <ul class="pagination justify-content-center">
            <?php if ($page > 1) { ?>
                <li class="page-item">
                    <a class="page-link" href="?page=<?php echo $page - 1; ?>">Previous</a>
                </li>
            <?php } ?>

            <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
                <li class="page-item <?php if ($i == $page) echo 'active'; ?>">
                    <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                </li>
            <?php } ?>

            <?php if ($page < $total_pages) { ?>
                <li class="page-item">
                    <a class="page-link" href="?page=<?php echo $page + 1; ?>">Next</a>
                </li>
            <?php } ?>
        </ul>
    </nav>
</div>

</body>
</html>
