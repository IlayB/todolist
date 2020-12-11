<?php
$conn = mysqli_connect('localhost', 'Ilay', 'test1234', 'todolist');

if (!$conn) {
    echo 'Connection error:' . mysqli_connect_error();
};
