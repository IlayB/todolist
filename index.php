<style>
    @import url('https://fonts.googleapis.com/css2?family=Andika+New+Basic&display=swap');
</style>
<link rel="stylesheet" href="style.css">

<?php
include('templates/header.php');
$x = 0;
?>


<?php
include('config/db_connect.php');

if (isset($_SESSION['user_id'])) {

    $logedID = $_SESSION['user_id'];

    // -write query for all users
    $sql = "SELECT * FROM (SELECT todo.todo_id, todo.user_id, todo.todo, todo.created_at, todo.complete_status, users.admin_status FROM todo LEFT JOIN users ON users.user_id = todo.user_id) AS viewusers WHERE viewusers.user_id LIKE '$logedID';";

    //make query & get result
    $result = mysqli_query($conn, $sql);

    //fetch the resulting rows as array
    $todo = mysqli_fetch_all($result, MYSQLI_ASSOC);

    //free result from memory
    mysqli_free_result($result);

    //close connection
    mysqli_close($conn);
}

?>

<?php

if (isset($logedID)) {
?>
    <form action="exclude/excluderecord.php" method="POST">
        <table border="1">
            <tr>
                <td class="todohead" style="color:red;">
                    Todo:
                </td>
                <td style="color:red;">
                    Updated at:
                </td>
                <td style="color:red;">
                    Complete:
                </td>
            </tr>
            <?php
            foreach ($todo as $record) {
                if (!$record['complete_status']) {
            ?>
                    <tr>
                        <td class="content">
                            <?php echo $record['todo']; ?>
                        </td>
                        <td class="date">
                            <?php echo $record['created_at']; ?>
                        </td>
                        <td align="center">
                            <input type="checkbox" name="todoid[]" class="checkbox" value="<?php echo $record['todo_id']; ?>">
                            <?php echo $record['todo_id']; ?>
                        </td>
                    </tr>
            <?php }
            } ?>
            <script>
                const list = document.getElementsByClassName('checkbox');
                const todoList = document.getElementsByClassName('content')
                for (let i = 0; i < list.length; i++) {
                    list[i].addEventListener('click', function(ev) {
                        todoList[i].classList.toggle('checked')
                    }, false);
                }
            </script>
        </table>
        <input type="submit" name="submit" value="Delete">
    </form>
<?php
    foreach ($todo as $checkadmin) {
        if ($checkadmin['admin_status']) {
            $_SESSION['admin_status'] = true;
        }
    }
}
if (!isset($logedID)) {
    echo "<h1 align='center'> Welcome to <a style='color:red'>To Do List</a> </br> Please Log In </h1>";
}
include('templates/footer.php');
?>