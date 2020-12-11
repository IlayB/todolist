<?php
include('config/db_connect.php');

$todo = $username = "";
$errors = array('username' => '', 'todo' => '');

// if (isset($_POST['submit'])) {
//     echo $_POST['username'] . '<br />';
//     echo $_POST['todo'] . '<br />';
// }

if (isset($_POST['submit'])) {

    // check username
    if (empty($_POST['username'])) {
        $errors['username'] = 'A username is required <br />';
    } else {
        $username = $_POST['username'];
    };
    // check todo
    if (empty($_POST['todo'])) {
        $errors['todo'] = 'A task is required <br />';
    } else {
        $todo = $_POST['todo'];
    };

    if (array_filter($errors)) {
        echo 'errors in the form';
    } else {

        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $todo = mysqli_real_escape_string($conn, $_POST['todo']);

        //create sql
        $sql = "INSERT INTO users(username,todo) VALUES('$username', '$todo')";

        //save to db and check
        if (mysqli_query($conn, $sql)) {
            //success
            header('Location: index.php');
        } else {
            //error
            echo 'query error:' . mysqli_error($conn);
        };
    }
};

include('templates/header.php');
?>

<!DOCTYPE html>
<html>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Andika+New+Basic&display=swap');
</style>
<link rel="stylesheet" href="style.css">

<form action="add.php" method="POST">
    <label>Username: </label></br>
    <input type="text" name="username" value="<?php echo htmlspecialchars($username); ?>"></br>
    <div> <?php echo $errors['username'];  ?></div></br>
    <label>Task: </label></br>
    <input type="text" name="todo" value="<?php echo htmlspecialchars($todo); ?>"></br>
    <div> <?php echo $errors['todo'];  ?></div></br>
    <input type="submit" name="submit" value="Submit">
    <input type="reset" name="Cancel" value="Cancel">
</form>

</html>

<?php
include('templates/footer.php');
?>