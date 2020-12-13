<?php
if (isset($_SESSION['user_id'])) {

    $sql = "SELECT todo.todo_id, todo.user_id, todo.todo, todo.created_at, users.admin_status, users.user_id FROM todo LEFT JOIN users ON users.user_id = todo.user_id;";
    $stmt = mysqli_stmt_init($conn);

    //make query & get result
    $res = mysqli_query($conn, $sql);

    //fetch the resulting rows as array
    $todo = mysqli_fetch_all($res, MYSQLI_ASSOC);

    //free result from memory
    mysqli_free_result($res);

    //close connection
    mysqli_close($conn);
}

$admin = $_SESSION['admin_status'];
echo $admin;
