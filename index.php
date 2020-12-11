<style>
    @import url('https://fonts.googleapis.com/css2?family=Andika+New+Basic&display=swap');
</style>
<link rel="stylesheet" href="style.css">

<?php
include('templates/header.php');
?>


<?php
include('config/db_connect.php');

// -write query for all pizzas
$sql = 'SELECT * FROM users';

//make query & get result
$result = mysqli_query($conn, $sql);

//fetch the resulting rows as array
$todo = mysqli_fetch_all($result, MYSQLI_ASSOC);

//free result from memory
mysqli_free_result($result);

//close connection
mysqli_close($conn);
?>
<table border="1">
    <tr>
        <td style="color:red;">
            User:
        </td>
        <td style="color:red;">
            Todo:
        </td>
    </tr>
    <?php
    foreach ($todo as $record) {
    ?>
        <tr>
            <td>
                <?php echo $record['username']; ?>
            </td>
            <td>
                <?php echo $record['todo']; ?>
            </td>
        </tr>
    <?php } ?>
</table>

<?php
include('templates/footer.php');
?>