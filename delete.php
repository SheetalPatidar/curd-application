<?php
include("connect_db.php");

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    // Delete data from database
    $stmt = $db->prepare("DELETE FROM php_form.form_info WHERE id = :id");
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
}
