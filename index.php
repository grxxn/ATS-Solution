<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ATS Solution</title>
    <link rel="stylesheet" href="./CSS/styles.css?var=6">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
    <link rel="short icon" href="./favicon.ico">
    <script src="https://kit.fontawesome.com/9805a1e1da.js" crossorigin="anonymous"></script>
</head>
<body id="home">
    <section class="header">
        <h1>
            <a href="./index.php">
                <img src="./images/로고.JPG" alt="로고" class="logo">
            </a>
        </h1>
        <div class="menu">
            <span class="menu_bar">
                <i class="fa fa-bars hamMenu"></i>
            </span>
            <div class="menu_list">
                <i class="fas fa-times x_icon"></i>
                <div class="dropdown_toggle">
                    <p>회사소개</p>
                    <ul class="dropdown_menu">
                        <a href="company1.html"><li>기업 정보</li></a>
                        <a href="company2.html"><li>오시는 길</li></a>
                    </ul>
                </div>
                <div class="dropdown_toggle">
                    <p>제품소개</p>
                    <ul class="dropdown_menu">
                        <a href="product1.html"><li>경쟁력</li></a>
                        <a href="product2.html"><li>제품</li></a>
                        <a href="product3.html"><li>작동원리</li></a>
                        <a href="product4.html"><li>제품설치사례</li></a>
                    </ul>
                </div>
                <div class="dropdown_toggle">
                    <p>비지니스</p>
                    <ul class="dropdown_menu">
                        <a href="business1.html"><li>기대효과</li></a>
                        <a href="business2.html"><li>설치가능구역</li></a>
                    </ul>
                </div>
                <div class="dropdown_toggle">
                    <p>고객문의</p>
                    <ul class="dropdown_menu">
                        <a href="guide1.html"><li>FAQ</li></a>
                        <a href="guide2.php?page=1"><li>대외자료</li></a>
                        <a href="guide3.php?page=1"><li>게시판</li></a>
                        <a href="guide4.php?page=1"><li>대리점 문의</li></a>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="index_landing">
        <div class="index_landing_container">
            <h2 class="landing_title">주식회사 에이티에스솔루션</h2>
            <h3>바닥형 보행 신호등</h3>
            <p>
                ATS솔루션은 LED 바닥형 신호등 전문기업으로 
                결로 및 과열방지 기능을 갖춘 특허전용실시권을 보유하고 있으며 
                차별성을 가진 제품을 직접 제조 및 판매하기 위해 <br> 
                2021년 5월 창업한 스타트업 회사입니다.
            </p>
            <div class="index_bg">
                <ul class="index_bg_list">
                    <li><img src="./images/1.jpg" alt=""></li>
                    <li><img src="./images/6.jpg" alt=""></li>
                    <li><img src="./images/7.jpg" alt="" ></li>
                </ul>
                <a id="prev_btn" href="#">&#8810;</a>
                <a id="next_btn" href="#">&#8811;</a>
            </div>
        </div>
    </section>

    <section class="index_content">
        <div class="index_board">
            <!-- 게시판 -->
            <!-- 홈페이지 활성화 전까지 게시판 대신 대외자료로 대체 -->
            <div class="index_board_title">
                <h3>대외자료</h3>
                <a href="./guide2.php?page=1"><i class="fas fa-plus"></i></a>
            </div>
            <?php
            $conn = mysqli_connect("atssolution.co.kr", "ats02324", "ats9119**", "ats02324");
            if(!$conn) {
                $error = mysqli_connect_error();
                $errno = mysqli_connect_errno();
                print "$errno: $error\n";
                exit();
            }

            $sql = "SELECT * FROM article ORDER BY num DESC LIMIT 5";

            $rs = mysqli_query($conn, $sql);

            while ($info = mysqli_fetch_array($rs)) {
            ?>
            <ul class='index_board_list'>
                <li>
                    <a href='./article_view.php?num=<?php echo $info['num']?>'>
                        <?php 
                        $titleLen = mb_strlen($info['title']);
                        if($titleLen > 32){
                            $title = mb_substr($info['title'], 0, 28);
                            echo ''.$title.' ··' ;
                        } else {
                            echo $info['title'];
                        }
                        ?>
                    </a>
                </li>
            </ul>
            <?php } ?>

        </div>
        <div class="index_patent">
            <!-- 홍보 이미지 -->
            <img src="./images/메인특허.JPG" alt="특허 홍보">
        </div>
        <div class="index_contact">
            <!-- 연락처 -->
            <h4>
                customer center
            </h4>
            <ul class="index_contact_1">
                <li><span><i class="fas fa-phone-alt"></i> Tel</span>  02-6949-5178</li>
                <li><span><i class="fas fa-fax"></i> Fax</span>  02-6949-5179</li>
            </ul>
            <hr>
            <ul class="index_contact_2">
                <li> ▶ 평일 9 A.M ~ 6 P.M (점심시간 12:30 ~ 1:30)</li>
                <li> ▶ 토, 일, 공휴일 휴무</li>
                <li> ▶ e-mail : ats911@naver.com</li>
            </ul>
        </div>
    </section>

    <section class="mini_nav">
        <ul class="mini_nav_list">
            <li><a href="./company1.html">회사소개</a></li>
            <li><a href="./product1.html">제품소개</a></li>
            <li><a href="./business1.html">비지니스</a></li>
            <li><a href="./guide3.php?page=1">게시판</a></li>
        </ul>
    </section>

    <footer>
        <div class="footer_container">
            <p>주식회사 에이티에스솔루션 / 대표 김 정 연</p>
            <p>(02055) 서울특별시 중랑구 신내역로 2길 40-36 신내데시앙플렉스 A동 711호</p>
            <p>Tel. 02 - 6949 - 5178  /  Fax. 02 - 6949 - 5179  /  Mail. ats911@naver.com</p>
        </div>
    </footer>

    <div class='loginModal'>
        <button class='loginModalBtn'></button>
        <p>관리자 로그인 관리</p>
        <button class='loginBtn'>
            <?php
            $loginSql = "SELECT admin FROM user WHERE id='ats02324'";
            $rs = mysqli_query($conn, $loginSql);
            $loginInfo = mysqli_fetch_array($rs);

            if(isset($_SESSION['admin'])) {
                // 관리자 로그인된 상태
                echo "<a href='logout.php'>logout</a>";
            } else {
                // 관리자 로그아웃된 상태
                echo "<a href='login.php'>login</a>";
            }
            ?>
        </button>               
    </div>

    <script src="./JS/main.js?var=8"></script>
</body>
</html>