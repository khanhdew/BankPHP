<?php
session_start();
if (!isset($_SESSION['userId'])) {
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
    <?php require 'nav.php'; ?>

</head>
<body style="background:#96D678;background-size: 100%">
<br><br><br>
<div class="container">
    <div class="card  w-75 mx-auto">
        <div class="card-header text-center">
            Notification from Bank
        </div>
        <div class="card-body">
            <?php
            $array = $con->query("select * from notice where userId = '$_SESSION[userId]' order by date desc");
            if ($array->num_rows > 0) {
                while ($row = $array->fetch_assoc()) {
                    echo "<div class='alert alert-success'>$row[notice]</div>";
                }
            } else
                echo "<div class='alert alert-info'>Notice box empty</div>";
            ?>
        </div>
        <div class="card-footer text-muted">
            <?php echo bankName ?>
        </div>
    </div>

</div>
</body>
</html>