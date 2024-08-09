<?php include 'db.php'; ?>

<?php
$id = $_GET['id'];
$sql = "SELECT student.name, student.email, student.address, student.created_at, student.image, classes.name as class_name FROM student JOIN classes ON student.class_id = classes.class_id WHERE student.id=$id";
$result = $conn->query($sql);
$student = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Student</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css"> <!-- Include CSS file -->
</head>
<body>
    <div class="container">
        <h1>View Student</h1>
        <?php if ($student): ?>
            <p><strong>Name:</strong> <?php echo htmlspecialchars($student['name']); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($student['email']); ?></p>
            <p><strong>Address:</strong> <?php echo htmlspecialchars($student['address']); ?></p>
            <p><strong>Class:</strong> <?php echo htmlspecialchars($student['class_name']); ?></p>
            <p><strong>Created At:</strong> <?php echo htmlspecialchars($student['created_at']); ?></p>
            <?php if ($student['image']): ?>
                <p><strong>Image:</strong> <img src="uploads/<?php echo htmlspecialchars($student['image']); ?>" width="100" height="100" alt="Student Image"></p>
            <?php else: ?>
                <p>No Image</p>
            <?php endif; ?>
            <a href="index.php" class="btn btn-secondary">Back to List</a>
        <?php else: ?>
            <p>Student not found.</p>
        <?php endif; ?>
    </div>
</body>
</html>

<?php $conn->close(); ?>
