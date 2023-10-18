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
            Help Card
        </div>
        <div class="card-body">
            <form method="POST">
                <div class="alert alert-success w-50 mx-auto">
                    <h5>Enter your message</h5>
                    <textarea class="form-control" name="msg" required placeholder="Write your message"></textarea>
                    <button type="submit" name="send" class="btn btn-primary btn-block btn-sm my-1">Send</button>
                </div>
            </form>

            <br>

            <?php
            if (isset($_POST['send'])) {
                if ($con->query("insert into feedback (message,userId) values ('$_POST[msg]','$_SESSION[userId]')")) {
                    echo "<div class='alert alert-success'>Successfully send</div>";
                } else
                    echo "<div class='alert alert-danger'>Not sent Error is:" . $con->error . "</div>";
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