<?php
session_start();
include 'config/db.php';
include 'functions.php';

if (!isset($_SESSION['user'])) {
    header('Location: auth/login.php');
    exit;
}
$role = $_SESSION['user']['role'];
$can_edit = in_array($role, ['Admin', 'HR']);
$can_delete = $role === 'Admin';

$result = $conn->query("SELECT * FROM employees");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - EMS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body class="fade-in bg-light">
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Welcome, <?= $_SESSION['user']['username'] ?> <small class="text-muted">(<?= $role ?>)</small></h2>
        <a href="auth/logout.php" class="btn btn-outline-danger">Logout</a>
    </div>

    <?php if ($can_edit): ?>
        <a href="add_employee.php" class="btn btn-primary mb-3">➕ Add Employee</a>
    <?php endif; ?>

    <div class="table-responsive shadow-sm">
        <table class="table table-hover table-bordered bg-white">
            <thead class="table-light">
                <tr>
                    <th>Emp Id</th>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Role</th>
                    <th style="width: 150px;">Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= $row['full_name'] ?></td>
                    <td><?= calculateAge($row['dob']) ?></td>
                    <td><?= $row['email'] ?></td>
                    <td><?= $row['phone'] ?></td>
                    <td><?= $row['role'] ?></td>
                    <td>
                        <?php if ($can_edit): ?>
                            <a href="edit_employee.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                        <?php endif; ?>
                        <?php if ($can_delete): ?>
                            <a href="delete_employee.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this employee?')">Delete</a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
