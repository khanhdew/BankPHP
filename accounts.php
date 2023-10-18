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
            Your account Information
        </div>
        <div class="card-body">
            <table class="table table-striped table-dark w-75 mx-auto">
                <thead>
                <tr>
                    <td scope="col">Số tài khoản</td>
                    <th scope="col"><?php echo $userData['accountNo']; ?></th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th scope="row">Chi nhánh</th>
                    <td><?php echo $userData['branchName']; ?></td>
                </tr>
                <tr>
                    <th scope="row">Mã chi nhánh</th>
                    <td><?php echo $userData['branchNo']; ?></td>
                </tr>
                <tr>
                    <th scope="row">Loại tài khoản</th>
                    <td><?php if ($userData['accountType'] == "current") {
                            echo "Thanh toán";
                        } else {
                            echo "Tiết kiệm";
                        } ?></td>
                </tr>
                <tr>
                    <th scope="row">Thời gian mở tài khoản</th>
                    <td><?php echo $userData['date']; ?></td>
                </tr>
                </tbody>
            </table>

        </div>
        <div class="card-footer text-muted">
            <?php echo bankName ?>
        </div>
    </div>

</div>
</body>
</html>