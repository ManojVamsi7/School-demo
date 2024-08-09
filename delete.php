<?php include 'db.php'; ?>

<?php
$id = $_GET['id'];
$sql = "SELECT * FROM student WHERE id=$id";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $student = $result->fetch_assoc();
} else {
    echo "Student not found!";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sql = "DELETE FROM student WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        unlink("uploads/" . $student['image']);
        header("Location: index.php");
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Delete Student</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <div class="container">
        <h1>Delete Student</h1>
        <p>Are you sure you want to delete this student?</p>
        <p><strong>Name:</strong> <?php echo $student['name']; ?></p>
        <p><strong>Email:</strong> <?php echo $student['email']; ?></p>
        <p><strong>Class:</strong> <?php echo $student['class_id']; ?></p>
        <p><strong>Image:</strong></p>
        <img src="uploads/<?php echo $student['image']; ?>" width="100">
        <br><br>
        <form method="POST">
            <input type="submit" value="Confirm Delete" class="btn btn-danger">
            <a href="view.php?id=<?php echo $student['id']; ?>" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>

<?php $conn->close(); ?>
