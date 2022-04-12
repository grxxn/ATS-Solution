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
    <link rel="stylesheet" href="./CSS/styles.css?var=9">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/9805a1e1da.js" crossorigin="anonymous"></script>
</head>
<body id="guide2">
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
                <h4>대외자료</h4>
                <div class="guide_content">
                    <table class="board">
                        <colgroup>
                            <col width="60">
                            <col width="700">
                            <col width="170">
                            <col width="150">
                        </colgroup>
                        <tr>
                            <th>No</th>
                            <th>글제목</th>
                            <th>작성자</th>
                            <th>날짜</th>
                        </tr>

                        <?php
                        
                        $conn = mysqli_connect("atssolution.co.kr", "ats02324", "ats9119**", "ats02324");
                        if(!$conn) {
                            $error = mysqli_connect_error();
                            $errno = mysqli_connect_errno();
                            print "$errno: $error\n";
                            exit();
                        }
                        $currentPage = ($_GET['page']) ? $_GET['page'] : 1;
                        $pageSql = 10*($currentPage-1);
                        $rowPerPage = 10; // 한 페이지 당 보여질 게시글 수. 한 페이지에 10개의 글이 보여진다. 
                        $sql = "SELECT * FROM article ORDER BY num DESC LIMIT ".$pageSql.", ".$rowPerPage." ";

                        $rs = mysqli_query($conn, $sql);
                        $totalrow = mysqli_num_rows($rs);
                        // 글 목록 출력
                        while($info=mysqli_fetch_array($rs)){ ?>

                        <tr class='board_info'>
                            <td class='board_num'>
                                <?php 
                                echo $totalrow ;
                                ?>
                            </td>
                            <td class='board_read_title'>
                                <a href='./article_view.php?num=<?php echo $info['num'] ?>'>
                                    <?php echo $info['title'] ?>
                                </a>
                            </td>
                            <td class='board_writer'>
                                <?php echo $info['id'] ?>
                            </td>
                            <td class='board_date'>
                                <?php echo $info['articleDate'] ?>
                            </td>
                        </tr>
                        <?php 
                        if($totalrow > 0){
                            $totalrow--; 
                        }
                        } ?>
                        
                    </table>

                    <!-- 페이징 구역 -->
                    <div class="paging">
                        <?php
                        $sql = "SELECT * FROM article";
                        $rs = mysqli_query($conn, $sql);

                        // 페이징 변수 설정 
                        $total_count = mysqli_num_rows($rs);
                        if($_GET['page']){ // 현재 있는 페이지 번호가 없으면 1로 설정 
                            $pageNum = $_GET['page'];
                        } else {
                            $pageNum = 1;
                        }
                        $listNum = 10; // 한 페이지에 10개의 게시글을 보여주도록 함.
                            
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
                            echo "<span><a href='guide2.php?page=".($b_start_page-1)."&list=".$listNum."'>
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
                                echo "<span><a href='guide2.php?page=".$j."&list=".$listNum."' class='pageNum'>
                                ".$j."
                                </a></span>";
                            }
                        }
                        // 다음 
                        $total_block = ceil($total_page/$b_pageNum_list); // block의 총 갯수

                        if($block >= $total_block) { // block과 총 block갯수의 값이 같다면
                            echo "<span></span>"; // 맨 마지막 블럭이므로 다음버튼이 필요없음 
                        } else {
                            echo "<span><a href='guide2.php?page=".($b_end_page+1)."&list=".$listNum."'>
                            > 
                            </a></span>";
                        }
                        ?>
                    </div>

                    <?php
                    if(isset($_SESSION['admin'])){
                        $admin = $_SESSION['admin']; 
                        if($admin == TRUE){
                            // 관리자 계정일 경우
                            echo "<button type='button' class='write_btn' onclick='articleWrite()'>글쓰기</button>";
                        } else {
                            // 일반 사용자일 경우
                            echo null;
                        }
                    }
                    ?>

                    <!-- <button type="button" class="write_btn" onclick='articleWrite()'>
                        글쓰기  
                    </button> -->

                   
                    <!-- <div class='writePw'>
                        <form action="" method='post' class='modalContainer'>
                            <input type="button" value="X" class="modalX" onclick="closeModal()">
                            <div>
                                <p>
                                    대외자료 게시판 글 작성은 관리자만 가능합니다. <br>
                                    비밀번호를 입력해주세요.
                                </p>
                                <input type="password" name="writePw">
                                <input type="submit" value='입력'>
                            </div>
                        </form>
                    </div>

                    <?php
                    $admin = 'ats9119**';
                    if(isset($_POST['writePw'])){ // 만약 writePw 값이 있다면
                        $encrypted_pw = password_hash($admin, PASSWORD_DEFAULT);
                        $writePw = $_POST['writePw'];

                        if(password_verify($writePw, $encrypted_pw)){
                            echo "<script>
                            location.replace('./articleForm.php');
                            </script>";
                        } else {
                            echo "<script>
                            alert('비밀번호가 일치하지 않습니다.');
                            </script>";
                        }
                    }
                    
                    ?> -->
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

    
    <script src="./JS/main.js"></script>
    <script>
        function articleWrite(){
            // var modal = document.querySelector('.writePw');
            // modal.style.display = 'block';
            location.replace('./articleForm.php');
        }

        function closeModal(){
            var modal = document.querySelector('.writePw');
            modal.style.display = 'none';
        }
    </script>
</body>
</html>