<?php
include('config/db_connect.php');

$todo = "";
$errors = array('todo' => '');

// if (isset($_POST['submit'])) {
//     echo $_POST['username'] . '<br />';
//     echo $_POST['todo'] . '<br />';
// }

if (isset($_POST['submit'])) {

    // check todo
    if (empty($_POST['todo'])) {
        $errors['todo'] = '<h4 style="color:red" align="center"> A task is required </h4>';
    } else {
        $todo = $_POST['todo'];
    };

    if (!array_filter($errors)) {
        session_start();
        $logedID = $_SESSION['user_id'];

        $todo = mysqli_real_escape_string($conn, $_POST['todo']);

        //create sql
        $sql = "INSERT INTO todo(user_id, todo) VALUES('$logedID','$todo')";

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

<div class="inputform">
    <form action="add.php" method="POST">
        <label>Task: </label></br>
        <textarea type="text" class="todo" name="todo"></textarea></br>
        <div> <?php echo $errors['todo'];  ?></div>
        <input type="submit" name="submit" value="Submit">
        <input type="reset" name="Cancel" value="Cancel">
    </form>
</div>

</html>

<?php
include('templates/footer.php');
?>