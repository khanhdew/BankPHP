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
$array = $con->query("select * from useraccounts,branch where useraccounts.id = '$_GET[id]' AND useraccounts.branch = branch.branchId");
$row = $array->fetch_assoc();
?>
<div class="container">
    <div class="card w-100 text-center shadowBlue">
        <div class="card-header">
            Account profile for <?php echo $row['name'];
            echo "<kbd>#";
            echo $row['accountNo'];
            echo "</kbd>"; ?>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tbody>
                <tr>
                    <td>Name</td>
                    <th><?php echo $row['name'] ?></th>
                    <td>Account No</td>
                    <th><?php echo $row['accountNo'] ?></th>
                </tr>
                <tr>
                    <td>Branch Name</td>
                    <th><?php echo $row['branchName'] ?></th>
                    <td>Brach Code</td>
                    <th><?php echo $row['branchNo'] ?></th>
                </tr>
                <tr>
                    <td>Current Balance</td>
                    <th><?php echo $row['balance'] ?></th>
                    <td>Account Type</td>
                    <th><?php echo $row['accountType'] ?></th>
                </tr>
                <tr>
                    <td>Cnic</td>
                    <th><?php echo $row['cnic'] ?></th>
                    <td>City</td>
                    <th><?php echo $row['city'] ?></th>
                </tr>
                <tr>
                    <td>Contact Number</td>
                    <th><?php echo $row['number'] ?></th>
                    <td>Address</td>
                    <th><?php echo $row['address'] ?></th>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="card-footer text-muted">
            <?php echo bankName; ?>
        </div>
    </div>

</body>
</html>