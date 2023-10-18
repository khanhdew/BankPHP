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
        if ($con->query("delete from useraccounts where id = '$_GET[delete]'")) {
            header("location:mindex.php");
        }
    } ?>
</head>
<body style="background:#96D678;background-size: 100%">
<br><br><br>
<div class="container">
    <div class="card w-100 text-center shadowBlue">
        <div class="card-header">
            Tài khoản người dùng
        </div>
        <div class="card-body">
            <table class="table table-bordered table-sm">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Họ tên</th>
                    <th scope="col">Số tài khoản</th>
                    <th scope="col">Chi nhánh</th>
                    <th scope="col">Số dư hiện tại</th>
                    <th scope="col">Loại tài khoản</th>
                    <th scope="col">Liên lạc</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                <?php
                $i = 0;
                $array = $con->query("select * from useraccounts,branch where useraccounts.branch = branch.branchId");
                if ($array->num_rows > 0) {
                    while ($row = $array->fetch_assoc()) {
                        $i++;
                        ?>
                        <tr>
                            <th scope="row"><?php echo $i ?></th>
                            <td><?php echo $row['name'] ?></td>
                            <td><?php echo $row['accountNo'] ?></td>
                            <td><?php echo $row['branchName'] ?></td>
                            <td><?php echo $row['balance'] ?> đ</td>
                            <td><?php
                                if ($row['accountType'] == "saving") {
                                    echo "Tiết kiệm";
                                } else {
                                    echo "Thanh toán";
                                }
                                ?></td>
                            <td><?php echo $row['number'] ?></td>
                            <td>
                                <a href="show.php?id=<?php echo $row['id'] ?>" class='btn btn-success btn-sm'
                                   data-toggle='tooltip' title="Xem thông tin tài khoản">Xem</a>
                                <a href="mnotice.php?id=<?php echo $row['id'] ?>" class='btn btn-primary btn-sm'
                                   data-toggle='tooltip' title="Gửi thông báo cho tài khoản này">Gửi thông báo</a>
                                <a href="mindex.php?delete=<?php echo $row['id'] ?>" class='btn btn-danger btn-sm'
                                   data-toggle='tooltip' title="Xoá tài khoản này">Xoá</a>
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