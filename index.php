<style>
    @import url('https://fonts.googleapis.com/css2?family=Andika+New+Basic&display=swap');
</style>
<link rel="stylesheet" href="style.css">

<?php
include('templates/header.php');
?>


<?php
include('config/db_connect.php');

if (isset($_SESSION['user_id'])) {

    $logedID = $_SESSION['user_id'];

    // -write query for all pizzas
    $sql = "SELECT * FROM todo WHERE user_id = ('$logedID');";

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
    <table border="1">
        <tr>
            <td class="todohead" style="color:red;">
                Todo:
            </td>
            <td style="color:red;">
                Created at:
            </td>
        </tr>
        <?php
        foreach ($todo as $record) {
        ?>
            <tr>
                <td>
                    <?php echo $record['todo']; ?>
                </td>
                <td class="date">
                    <?php echo $record['created_at']; ?>
                </td>
            </tr>
        <?php } ?>
    </table>
<?php
} else {
    echo "<h1 align='center'> Welcome to <a style='color:red'>To Do List</a> </br> Please Log In </h1>";
}
?>



<?php
include('templates/footer.php');
?>