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
if (isset($_POST['saveAccount'])) {
    if (!$con->query("insert into useraccounts (name,cnic,accountNo,accountType,city,address,email,password,balance,source,number,branch) values ('$_POST[name]','$_POST[cnic]','$_POST[accountNo]','$_POST[accountType]','$_POST[city]','$_POST[address]','$_POST[email]','$_POST[password]','$_POST[balance]','$_POST[source]','$_POST[number]','$_POST[branch]')")) {
        echo "<div claass='alert alert-success'>Failed. Error is:" . $con->error . "</div>";
    } else
        echo "<div class='alert alert-info text-center'>Account added Successfully</div>";

}
if (isset($_GET['del']) && !empty($_GET['del'])) {
    $con->query("delete from login where id ='$_GET[del]'");
}


?>
<div class="container">
    <div class="card w-100 text-center shadowBlue">
        <div class="card-header">
            Tạo tài khoản mới
        </div>
        <div class="card-body bg-dark text-white">
            <table class="table">
                <tbody>
                <tr>
                    <form method="POST">
                        <th>Họ tên</th>
                        <td><input type="text" name="name" class="form-control input-sm" required></td>
                        <th>Số CCCD</th>
                        <td><input type="number" name="cnic" class="form-control input-sm" required></td>
                </tr>
                <tr>
                    <th>Số tài khoản</th>
                    <td><input type="" name="accountNo" readonly value="<?php echo time() ?>"
                               class="form-control input-sm" required></td>
                    <th>Loại tài khoản</th>
                    <td>
                        <select class="form-control input-sm" name="accountType" required>
                            <option value="current" selected>Thanh toán</option>
                            <option value="saving" selected>Tiết kiệm</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>Thành phố</th>
                    <td><input type="text" name="city" class="form-control input-sm" required></td>
                    <th>Địa chỉ</th>
                    <td><input type="text" name="address" class="form-control input-sm" required></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td><input type="email" name="email" class="form-control input-sm" required></td>
                    <th>Mật khẩu</th>
                    <td><input type="password" name="password" class="form-control input-sm" required></td>
                </tr>
                <tr>
                    <th>Số tiền nạp</th>
                    <td><input type="number" name="balance" min="500" class="form-control input-sm" required></td>
                    <th>Nguồn thu nhập</th>
                    <td><input type="text" name="source" class="form-control input-sm" required></td>
                </tr>
                <tr>
                    <th>Số điện thoại</th>
                    <td><input type="number" name="number" class="form-control input-sm" required></td>
                    <th>Chi nhánh</th>
                    <td>
                        <select name="branch" required class="form-control input-sm">
                            <option selected value="">Hãy lựa chọn..</option>
                            <?php
                            $arr = $con->query("select * from branch");
                            if ($arr->num_rows > 0) {
                                while ($row = $arr->fetch_assoc()) {
                                    echo "<option value='$row[branchId]'>$row[branchName]</option>";
                                }
                            } else
                                echo "<option value='1'>Trụ sở chính</option>";
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <button type="submit" name="saveAccount" class="btn btn-primary btn-sm">Tạo tài khoản</button>
                        <button type="Reset" class="btn btn-secondary btn-sm">Reset</button>
                        </form>
                    </td>
                </tr>
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
                    <h5 class="modal-title" id="exampleModalLabel">Tạo tài khoản thu ngân</h5>
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