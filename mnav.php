<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <a class="navbar-brand" href="#">
        <img src="images/logo.png" width="60" height="" class="d-inline-block align-top" alt="">
        <!--  <i class="d-inline-block  fa fa-building fa-fw"></i> --><?php //echo bankName; ?>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item ">
                <a class="nav-link " href="mindex.php">Trang chủ <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active"><a class="nav-link" href="maccounts.php">Tài khoản</a></li>
            <li class="nav-item "><a class="nav-link" href="maddnew.php">Thêm tài khoản</a></li>
            <li class="nav-item "><a class="nav-link" href="mfeedback.php">Đánh giá</a></li>
            <!-- <li class="nav-item ">  <a class="nav-link" href="transfer.php">Funds Transfer</a></li> -->
            <!-- <li class="nav-item ">  <a class="nav-link" href="profile.php">Profile</a></li> -->


        </ul>
        <?php include 'msideButton.php'; ?>

    </div>
</nav>