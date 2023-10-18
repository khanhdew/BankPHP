<?php require 'config.php'; ?>
<?php
if (isset($_SESSION['userId'])) {
    // Truy cập phần tử "userId" trong mảng
    $userId = $_SESSION['userId'];
} else {
    // Xử lý trường hợp khi "userId" không tồn tại
    $userId = null; // Hoặc bạn có thể gán giá trị mặc định khác
}
$ar = $con->query("select * from userAccounts,branch where id = '$userId' AND userAccounts.branch = branch.branchId");
mysqli_set_charset($con, "utf8");
$userData = $ar->fetch_assoc();
?>
<script type="text/javascript">
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>