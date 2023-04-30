
<?php
$host = 'localhost';
$dbname = 'php_form';
$username = 'root';
$password = '';

// Create new PDO instance
try {
    $db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
} catch (PDOException $e) {
    echo "Error connecting to database: " . $e->getMessage();
    exit();
}
?>
