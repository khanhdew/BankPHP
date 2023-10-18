<?php
session_start();
if (!isset($_SESSION['managerId'])) {
    header('location:welcome.php');
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Banking</title>
    <?php require 'assets/autoloader.php'; ?>
    <?php require 'assets/db.php'; ?>
    <?php require 'assets/function.php'; ?>
    <?php require 'mnav.php'; ?>
    <?php if (isset($_GET['delete'])) {
        if ($con->query("delete from useraccounts where id = '$_GET[id]'")) {
            header("location:mindex.php");
        }
    } ?>
</head>
<body style="background:#96D678;background-size: 100%">
<br><br><br>
<?php
$array = $con->query("select * from useraccounts where id = '$_GET[id]'");
$row = $array->fetch_assoc();


?>
<div class="container">
    <div class="card w-100 text-center shadowBlue">
        <div class="card-header">
            Gửi thông báo đến <?php echo $row['name'] ?>
        </div>
        <div class="card-body">
            <form method="POST">
                <div class="alert alert-success w-50 mx-auto">
                    <h5>Viết thông báo cho <?php echo $row['name'] ?></h5>
                    <input type="hidden" name="userId" value="<?php echo $row['id'] ?>">
                    <textarea class="form-control" name="notice" required placeholder="Viết thông báo"></textarea>
                    <button type="submit" name="send" class="btn btn-primary btn-block btn-sm my-1">Send</button>
                </div>
            </form><?php
            if (isset($_POST['send'])) {
                if ($con->query("insert into notice (notice,userId) values ('$_POST[notice]','$_POST[userId]')")) {
                    echo "<div class='alert alert-success'>Gửi thành công</div>";
                } else
                    echo "<div class='alert alert-danger'>Gửi không thành công:" . $con->error . "</div>";
            }

            ?>
        </div>
        <div class="card-footer text-muted">
            <?php echo bankName; ?>
        </div>
    </div>

</body>
</html>