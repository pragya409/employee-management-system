<?php
session_start();
include 'config/db.php';
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'Admin') {
    header('Location: dashboard.php');
    exit;
}
$id = $_GET['id'];
$conn->query("DELETE FROM employees WHERE id=$id");
header("Location: dashboard.php");
?>