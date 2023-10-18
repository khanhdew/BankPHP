<?php
session_start();
if (!isset($_SESSION['cashId'])) {
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
    <?php require 'cnav.php'; ?>
    <?php $note = "";
    if (isset($_POST['withdrawOther'])) {
        $accountNo = $_POST['otherNo'];
        $checkNo = $_POST['checkno'];
        $amount = $_POST['amount'];
        if (setOtherBalance($amount, 'debit', $accountNo))
            $note = "<div class='alert alert-success'>successfully transaction done</div>";
        else
            $note = "<div class='alert alert-danger'>Failed</div>";

    }
    if (isset($_POST['withdraw'])) {
        setBalance($_POST['amount'], 'debit', $_POST['accountNo']);
        makeTransactionCashier('withdraw', $_POST['amount'], $_POST['checkno'], $_POST['userId']);
        $note = "<div class='alert alert-success'>successfully transaction done</div>";

    }
    if (isset($_POST['deposit'])) {
        setBalance($_POST['amount'], 'credit', $_POST['accountNo']);
        makeTransactionCashier('deposit', $_POST['amount'], $_POST['checkno'], $_POST['userId']);
        $note = "<div class='alert alert-success'>successfully transaction done</div>";

    }
    ?>
</head>
<body style="background:#96D678;background-size: 100%">
<br><br><br>
<div class="row w-100" style="padding: 11px">
    <div class="col">
        <div class="card text-center w-75 mx-auto">
            <div class="card-header">
                Account Information
            </div>
            <div class="card-body">
                <p class="card-text"><?php echo $note; ?>
                <form method="POST">
                    <div class="alert alert-success w-50 mx-auto">
                        <h5>Enter Account Number</h5>
                        <input type="text" name="otherNo" class="form-control " placeholder="Enter  Account number"
                               required>
                        <button type="submit" name="get" class="btn btn-primary btn-bloc btn-sm my-1">Get Account Info
                        </button>
                    </div>
                </form>
                </p>
                <?php if (isset($_POST['get'])) {
                    $array2 = $con->query("select * from otheraccounts where accountNo = '$_POST[otherNo]'");
                    $array3 = $con->query("select * from userAccounts where accountNo = '$_POST[otherNo]'");
                    {
                        if ($array2->num_rows > 0) {
                            $row2 = $array2->fetch_assoc();
                            echo "<div class='row'>
                  <div class='col'>
                  <form method='POST'>
                    Số tài khoản 
                    <input type='text' value='$row2[accountNo]' name='otherNo' class='form-control ' readonly required>
                    Người thụ hưởng
                    <input type='text' class='form-control' value='$row2[holderName]' readonly required>
                    Ngân hàng thụ hưởng 
                    <input type='text' class='form-control' value='$row2[bankName]' readonly required>
                     
                  
                  </div>
                  <div class='col'>
                    Bank Balance
                    <input type='text' class='form-control my-1'  value='Rs.$row2[balance]' readonly required>
                    <input type='number' class='form-control my-1' name='checkno' placeholder='Write Check Number' required>
                    <input type='number' class='form-control my-1' name='amount' placeholder='Write Amount' max='$row2[balance]' required>
                   <button type='submit' name='withdrawOther' class='btn btn-success btn-bloc btn-sm my-1'> Withdraw</button></form>
                  </div>
                </div>";
                        } elseif ($array3->num_rows > 0) {
                            $row2 = $array3->fetch_assoc();
                            echo "
            <div class='row'>
                  <div class='col'>
                  
                    Số tài khoản 
                    <input type='text' value='$row2[accountNo]' name='otherNo' class='form-control ' readonly required>
                    Người thụ hưởng
                    <input type='text' class='form-control' value='$row2[name]' readonly required>
                    Ngân hàng thụ hưởng 
                    <input type='text' class='form-control' value='" . bankName . "' readonly required>Bank Balance
                    <input type='text' class='form-control my-1'  value='Rs.$row2[balance]' readonly required>
                     
                  
                  </div>
                  <div class='col'>
                    Transaction Process.
                    <form method='POST'>
                     
                    <input type='hidden' value='$row2[accountNo]' name='accountNo' class='form-control ' required>
                    <input type='hidden' value='$row2[id]' name='userId' class='form-control ' required>
                    <input type='number' class='form-control my-1' name='checkno' placeholder='Write Check Number' required>
                    <input type='number' class='form-control my-1' name='amount' placeholder='Write Amount for withdraw' max='$row2[balance]' required>
                   <button type='submit' name='withdraw' class='btn btn-primary btn-bloc btn-sm my-1'> Withdraw</button></form><form method='POST'> 
                    <input type='hidden' value='$row2[accountNo]' name='accountNo' class='form-control ' required>
                    <input type='hidden' value='$row2[id]' name='userId' class='form-control ' required>
                   <input type='number' class='form-control my-1' name='checkno' placeholder='Write Check Number' required>
                    <input type='number' class='form-control my-1' name='amount' placeholder='Write Amount for deposit'  required>

                   <button type='submit' name='deposit' class='btn btn-success btn-bloc btn-sm my-1'> Deposit</button></form>
                  </div>
                </div>
            ";
                        } else
                            echo "<div class='alert alert-success w-50 mx-auto'>Số tài khoản  $_POST[otherNo] Does not exist</div>";
                    }
                }
                ?>
            </div>
            <div class="card-footer text-muted">
                <?php echo bankName; ?>
            </div>
        </div>
    </div>

</div>
</body>
</html>