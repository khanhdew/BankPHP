<!DOCTYPE html>
<html>
<head>
    <?php require 'assets/autoloader.php'; ?>
    <?php require 'assets/function.php'; ?>
    <?php require 'assets/config.php'; ?>
    <?php
    $error = "";
    if (isset($_POST['userLogin'])) {
        $error = "";
        $user = $_POST['email'];
        $pass = $_POST['password'];

        $result = $con->query("select * from userAccounts where email='$user' AND password='$pass'");
        mysqli_set_charset($con, "utf8");
        if ($result->num_rows > 0) {
            session_start();
            $data = $result->fetch_assoc();
            $_SESSION['userId'] = $data['id'];
            $_SESSION['user'] = $data;
            header('location:index.php');
        } else {
            $error = "
    <div id='alertContainer' class='alert alert-warning text-center rounded-0'>Username or password wrong try again!</div>
    ";
        }
    }
    if (isset($_POST['cashierLogin'])) {
        $error = "";
        $user = $_POST['email'];
        $pass = $_POST['password'];

        $result = $con->query("select * from login where email='$user' AND password='$pass'");
        if ($result->num_rows > 0) {
            session_start();
            $data = $result->fetch_assoc();
            $_SESSION['cashId'] = $data['id'];
            //$_SESSION['user'] = $data;
            header('location:cindex.php');
        } else {
            $error = "
    <div id='alertContainer' class='alert alert-warning text-center rounded-0'>Username or password wrong try again!</div>
    ";
        }
    }
    if (isset($_POST['managerLogin'])) {
        $error = "";
        $user = $_POST['email'];
        $pass = $_POST['password'];

        $result = $con->query("select * from login where email='$user' AND password='$pass' AND type='manager'");
        if ($result->num_rows > 0) {
            session_start();
            $data = $result->fetch_assoc();
            $_SESSION['managerId'] = $data['id'];
            //$_SESSION['user'] = $data;
            header('location:mindex.php');
        } else {
            $error = "<div id='alertContainer' class='alert alert-warning text-center rounded-0'>Username or password wrong try again!</div>";
        }
    }

    ?>
    <link rel="stylesheet" type="text/css" href="css/aos.css">
    <link rel="stylesheet" type="text/css" href="owlcarousel/assets/owl.carousel.min.css">
    <link rel="stylesheet" type="text/css" href="owlcarousel/assets/owl.theme.default.min.css">
</head>

<body data-bs-spy="scroll" data-bs-target=".navbar" data-bs-offset="50">

<nav class="navbar navbar-expand-lg navbar-light bg-light " id="myNavBar" style="display: none">
    <a class="navbar-brand" href="#">
        <img src="images/logo.png" alt="Your Logo" width="60" height="">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="#gthieu">Giới thiệu</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#tnang">Tính năng</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#dvu">Dịch vụ</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#kmai">Khuyến mãi</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#lhe">Liên Hệ</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#ttin">Thông tin</a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item"><a class="nav-link openPopup" data-target="login.html" href="#">Đăng nhập</a>
            </li>
            <li class="nav-item"><a class="nav-link openPopup" data-target="signup.php" href="#">Đăng ký</a></li>
        </ul>
    </div>
</nav>
<!-- Thêm vùng nền mờ (overlay) -->
<div id="popupContainer" class="popup">
    <div class="popup-content">
        <!-- Nội dung popup ở đây -->
        <span class="close" id="closePopup">&times;</span>
        <!-- Rest of your popup content -->
    </div>
</div>
<div id="overlay"></div>

<div class="container-fluid bg-image">

    <div class="MbbankHero">
        <span style="display:flex;" data-aos="fade-down" data-aos-delay="100" data-aos-duration="1000">
            <img src="images/IconMB.webp" alt="Your Logo" width="60" height="60">
            <p>MBBank</p>
        </span>
        <h3 data-aos="fade-down" data-aos-delay="100" data-aos-duration="1000">Giao dịch trực tiếp 24/7, nhận tiền,
            chuyển tiền ngay lập tức</h3>
        <button data-aos="fade-right" data-aos-delay="100" data-aos-duration="1000"><a class="openPopup"
                                                                                       data-target="login.html"">Đăng
            nhập</a></button>
        <span>Bạn chưa có tài khoản? <a
                    class="openRegisterPopup" data-target="signup.php"
                    style="text-decoration: underline;">đăng ký</a></span>
        <div class="img-container" data-aos="fade-up" data-aos-delay="100" data-aos-duration="1200">
            <a target="_blank" href="https://play.google.com/store/apps/details?id=com.mbmobile"><img
                        src="images/download-googleplay-black.png" class="img-fluid" alt="Google Play"></a>
            <a target="_blank" href="https://apps.apple.com/vn/app/mb-bank/id1205807363?l=vi"><img
                        src="images/download-appstore-black.png"
                        class="img-fluid" alt="App Store"></a>
        </div>
    </div>
</div>
<div class="overviewArea">
    <div class="pt-lg-2" id="gthieu">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5 col-md-12">
                    <ul>
                        <h1>Giới
                            thiệu</h1>
                        <li data-aos="fade-up" data-aos-delay="0" data-aos-duration="1000">MBBank là ngân
                            hàng thương mại cổ
                            phần trực thuộc Bộ Quốc phòng
                        </li>
                        <li data-aos="fade-up" data-aos-delay="100" data-aos-duration="1000">MBBank được
                            thành
                            lập năm 1994
                        </li>
                        <li data-aos="fade-up" data-aos-delay="200" data-aos-duration="1000">MBBank có hơn
                            550
                            chi nhánh/PGD trên
                            toàn quốc
                        </li>
                        <li data-aos="fade-up" data-aos-delay="300" data-aos-duration="1000">MBBank có hơn
                            10
                            triệu khách hàng
                            đang sử dụng dịch vụ
                        </li>
                    </ul>
                </div>
                <div class="col-lg-7 col-md-12" id="overview-img1">
                    <div data-aos="fade-up" data-aos-delay="0" data-aos-duration="1000">
                        <img src="images/dt1.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="pt-lg-2" id="tnang">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7 col-md-12" id="overview-img2">
                    <div data-aos="fade-up" data-aos-delay="0" data-aos-duration="1000">
                        <img src="images/dt2.png" alt="">
                    </div>
                </div>
                <div class="col-lg-5 col-md-12">
                    <ul>
                        <h1>Tính năng</h1>
                        <li data-aos="fade-up" data-aos-delay="0" data-aos-duration="1000">
                            Giao dịch tài chính mọi lúc mọi nơi
                        </li>
                        <li data-aos="fade-up" data-aos-delay="100" data-aos-duration="1000">MBBank được
                            duyệt hàng loạt giao dịch qua App
                        </li>
                        <li data-aos="fade-up" data-aos-delay="200" data-aos-duration="1000">MBBank có hơn
                            giao diện thân thiện với người dùng
                        </li>
                        <li data-aos="fade-up" data-aos-delay="300" data-aos-duration="1000">MBBank có hơn
                            miễn phí mọi giao dịch chuyển tiền
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
</div>
<div class="productArea" id="dvu">
    <div class="container">
        <div class="section-title" data-aos="fade-up" data-aos-delay="0" data-aos-duration="1000">
            <h1>Dịch vụ</h1><br>
            <span>Dịch vụ đang được MBBank hỗ trợ</span>
        </div>
        <div class="container mt-5">
            <div class="owl-carousel owl-theme" id="owlcarousel1">
                <div class="carouselItem">
                    <div class="card">
                        <img src="images/ic-home-products-chovay.svg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Vay online</h5>
                            <span class="card-text">Vay online nhận tiền ngay với lãi suất thấp</span>
                        </div>
                    </div>
                </div>
                <div class="carouselItem">
                    <div class="card">
                        <img src="images/ic-home-products-nh-dtu.svg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Thanh toán online</h5>
                            <span class="card-text">Giao dịch mọi lúc, mọi nơi, không mất phí</span>
                        </div>
                    </div>
                </div>
                <div class="carouselItem">
                    <div class="card">
                        <img src="images/ic-home-products-themb.svg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Mở thẻ</h5>
                            <span class="card-text">Mở thẻ visa, ATM không mất phí</span>
                        </div>
                    </div>
                </div>
                <div class="carouselItem">
                    <div class="card">
                        <img src="images/ic-home-products-tiengui.svg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Tiết kiệm</h5>
                            <span class="card-text">Gửi tiết kiệm với lãi suất cao</span>
                        </div>
                    </div>
                </div>
                <div class="carouselItem">
                    <div class="card">
                        <img src="images/ic-home-products-bankplus.svg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">App MBBank</h5>
                            <span class="card-text">Giao diện dễ thân thiện dễ sử dụng</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="owl-nav1"></div>
        </div>
    </div>
</div>
<div class="promoArea" id="kmai">
    <div class="container">
        <div class="section-title" data-aos="fade-up" data-aos-delay="0" data-aos-duration="1000">
            <h1>Khuyến mãi</h1><br>
            <span>Các chương trình khuyến mãi đang diễn ra</span>
        </div>
        <div class="container mt-5">
            <div class="owl-carousel owl-theme" id="owlcarousel2">
                <div class="carouselItem">
                    <div class="card">
                        <img src="images/km1.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <ul>
                                <li class="purchase-tag"><i class="fa fa-tag"></i><a> 25%</a></li>
                                <li class="promo-date"><i class="fa fa-calendar-check-o"><a> 09.10.2023</a></i></li>
                            </ul>
                            <h5 class="card-title">MB x CHANG MODERN THÁI CUISINE</h5>
                            <span class="card-text">Ưu đãi giảm 25% trên hóa đơn dành riêng cho khách hàng MBBank</span>
                        </div>
                    </div>
                </div>
                <div class="carouselItem">
                    <div class="card">
                        <img src="images/km2.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <ul>
                                <li class="purchase-tag"><i class="fa fa-tag"></i><a> 40%</a></li>
                                <li class="promo-date"><i class="fa fa-calendar-check-o"><a> 09.10.2023</a></i></li>
                            </ul>
                            <h5 class="card-title">MB x EMS</h5>
                            <span class="card-text">Ưu đãi 40% & tặng tập trải nghiệm tại ESM fitness & Yoga</span>
                        </div>
                    </div>
                </div>
                <div class="carouselItem">
                    <div class="card">
                        <img src="images/km3.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <ul>
                                <li class="purchase-tag"><i class="fa fa-tag"></i><a> 10%</a></li>
                                <li class="promo-date"><i class="fa fa-calendar-check-o"><a> 09.10.2023</a></i></li>
                            </ul>
                            <h5 class="card-title">MB x 24 THAI FUSION</h5>
                            <span class="card-text">Ưu đãi thổi bùng cảm xúc - đánh thức giác quan</span>
                        </div>
                    </div>
                </div>
                <div class="carouselItem">
                    <div class="card">
                        <img src="images/km4.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <ul>
                                <li class="purchase-tag"><i class="fa fa-tag"></i><a> 15%</a></li>
                                <li class="promo-date"><i class="fa fa-calendar-check-o"><a> 09.10.2023</a></i></li>
                            </ul>
                            <h5 class="card-title">MB x MIPA GOLF</h5>
                            <span class="card-text">Ưu đãi giảm đến 15% trên hóa đơn dành riêng cho khách hàng MBBank</span>
                        </div>
                    </div>
                </div>
                <div class="carouselItem">
                    <div class="card">
                        <img src="images/km5.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <ul>
                                <li class="purchase-tag"><i class="fa fa-tag"></i><a> 1.000.000đ</a></li>
                                <li class="promo-date"><i class="fa fa-calendar-check-o"><a> 05.10.2023</a></i></li>
                            </ul>
                            <h5 class="card-title">MB++</h5>
                            <span class="card-text">Nhận thưởng thêm đến 1 triệu đồng khi mua sắm trên MB++</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="owl-nav2"></div>
        </div>
    </div>
</div>
<div class="contactArea" id="lhe">
    <div class="container">
        <div class="section-title" data-aos="fade-up" data-aos-delay="0" data-aos-duration="1000">
            <h1>Liên hệ</h1><br>
        </div>
        <form action="">
            <div class="form-group">
                <label for="name">Họ tên</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Họ tên" required>
            </div>
            <div class="form-group">
                <label for="email">Địa chỉ email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Địa chỉ email" required>
                <span id="email-error">
                    <small class="text-danger"></small>
                </span>
            </div>
            <div class="form-group">
                <label for="phone">Số điện thoại</label>
                <input type="tel" class="form-control" id="phone" name="phone" placeholder="Số điện thoại" required>
                <span id="phone-error">
                    <small class="text-danger"></small>
                </span>
            </div>
            <div class="form-group">
                <label for="message">Nội dung</label>
                <textarea class="form-control" id="message" name="message" rows="3" placeholder="Nội dung"
                          required></textarea>
            </div>
            <button type="submit" class="btn btn-primary" disabled>Gửi</button>
        </form>
    </div>
</div>

<br>
<?php echo $error ?>
<br>
<footer>
    <div class="container" id="ttin">
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <img src="images/logo.png" alt="">
                <br>
                <a href="https://www.facebook.com/khanhgam.off/"><i class="fa fa-facebook"></i></a>
                <a href="https://github.com/khanhdew/"><i class="fa fa-github"></i></a>
                <a href="https://www.instagram.com/khanhdew/"><i class="fa fa-instagram"></i></a>
                <a href="https://www.linkedin.com/in/khanhdev-work/"><i class="fa fa-linkedin"></i></a>
            </div>
            <div class="col-lg-4 col-md-6">
                <h4>Thông tin</h4>
                <ul>
                    <li><a href="#">Giới thiệu</a></li>
                    <li><a href="#">Tuyển dụng</a></li>
                    <li><a href="#">Liên hệ</a></li>
                    <li><a href="#">Tin tức</a></li>
                </ul>
            </div>
            <div class="col-lg-4 col-md-6">
                <h4>Chính sách</h4>
                <ul>
                    <li><a href="#">Chính sách bảo mật</a></li>
                    <li><a href="#">Chính sách hội viên</a></li>
                    <li><a href="#">Chính sách đặc quyền</a></li>
                </ul>
            </div>
        </div>
</footer>
</body>
<script src="js/custom.js"></script>
<script src="js/aos.js"></script>
<script src="owlcarousel/owl.carousel.min.js"></script>
<script>
    AOS.init();
</script>
<script>
    var owl1 = $('#owlcarousel1');
    owl1.owlCarousel({
        loop: true,
        margin: 10,
        nav: true,
        autoplay: true,
        autoplayTimeout: 3000,
        autoplayHoverPause: true,
        items: 4,
        dots: false,
        navContainer: '.owl-nav1',
        responsive: {
            0: {
                items: 1,
            },
            769: {
                items: 2,
            },
            1199: {
                items: 3,
            },
            1400: {
                items: 4,
            }
        }
    });
    var owl2 = $('#owlcarousel2');
    owl2.owlCarousel({
        loop: true,
        margin: 10,
        nav: true,
        autoplay: true,
        autoplayTimeout: 3000,
        autoplayHoverPause: true,
        items: 4,
        dots: false,
        navContainer: '.owl-nav2',
        responsive: {
            0: {
                items: 1,
            },
            769: {
                items: 2,
            },
            1199: {
                items: 3,
            },
            1400: {
                items: 4,
            }
        }
    });

</script>
<script>
    // Lấy tham chiếu đến navbar
    var navbar = document.getElementById("myNavBar");

    // Lắng nghe sự kiện cuộn trang
    window.addEventListener("scroll", function () {
        // Kiểm tra vị trí cuộn trang
        if (window.pageYOffset >= 500) {
            // Nếu cuộn trang xuống đủ xa (ví dụ: 100px), thay đổi thuộc tính CSS
            navbar.style.position = "fixed";
            navbar.style.top = "0";
            navbar.style.width = "100%";
            navbar.style.animation = "fadeIn 0.5s ease-in-out";
            navbar.style.zIndex = "9999";
            navbar.style.display = "flex";
        } else {
            // Nếu không, khôi phục thuộc tính CSS ban đầu
            navbar.style.position = "none"; // Hoặc "relative" nếu bạn muốn giữ nguyên vị trí ban đầu
            navbar.style.top = "";
            navbar.style.width = "";
            navbar.style.animation = "";
            navbar.style.zIndex = "-1";
        }
    });
    // Lắng nghe sự kiện click trên các liên kết Scrollspy
    document.querySelectorAll('li a').forEach(function (link) {
        link.addEventListener('click', function (e) {
            e.preventDefault();

            // Lấy phần tử mục tiêu
            var targetId = this.getAttribute('href').substring(1); // Bỏ qua ký tự '#' ở đầu
            var targetElement = document.getElementById(targetId);

            // Tính toán vị trí của mục tiêu
            var targetOffset = targetElement.getBoundingClientRect().top;
            var currentScrollPosition = window.pageYOffset;
            var finalScrollPosition = currentScrollPosition + targetOffset - 100;

            // Cuộn trang đến vị trí mục tiêu một cách mượt
            window.scrollTo({
                top: finalScrollPosition,
                behavior: 'smooth' // Sử dụng cuộn trang mượt (smooth scroll)
            });
        });
    });

    //Validation
    const emailInput = document.getElementById("email");
    const phoneInput = document.getElementById("phone");
    const emailError = document.getElementById("email-error");
    const phoneError = document.getElementById("phone-error");

    emailInput.addEventListener("input", function () {
        const email = emailInput.value;
        if (!isValidateEmail(email)) { // Sửa đoạn này
            emailError.textContent = "Email không hợp lệ";
        } else {
            emailError.textContent = "";
        }
        document.querySelector("button[type='submit']").disabled = !(isValidateEmail(emailInput.value) && isValidatePhone(phoneInput.value));
    });

    function isValidateEmail(email) {
        return /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/
            .test(email);
    }


    phoneInput.addEventListener("input", function () {
            const phone = phoneInput.value;
            if (!isValidatePhone(phone)) {
                phoneError.textContent = "Số điện thoại không hợp lệ";
            } else {
                phoneError.textContent = "";
            }
            document.querySelector("button[type='submit']").disabled = !(isValidateEmail(emailInput.value) && isValidatePhone(phoneInput.value));
        }
    );

    function isValidatePhone(phone) {
        return phone.length === 10 && /^[0-9]*$/.test(phone);
    }


</script>
</html>
