<?php include 'db.php'; ?>

<?php
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
            } else {
                echo "Only JPG and PNG files are allowed.";
                exit;
            }
        } else {
            $image = NULL; // No image uploaded
        }

        $sql = "INSERT INTO student (name, email, address, class_id, image) VALUES ('$name', '$email', '$address', $class_id, '$image')";
        if ($conn->query($sql) === TRUE) {
            header("Location: index.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Please fill all required fields.";
    }
}

$classes = $conn->query("SELECT * FROM classes");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Student</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css"> <!-- Include CSS file -->
</head>
<body>
    <div class="container">
        <h1>Add Student</h1>
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label>Name:</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Email:</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Address:</label>
                <textarea name="address" class="form-control" required></textarea>
            </div>
            <div class="form-group">
                <label>Class:</label>
                <select name="class_id" class="form-control">
                    <?php while($row = $classes->fetch_assoc()): ?>
                        <option value="<?php echo $row['class_id']; ?>"><?php echo $row['name']; ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="form-group">
                <label>Image:</label>
                <input type="file" name="image" accept="image/*" class="form-control">
            </div>
            <input type="submit" value="Add Student" class="btn btn-primary">
        </form>
    </div>
</body>
</html>

<?php $conn->close(); ?>
