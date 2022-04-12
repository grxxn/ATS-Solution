<?php 
// session 시작
session_start(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ATS Solution</title>
    <link rel="stylesheet" href="./CSS/styles.css?var=5">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/9805a1e1da.js" crossorigin="anonymous"></script>
</head>
<body id="guide4">
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

    <section class="landing guide">
        <div class="landing_container">
            <h3>BOARD</h3>
            <p>
                All Traffic Safety solution Corp.
            </p>
        </div>
    </section>

    <section class="contents">
        <div class="contents_container">
            <div class="menu_nav">
                <h4>BOARD</h4>
                <ul class="menu_nav_list">
                    <a href="./guide1.html"><li>FAQ</li></a>
                    <a href="./guide2.php?page=1"><li>대외자료</li></a>
                    <a href="./guide3.php?page=1"><li>게시판</li></a>
                    <a href="./guide4.php?page=1"><li>대리점 문의</li></a>
                </ul>
            </div>
            <div class="main_content">
                <h4>대리점 문의</h4>
                <div class="guide_content">
                    <div class="partner_box">
                        <div class="partner_desc">
                            <img src="./images/대리점2.JPG" alt="대리점 모집">
                        </div>
                        <div class="partner_writing_group">
                            <button type="button" class="write_btn" onclick="location.href='inquiryForm.php'">
                                글쓰기
                            </button>


                            <?php
                                $conn = mysqli_connect("atssolution.co.kr", "ats02324", "ats9119**", "ats02324");
                                if(!$conn) {
                                    $error = mysqli_connect_error();
                                    $errno = mysqli_connect_errno();
                                    print "$errno: $error\n";
                                    exit();
                                }

                                $currentPage = ($_GET['page']) ? $_GET['page'] : 1;
                                $pageSql = 6*($currentPage-1); // limit 변수 설정
                                $rowPerPage = 6;
                                $sql = "SELECT * FROM inquiry ORDER BY num DESC LIMIT ".$pageSql.", ".$rowPerPage."";

                                $rs = mysqli_query($conn, $sql);

                                // 글 목록 출력 (본문)
                                while($info=mysqli_fetch_array($rs)){
                                    if(!empty($info['comment'])){ // comment가 있다면
                                        $comment = "<img src='./images/chat3.jpg'>
                                                    ".$info['comment']."";
                                    } else {
                                        $comment = null;
                                    }
                                    ?>
                                    
                                    <ul class='partner_writing'>
                                        <li class='partner_title'>
                                            <?php
                                            $lockimg = "<img src='./images/lock.png' class='lock' alt='lock'/>";
                                            if($info['lock_post'] == '1'){ // 비밀글일 경우 
                                                if(isset($_SESSION['admin'])){
                                                    $admin = $_SESSION['admin'];
                                                    if ($admin == TRUE){ // 관리자 계정일 경우 ?>
                                                        <a href="./inquiry_view.php?num=<?php echo $info['num'] ?>" class="lock_post">
                                                            <b><?php echo $info['inquiry_field'] ?></b>
                                                            <?php echo $info['title'], $lockimg ?>
                                                        </a>
                                                    <?php }
                                                } else { // 일반 회원일 경우 ?>
                                                    <a href="./inquiry_check.php?num=<?php echo $info['num'] ?>" class="lock_post">
                                                        <b><?php echo $info['inquiry_field'] ?></b>
                                                        <?php echo $info['title'], $lockimg ?>
                                                    </a>
                                                <?php }} else { // 비밀글이 아닐 경우 ?> 
                                                <a href='./inquiry_view.php?num=<?php echo $info['num'] ?>'>
                                                    <b><?php echo $info['inquiry_field'] ?></b>
                                                    <?php echo $info['title'] ?>
                                                </a>
                                            <?php } ?>
                                            
                                            <span class='partner_reply'>
                                                <?php echo $comment ?>
                                            </span>
                                        </li>
                                        <li class='partner_writer'>
                                            <?php echo $info['id'] ?>
                                        </li>
                                    </ul>

                                    <?php } ?>

                            <!-- 페이징 구역 -->
                            <div class="paging">
                                <?php
                                $conn = mysqli_connect("atssolution.co.kr", "ats02324", "ats9119**", "ats02324");
                                if(!$conn) {
                                    $error = mysqli_connect_error();
                                    $errno = mysqli_connect_errno();
                                    print "$errno: $error\n";
                                    exit();
                                }
                                $sql = "SELECT * FROM inquiry";
                                $rs = mysqli_query($conn, $sql);

                                // 페이징 변수 설정 
                                $total_count = mysqli_num_rows($rs);
                                if($_GET['page']){ // 현재 있는 페이지 번호가 없으면 1로 설정 
                                    $pageNum = $_GET['page'];
                                } else {
                                    $pageNum = 1;
                                }
                                $listNum = 6; // 한 페이지에 6개씩 보여주도록 함.
                            
                                $b_pageNum_list = 5; // 블럭에 나타낼 페이지 번호 갯수 
                                $block = ceil($pageNum/$b_pageNum_list); // 현재 리스트의 블럭을 구하는 식
                            
                                $b_start_page = (($block - 1) * $b_pageNum_list) + 1; // 현재 블럭에서 시작 페이지 번호
                                $b_end_page = $b_start_page + $b_pageNum_list - 1; // 현재 블럭에서 마지막 페이지 번호
                            
                                $total_page = ceil($total_count / $listNum); // 총 게시글의 페이지 수
                            
                                if($b_end_page > $total_page) {
                                    $b_end_page = $total_page;
                                }

                                // 페이징 구현 시작
                                // 이전 
                                if($block <= 1) {
                                    echo "<span></span>";
                                } else {
                                    echo "<span><a href='guide4.php?page=".($b_start_page-1)."&list=".$listNum."'>
                                    <
                                    </a></span>";
                                }
                                // 숫자 페이징
                                for($j = $b_start_page; $j <= $b_end_page; $j++){
                                    if($pageNum == $j) { // 현재 페이지 
                                        echo "<span class='focusPg'>
                                        ".$j." 
                                        </span>";
                                    } else {
                                        echo "<span><a href='guide4.php?page=".$j."&list=".$listNum."' class='pageNum'>
                                        ".$j."
                                        </a></span>";
                                    }
                                }
                                // 다음 
                                $total_block = ceil($total_page/$b_pageNum_list); // block의 총 갯수

                                if($block >= $total_block) { // block과 총 block갯수의 값이 같다면
                                    echo "<span></span>"; // 맨 마지막 블럭이므로 다음버튼이 필요없음 
                                } else {
                                    echo "<span><a href='guide4.php?page=".($b_end_page+1)."&list=".$listNum."'>
                                    > 
                                    </a></span>";
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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

    <script src="./JS/main.js?var=1"></script>
</body>
</html>