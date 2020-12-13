<style>
    @import url('https://fonts.googleapis.com/css2?family=Andika+New+Basic&display=swap');
</style>
<link rel="stylesheet" href="style.css">

<?php
include('templates/header.php');
include('config/db_connect.php');

if (isset($_SESSION['user_id'])) {

    $logedID = $_SESSION['user_id'];

    $sql = "SELECT * FROM todo LEFT JOIN users ON users.user_id = todo.user_id;";
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
include('templates/footer.php');
?>

<?php
if (isset($logedID)) {
?>
    <table border="1">
        <tr>
            <td style="color:red;">
                User ID:
            </td>
            <td style="color:red;">
                Username:
            </td>
            <td style="color:red;">
                Email:
            </td>
            <td style="color:red;">
                Registered at:
            </td>
            <td style="color:red;">
                Admin status:
            </td>
            <td style="color:red; width: 45%;">
                To Do:
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
                    <?php echo $record['user_id']; ?>
                </td>
                <td>
                    <?php echo $record['username']; ?>
                </td>
                <td>
                    <?php echo $record['email']; ?>
                </td>
                <td>
                    <?php echo $record['registered_at']; ?>
                </td>
                <td>
                    <?php echo $record['admin_status']; ?>
                </td>
                <td>
                    <?php echo $record['todo']; ?>
                </td>
                <td>
                    <?php echo $record['created_at']; ?>
                </td>
            </tr>
        <?php } ?>
    </table>
<?php
    foreach ($todo as $checkadmin) {
        if ($checkadmin['admin_status']) {
            $_SESSION['admin_status'] = true;
        }
        exit();
    }
}
