<?php
// 세션 시작
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ATS Solution</title>
    <link rel="stylesheet" href="./CSS/styles.css?after">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/9805a1e1da.js" crossorigin="anonymous"></script>
</head>
<body id="guide3">
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
                    <?php
                    
                    $conn = mysqli_connect("atssolution.co.kr", "ats02324", "ats9119**", "ats02324");
                    if(!$conn) {
                        $error = mysqli_connect_error();
                        $errno = mysqli_connect_errno();
                        print "$errno: $error\n";
                        exit();
                    }

                    $num = $_GET['num']; // 현재 페이지의 글 번호를 쿼리스트링으로부터 가져옴 
                    $sql = "SELECT * FROM article WHERE num=".$num."";
                    $rs = mysqli_query($conn, $sql);

                    $info = mysqli_fetch_array($rs);
                    ?>

                    <div id="board_read">
                        <div class="board_header">
                            <h2><?php echo $info['title'] ?></h2>
                            <div class="board_user_info">
                                <?php echo $info['id'] ?>
                                <?php echo $info['articleDate'] ?>                            
                            </div>
                        </div>
                        <div class="board_content">
                            <?php 
                            $content = nl2br($info['content']);
                            echo $content;
                            ?>
                        </div>
                    </div>

                    <div class="board_btn">
                        <?php
                        if(isset($_SESSION['admin'])){
                            $admin = $_SESSION['admin'];
                            if($admin == TRUE) { // 관리자 계정일 경우 ?>
                                <button onclick="modifyModal()">수정</button>
                                <button onclick="deleteModal()">삭제</button>
                            <?php } else {
                                // 일반 회원일 경우
                                echo null;
                            }
                        }
                        ?>
                        <a href="./guide2.php?page=1"><button>목록</button></a>
                    </div>

                    <div class='modalBox'>
                        <!-- 수정 & 삭제를 위한 비밀번호 입력 창 -->
                        <div class="pwModal modiForm">
                            <form action="" method="post" class="pwModal_form">
                                <input type="button" class="modalClose" value="X" onclick="closeModiModal()">
                                <p>수정 - 비밀번호를 입력해주세요.</p>
                                <input type="password" name="modifyPw">
                                <input type="submit" value="확인">
                            </form>
                        </div>
                        <div class="pwModal deleteForm">
                            <form action="" method="post" class="pwModal_form">
                                <input type="button" class="modalClose" value="X" onclick="closeDeleteModal()">
                                <p>삭제 - 비밀번호를 입력해주세요.</p>
                                <input type="password" name="deletePw">
                                <input type="submit" value="확인">
                            </form>
                        </div>
                    </div>

                    <?php
                        $num = $_GET['num']; // 해당 글의 num을 가져옴 
                        $sql = "SELECT * FROM article WHERE num=".$num."";
                        $rs = mysqli_query($conn, $sql);

                        $info = mysqli_fetch_array($rs);
                        $pw = $info['pw']; 
                        // db에 저장되어있는 사용자의 비밀번호 
                        $encrypted_pw = password_hash($pw, PASSWORD_DEFAULT);

                        if(isset($_POST['modifyPw'])){ // 만약 modifyPw 값이 있다면
                            $modiPw = $_POST['modifyPw'];
                            if(password_verify($modiPw, $encrypted_pw)){ // modiPw와 DB에 저장된 비밀번호가 같다면 
                                echo "<script>
                                location.replace('./article_modify.php?num=".$num."');
                                </script>";
                            } else {
                                echo "<script>
                                alert('비밀번호가 일치하지 않습니다.');
                                </script>";
                            }
                        }

                        if(isset($_POST['deletePw'])){ // 만약 deletePw 값이 있다면 
                            $deletePw = $_POST['deletePw'];
                            if(password_verify($deletePw, $encrypted_pw)){ // deletePw와 DB에 저장된 비밀번호가 같다면 
                                echo "<script>
                                location.replace('./article_delete_ok.php?num=".$num."');
                                </script>";
                            } else {
                                echo "<script>
                                alert('비밀번호가 일치하지 않습니다.');
                                </script>";
                            }
                        }
                    ?>

                    <!-- 다음 글, 이전 글 -->
                    <div class="listTap">
                        <?php
                        // 다음 글
                        $num = $_GET['num']; // 해당 글의 num을 가져옴 

                        $numsql = "SELECT num, title FROM article WHERE num=(SELECT min(num) FROM article WHERE num > ".$num.")";
                        $rs = mysqli_query($conn, $numsql);
                        $info = mysqli_fetch_array($rs);

                        if(isset($info)){
                            $titleLen = mb_strlen($info['title']);
                            if($titleLen > 30) {
                                $title = mb_substr($info['title'], 0, 25)."···";
                            } else {
                                $title = $info['title'];
                            }
                            echo "<a href='./article_view.php?num=".$info['num']."'>
                            <i class='fas fa-chevron-up'></i>
                            ".$title."
                            </a>";
                        }
                        ?>
                        <?php
                        // 이전 글
                        $numsql = "SELECT * FROM article WHERE num=(SELECT max(num) FROM article WHERE num < $num)";
                        $rs = mysqli_query($conn, $numsql);
                        $info = mysqli_fetch_array($rs);

                        if(isset($info)){
                            echo "<a href='./article_view.php?num=".$info['num']."'>
                            <i class='fas fa-chevron-down'></i>
                            ".$info['title']."
                            </a>";
                        } 
                        ?> 
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

    <script src="./JS/main.js"></script>
    <script>
        function closeModiModal(){
            // 수정 비밀번호 창 닫기
            var modal = document.querySelector('.modiForm');

            modal.style.display = 'none';
        }

        function closeDeleteModal(){
            // 삭제 비밀번호 창 닫기
            var modal = document.querySelector('.deleteForm');

            modal.style.display = 'none';
        }
        function modifyModal(){
            // 수정을 위한 비밀번호 확인 창 열기 
            var modal = document.querySelector('.modiForm');
            modal.style.display = 'block';

        }

        function deleteModal(){
            // 삭제를 위한 비밀번호 확인 창 열기
            var modal = document.querySelector('.deleteForm');  
            modal.style.display = 'block';
        }

        function findURL(){
            var rplcdTxt, rplcdPttrn1;
            var container = document.querySelector('.board_content');
            var orgnTxt = container.innerHTML;

            //  http://, https://로 url이 시작한다면.
            rplcdPttrn = /(\b(https?):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/gim;
            rplcdTxt = orgnTxt.replace(rplcdPttrn, '<a href="$1" target="_blank">$1</a>');
            

            container.innerHTML = rplcdTxt;
        }
        findURL();
    </script>
</body>
</html>