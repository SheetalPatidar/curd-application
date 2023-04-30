<?php
include("connect_db.php");

// Check if form is submitted
if(isset($_POST['submit'])) {
    // Get form data
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    // Update data in database
    $stmt = $db->prepare("UPDATE php_form.form_info SET name = ?, email = ?, phone = ?, address = ? WHERE id = ?");
    $stmt->execute([$name, $email, $phone, $address, $id]);

    // Redirect back to view data page
    header("Location: table.php");
    exit();
}

// Check if ID is passed in URL parameter
if(isset($_GET['id'])) {
    // Retrieve record from database
    $stmt = $db->prepare("SELECT * FROM php_form.form_info WHERE id = ?");
    $stmt->execute([$_GET['id']]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
}
    // Display edit form
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Edit Form Data</title>
        <!-- Add Bootstrap stylesheet -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    </head>
    <body>
        <div class="container mt-5">
            <h2>Edit Form Data</h2>
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?php echo $row['name']; ?>">
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $row['email']; ?>">
                </div>
                <div class="form-group">
                    <label for="phone">Phone:</label>
                    <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $row['phone']; ?>">
                </div>
                <div class="form-group">
                    <label for="address">Address:</label>
                    <textarea class="form-control" id="address" name="address"><?php echo $row['address']; ?></textarea>
                </div>
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                <button type="submit" name="submit" class="btn btn-primary">Save Changes</button>
                <a href="view_data.php" class="btn btn-secondary ml-2">Cancel</a>
            </form>
        </div>

       
