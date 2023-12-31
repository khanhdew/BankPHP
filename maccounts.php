<?php
global $con;
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
if (isset($_POST['saveAccount'])) {
    if (!$con->query("insert into login (email,password,type) values ('$_POST[email]','$_POST[password]','cashier')")) {
        echo "<div claass='alert alert-success'>Failed. Error is:" . $con->error . "</div>";
    }
}
if (isset($_GET['del']) && !empty($_GET['del'])) {
    $con->query("delete from login where id ='$_GET[del]'");
}
$array = $con->query("select * from login where type='cashier'");

?>
<div class="container">
    <div class="card w-100 text-center shadowBlue">
        <div class="card-header">
            Tài khoản nhân viên
            <button class="btn btn-outline-success btn-sm float-right" data-toggle="modal" data-target="#exampleModal">
                Thêm tài khoản
            </button>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Email</th>
                    <th>Mật khẩu</th>
                    <th>Tài khoản</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php
                if ($array->num_rows > 0) {
                    while ($row = $array->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['email'] . "</td>";
                        echo "<td>" . $row['password'] . "</td>";
                        echo "<td>" . $row['type'] . "</td>";
                        echo "<td><a href='maccounts.php?del=$row[id]' class='btn btn-danger btn-sm'>Xoá</a></td>";
                        echo "</tr>";
                    }
                }
                ?>
                </tbody>
            </table>
        </div>
        <div class="card-footer text-muted">
            <?php echo bankName; ?>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Thêm tài khoản thu ngân</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST">
                        Nhập thông tin tài khoản
                        <input class="form-control w-75 mx-auto" type="email" name="email" required placeholder="Email">
                        <input class="form-control w-75 mx-auto" type="password" name="password" required
                               placeholder="Password">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    <button type="submit" name="saveAccount" class="btn btn-primary">Tạo tài khoản</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>