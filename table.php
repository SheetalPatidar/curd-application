<?php
include("connect_db.php");

// define variables and set to empty values
$nameErr = $emailErr = $phoneErr = $addressErr = "";
$name = $email = $phone = $address = "";

// form validation
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  } else {
    $name = test_input($_POST["name"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
      $nameErr = "Only letters and white space allowed";
    }
  }

  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
    // check if email address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
    }
  }

  if (empty($_POST["phone"])) {
    $phoneErr = "Phone number is required";
  } else {
    $phone = test_input($_POST["phone"]);
    // check if phone number is valid
    if (!preg_match("/^[0-9]{10}$/", $phone)) {
      $phoneErr = "Invalid phone number";
    }
  }

  if (empty($_POST["address"])) {
    $addressErr = "Address is required";
  } else {
    $address = test_input($_POST["address"]);
  }



  // Prepare and execute SQL statement
  $stmt = $db->prepare("INSERT INTO php_form.form_info (name, email, phone, address) VALUES (:name, :email, :phone, :address)");
  $stmt->bindParam(':name', $_POST['name']);
  $stmt->bindParam(':email', $_POST['email']);
  $stmt->bindParam(':phone', $_POST['phone']);
  $stmt->bindParam(':address', $_POST['address']);

  if ($stmt->execute()) {
    echo "Success! The data has been inserted into the database";
  } else {
    echo  "Error: The data could not be inserted into the database";
  }
}

// function to sanitize user input
function test_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $name_parts = explode(" ", $data);
  foreach ($name_parts as &$name_part) {
    $name_part = htmlspecialchars($name_part);
  }
  $data = implode(" ", $name_parts);
  return $data;
}
?>

<!DOCTYPE html>
<html>

<head>
  <title>View Form Data</title>
  <!-- Add Bootstrap stylesheet -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
  <div class="container mt-5">
    <h2>View Form Data</h2>
    <table class="table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Email</th>
          <th>Phone</th>
          <th>Address</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php
        include("connect_db.php");
        // Fetch data from database
        $stmt = $db->query("SELECT * FROM php_form.form_info");
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
          echo "<tr>";
          echo "<td>" . $row['id'] . "</td>";
          echo "<td>" . $row['name'] . "</td>";
          echo "<td>" . $row['email'] . "</td>";
          echo "<td>" . $row['phone'] . "</td>";
          echo "<td>" . $row['address'] . "</td>";
          echo "<td>";
          echo "<a href='edit.php?id=" . $row['id'] . "' class='btn btn-primary btn-sm'>Edit</a> ";
          echo "<button type='button' class='btn btn-danger btn-sm' data-toggle='modal' data-target='#deleteModal' data-id='" . $row['id'] . "' onclick='deleteData(" . $row['id'] . ")'>Delete</button>";

          echo "</td>";
          echo "</tr>";
        }
        ?>

        <script>
          function deleteData(id) {
            // Send AJAX request to server-side script to delete data
            $.ajax({
              url: 'delete.php',
              type: 'POST',
              data: {
                id: id
              },
              success: function(data) {
                alert("User terminated!");
                // Reload the page after deleting the data
                location.reload();
              }
            });
          }
        </script>

      </tbody>
    </table>
  </div>

  <!-- Add Bootstrap script -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>