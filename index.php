<?php include 'db.php'; ?>

<?php
$sql = "SELECT student.id, student.name, student.email, student.created_at, student.image, classes.name as class_name FROM student JOIN classes ON student.class_id = classes.class_id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student List</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('images/background.jpg'); /* Path to your wallpaper image */
            background-size: cover; /* Scale the image to cover the entire background */
            background-attachment: fixed; /* Keep the background image fixed during scrolling */
            background-repeat: no-repeat; /* Prevent the image from repeating */
            margin: 0;
            padding: 0;
        }
        .container {
            background-color: rgba(211, 211, 211, 0.8); /* Semi-transparent white background */
            padding: 20px;
            border-radius: 10px;
            margin-top: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Optional: Add a shadow for better visibility */
        }
        table {
            background-color: #fff; /* Ensure table background is white */
        }
        img {
            border-radius: 50%; /* Optional: Round the image */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Student List</h1>
        <a href="create.php" class="btn btn-primary">Add Student</a>
        <a href="classes.php" class="btn btn-secondary">Manage Classes</a>
        <table class="table table-bordered mt-3">
            <thead class="thead-dark">
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Class</th>
                    <th>Created At</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                        <td><?php echo htmlspecialchars($row['class_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['created_at']); ?></td>
                        <td>
                            <?php if ($row['image']): ?>
                                <img src="uploads/<?php echo htmlspecialchars($row['image']); ?>" width="50" height="50" alt="Student Image">
                            <?php else: ?>
                                No Image
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="view.php?id=<?php echo htmlspecialchars($row['id']); ?>" class="btn btn-info btn-sm">View</a>
                            <a href="edit.php?id=<?php echo htmlspecialchars($row['id']); ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="delete.php?id=<?php echo htmlspecialchars($row['id']); ?>" class="btn btn-danger btn-sm">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php $conn->close(); ?>
