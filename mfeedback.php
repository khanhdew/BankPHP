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
        if ($con->query("delete from feedback where feedbackId = '$_GET[delete]'")) {
            header("location:mfeedback.php");
        }
    } ?>
</head>
<body style="background:#96D678;background-size: 100%">
<br><br><br>
<div class="container">
    <div class="card w-100 text-center shadowBlue">
        <div class="card-header">
            Đánh giá từ khách hàng
        </div>
        <div class="card-body">
            <table class="table table-bordered table-sm bg-dark text-white">
                <thead>
                <tr>
                    <th scope="col">Từ</th>
                    <th scope="col">Số tài khoản</th>
                    <th scope="col">Liên lạc</th>
                    <th scope="col">Đánh giá</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                <?php
                $i = 0;
                $array = $con->query("select * from useraccounts,feedback where useraccounts.id = feedback.userId");
                if ($array->num_rows > 0) {
                    while ($row = $array->fetch_assoc()) {
                        ?>
                        <tr>
                            <td><?php echo $row['name'] ?></td>
                            <td><?php echo $row['accountNo'] ?></td>
                            <td><?php echo $row['number'] ?></td>
                            <td><?php echo $row['message'] ?></td>
                            <td>
                                <a href="mfeedback.php?delete=<?php echo $row['feedbackId'] ?>"
                                   class='btn btn-danger btn-sm' data-toggle='tooltip' title="Xoá đánh giá này">Xoá</a>
                            </td>

                        </tr>
                        <?php
                    }
                }
                ?>
                </tbody>
            </table>
            <div class="card-footer text-muted">
                <?php echo bankName; ?>
            </div>
        </div>
</body>
</html>