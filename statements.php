<?php
global $con;
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
            Lịch sử giao dịch
        </div>
        <div class="card-body">
            <?php
            $array = $con->query("select * from transaction where userId = '$userData[id]' order by date desc");
            if ($array->num_rows > 0) {
                while ($row = $array->fetch_assoc()) {
                    if ($row['action'] == 'withdraw') {
                        echo "<div class='alert alert-secondary'>Bạn đã rút $row[debit]đ từ tài khoản vào $row[date]</div>";
                    }
                    if ($row['action'] == 'deposit') {
                        echo "<div class='alert alert-success'>Bạn đã nạp $row[credit]đ vào tài khoản vào $row[date]</div>";
                    }
                    if ($row['action'] == 'deduction') {
                        echo "<div class='alert alert-danger'>Tài khoản của bạn bị khấu trừ $row[debit]đ vào $row[date] phòng khi $row[other]</div>";
                    }
                    if ($row['action'] == 'transfer') {
                        echo "<div class='alert alert-warning'>Bạn đã chuyển $row[debit]đ từ tài khoản của bạn vào $row[date] đến số tài khoản $row[other]</div>";
                    }
                }
            } else {
                echo "<div class='alert alert-info'>Bạn chưa thực hiện giao dịch nào</div>";
            }
            ?>
        </div>
        <div class="card-footer text-muted">
            <?php echo bankName ?>
        </div>
    </div>


</div>
</body>
</html>