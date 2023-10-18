<?php
global $userData, $con;
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
    <?php
    $error = "";
    if (isset($_POST['userLogin'])) {
        $error = "";
        $user = $_POST['email'];
        $pass = $_POST['password'];

        $result = $con->query("select * from userAccounts where email='$user' AND password='$pass'");
        if ($result->num_rows > 0) {
            session_start();
            $data = $result->fetch_assoc();
            $_SESSION['userId'] = $data['id'];
            $_SESSION['user'] = $data;
            header('location:index.php');
        } else {
            $error = "<div class='alert alert-warning text-center rounded-0'>Username or password wrong try again!</div>";
        }
    }

    ?>
</head>
<body style="background:#96D678;background-size: 100%">

<br><br><br>
<div class="container">
    <div class="card  w-75 mx-auto">
        <div class="card-header text-center">
            Chuyển tiền
        </div>
        <div class="card-body">
            <?php
            echo "<form method='POST'>
    <div class='alert alert-success w-50 mx-auto'>
        <h5>Giao dịch chuyển tiền mới</h5>
        <input type='text' name='otherNo' class='form-control' 
            placeholder='Điền số tài khoản người thụ hưởng' required>
        <button type='submit' name='get' class='btn btn-primary btn-block btn-sm my-1'>Xem thông tin</button>
    </div>
</form>";

            if (isset($_POST['get'])) {
                $otherAccountNo = $_POST['otherNo'];

                // Kiểm tra nếu số tài khoản người thụ hưởng là số tài khoản của chính bạn
                if ($otherAccountNo == $userData['accountNo']) {
                    echo "<div class='alert alert-danger w-50 mx-auto'>Không thể chuyển cho chính bạn</div>";
                } else {
                    $array2 = $con->query("select * from otheraccounts where accountNo = '$otherAccountNo'");
                    $array3 = $con->query("select * from userAccounts where accountNo = '$otherAccountNo'");

                    if ($array2->num_rows > 0) {
                        $row2 = $array2->fetch_assoc();
                        echo "<div class='alert alert-success w-50 mx-auto'>
                <form method='POST'>
                    Số tài khoản 
                    <input type='text' value='$row2[accountNo]' name='otherNo' class='form-control ' readonly required>
                    Người thụ hưởng
                    <input type='text' class='form-control' value='$row2[holderName]' readonly required>
                    Ngân hàng thụ hưởng 
                    <input type='text' class='form-control' value='$row2[bankName]' readonly required>
                    Số tiền
                    <input type='number' name='amount' class='form-control' min='1' max='$userData[balance]' required>
                    <button type='submit' name='transfer' class='btn btn-primary btn-block btn-sm my-1'>Chuyển tiền</button>
                </form>
            </div>";
                    } elseif ($array3->num_rows > 0) {
                        $row2 = $array3->fetch_assoc();
                        echo "<div class='alert alert-success w-50 mx-auto'>
                <form method='POST'>
                    Số tài khoản 
                    <input type='text' value='$row2[accountNo]' name='otherNo' class='form-control ' readonly required>
                    Người thụ hưởng
                    <input type='text' class='form-control' value='$row2[name]' readonly required>
                    Ngân hàng thụ hưởng 
                    <input type='text' class='form-control' value='" . bankName . "' readonly required>
                    Số tiền
                    <input type='number' name='amount' class='form-control' min='1' max='$userData[balance]' required>
                    <button type='submit' name='transferSelf' class='btn btn-primary btn-block btn-sm my-1'>Chuyển tiền</button>
                </form>
            </div>";
                    } else {
                        echo "<div class='alert alert-danger w-50 mx-auto'>Số tài khoản $otherAccountNo không tồn tại</div>";
                    }
                }
            }
            ?>

            <br>
            <h5>Lịch sử chuyển tiền</h5>
            <?php
            if (isset($_POST['transferSelf'])) {
                $amount = $_POST['amount'];
                setBalance($amount, 'debit', $userData['accountNo']);
                setBalance($amount, 'credit', $_POST['otherNo']);
                makeTransaction('transfer', $amount, $_POST['otherNo']);
                echo "<script>alert('Transfer Successfull');window.location.href='transfer.php'</script>";
            }
            if (isset($_POST['transfer'])) {
                $amount = $_POST['amount'];
                setBalance($amount, 'debit', $userData['accountNo']);
                makeTransaction('transfer', $amount, $_POST['otherNo']);
                echo "<script>alert('Transfer Successfull');window.location.href='transfer.php'</script>";
            }
            $array = $con->query("select * from transaction where userId = '$userData[id]' AND action = 'transfer' order by date desc");
            if ($array->num_rows > 0) {
                while ($row = $array->fetch_assoc()) {
                    if ($row['action'] == 'transfer') {
                        echo "<div class='alert alert-warning'>Giao dịch chuyển tiền  $row[debit]đ vào $row[date] tới số tài khoản $row[other]</div>";
                    }

                }
            } else
                echo "<div class='alert alert-info'>Bạn chưa tạo giao dịch chuyển tiền!!!</div>";
            ?>
        </div>
        <div class="card-footer text-muted">
            <?php echo bankName ?>
        </div>
    </div>

</div>
</body>
</html>