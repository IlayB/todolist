<?php

include('../config/db_connect.php');

if (empty($_POST['todoid'])) {
    // echo "none of the boxes were checked";
} else {
    $N = count($_POST['todoid']);
    // echo ("You selected $N door(s): ");
    for ($i = 0; $i < $N; $i++) {
        // echo ($_POST['todoid'][$i] . " ");

        $update = $_POST['todoid'][$i];
        $sql = "UPDATE todo SET complete_status = 1 WHERE todo_id= ?;";
        $statement = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($statement, $sql)) {
            header("location: ../index.php?error=statementfailer");
            exit();
        }

        mysqli_stmt_bind_param($statement, "s", $update);
        mysqli_stmt_execute($statement);
        mysqli_stmt_close($statement);

        header("location: ../index.php?error=none");
    }
}
