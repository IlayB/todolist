<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="templates/templates-style.css">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ToDoList</title>
</head>

<div class="header">
    <a href="http://localhost/todo/" class="logo">To Do List</a>
    <div class="header-right">
        <?php
        if (isset($_SESSION["user_id"])) {
        ?>
            <a class="active" href="add.php">Add</a>
            <a href="include/logout.inc.php">Logout</a>
        <?php
        } else {
        ?> <a class="navbar" href="register.php">Register</a>
            <a class="navbar" href="login.php">Login</a>
        <?php }; ?>
    </div>
</div>

<body>