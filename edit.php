<?php include 'db.php'; ?>

<?php
$id = $_GET['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $class_id = $_POST['class_id'];
    $image = $_FILES['image']['name'];

    if (!empty($name) && !empty($email) && !empty($address) && !empty($class_id)) {
        if (!empty($image)) {
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($image);
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            // Validate image format
            if ($imageFileType == "jpg" || $imageFileType == "png") {
                move_uploaded_file($_FILES['image']['tmp_name'], $target_file);
                
                // Delete old image if it exists
                $sql = "SELECT image FROM student WHERE id=$id";
                $result = $conn->query($sql);
                $old_image = $result->fetch_assoc()['image'];
                if ($old_image && file_exists("uploads/" . $old_image)) {
                    unlink("uploads/" . $old_image);
                }
            } else {
                echo "Only JPG and PNG files are allowed.";
                exit;
            }
        } else {
            $image = NULL; // No new image uploaded
        }

        $sql = "UPDATE student SET name='$name', email='$email', address='$address', class_id=$class_id, image='$image' WHERE id=$id";
        if ($conn->query($sql) === TRUE) {
            header("Location: index.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Please fill all required fields.";
    }
}

$student = $conn->query("SELECT * FROM student WHERE id=$id")->fetch_assoc();
$classes = $conn->query("SELECT * FROM classes");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Student</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css"> <!-- Include CSS file -->
</head>
<body>
    <div class="container">
        <h1>Edit Student</h1>
        <?php if ($student): ?>
            <form method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Name:</label>
                    <input type="text" name="name" class="form-control" value="<?php echo htmlspecialchars($student['name']); ?>" required>
                </div>
                <div class="form-group">
                    <label>Email:</label>
                    <input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($student['email']); ?>" required>
                </div>
                <div class="form-group">
                    <label>Address:</label>
                    <textarea name="address" class="form-control" required><?php echo htmlspecialchars($student['address']); ?></textarea>
                </div>
                <div class="form-group">
                    <label>Class:</label>
                    <select name="class_id" class="form-control" required>
                        <?php while($row = $classes->fetch_assoc()): ?>
                            <option value="<?php echo $row['class_id']; ?>" <?php echo $row['class_id'] == $student['class_id'] ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($row['name']); ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Image:</label>
                    <input type="file" name="image" accept="image/*" class="form-control">
                    <?php if ($student['image']): ?>
                        <p>Current Image: <img src="uploads/<?php echo htmlspecialchars($student['image']); ?>" width="100" height="100" alt="Student Image"></p>
                    <?php endif; ?>
                </div>
                <input type="submit" value="Update Student" class="btn btn-primary">
            </form>
        <?php else: ?>
            <p>Student not found.</p>
        <?php endif; ?>
    </div>
</body>
</html>

<?php $conn->close(); ?>
