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
    <link rel="stylesheet" href="./CSS/styles.css?var=6">
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
                    <div class="partner_box inquiry_box">
                        <?php
                        $conn = mysqli_connect("atssolution.co.kr", "ats02324", "ats9119**", "ats02324");
                        if(!$conn) {
                            $error = mysqli_connect_error();
                            $errno = mysqli_connect_errno();
                            print "$errno: $error\n";
                            exit();
                        }
                        
                        $num = $_GET['num']; // 현재 페이지의 글 번호를 쿼리스트링으로부터 가져옴
                        $sql = "SELECT * FROM inquiry WHERE num=".$num."";
                        $rs = mysqli_query($conn, $sql);

                        $info = mysqli_fetch_array($rs);
                        ?>

                        <div id="inquiry_read">
                            <!-- 게시글 본문 -->
                            <div class="inquiry_header">
                                <div class="inquiry_read_title">
                                    <b><?php echo $info['inquiry_field'] ?></b>
                                    <h2><?php echo $info['title']?></h2>
                                </div>
                                <div class="inquiry_user_info">
                                    <span><?php echo $info['id']?></span>
                                    <span><?php echo $info['inquiryDate'];?></span>
                                </div>
                            </div>
                            <div class="inquiry_user_content">
                                <?php
                                $content = nl2br($info['content']);
                                echo $content;
                                ?>
                            </div>
                        </div>

                        <div class="inquiry_btn">
                            <!-- 수정 & 삭제 & 목록 버튼 -->
                            <button onclick="modifyModal()">수정</button>
                            <button onclick="deleteModal()">삭제</button>  
                            <a href="./guide4.php?page=1"><button>목록</button></a>
                        </div>

                        <div class='modalBox'>
                            <!-- 수정 & 삭제를 위한 비밀번호 입력 창 -->
                            <?php
                            if(isset($_SESSION['admin'])){
                                $admin = $_SESSION['admin'];
                                if($admin == TRUE){
                                    // 관리자 계정일 경우 ?>
                                    <div class="pwModal modiForm">
                                        <form action="" method="post" class="pwModal_form">
                                            <input type="button" class="modalClose modi" value="X" onclick="closeModiModal()">
                                            <p>본문 수정 비밀번호</p>
                                            <input type="password" name="modifyPw" value="<?php echo $info["pw"]; ?>">
                                            <input type="submit" value="확인">
                                        </form>
                                    </div>
                                    <div class="pwModal deleteForm">
                                        <form action="" method="post" class="pwModal_form">
                                            <input type="button" class="modalClose delete" value="X" onclick="closeDeleteModal()">
                                            <p>본문 삭제 비밀번호</p>
                                            <input type="password" name="deletePw" value="<?php echo $info["pw"]; ?>"> 
                                            <input type="submit" value="확인">
                                        </form>
                                    </div>
                                <?php } 
                            } else {
                                // 일반 회원일 경우 ?>
                                <div class="pwModal modiForm">
                                    <form action="" method="post" class="pwModal_form">
                                        <input type="button" class="modalClose modi" value="X" onclick="closeModiModal()">
                                        <p>본문 수정 비밀번호</p>
                                        <input type="password" name="modifyPw">
                                        <input type="submit" value="확인">
                                    </form>
                                </div>
                                <div class="pwModal deleteForm">
                                    <form action="" method="post" class="pwModal_form">
                                        <input type="button" class="modalClose delete" value="X" onclick="closeDeleteModal()">
                                        <p>본문 삭제 비밀번호</p>
                                        <input type="password" name="deletePw">
                                        <input type="submit" value="확인">
                                    </form>
                                </div>
                            <?php } ?>
                        </div>

                        
                        <?php
                        // 수정 삭제 비밀번호 확인 영역
                        $num = $_GET['num']; // 해당 글의 num을 가져옴 
                        $sql = "SELECT * FROM inquiry WHERE num=".$num."";
                        $rs = mysqli_query($conn, $sql);

                        $info = mysqli_fetch_array($rs);
                        $pw = $info['pw']; 
                        // db에 저장되어있는 사용자의 비밀번호 
                        $encrypted_pw = password_hash($pw, PASSWORD_DEFAULT);

                        // 수정
                        if(isset($_POST['modifyPw'])){ // 만약 modifyPw 값이 있다면
                            $modiPw = $_POST['modifyPw'];
                            if(password_verify($modiPw, $encrypted_pw)){
                                echo "<script>
                                location.replace('./inquiry_modify.php?num=".$num."');
                                </script>";
                            } else {
                                echo "<script>
                                alert('비밀번호가 일치하지 않습니다.');
                                </script>";
                            }
                        }

                        // 삭제 
                        if(isset($_POST['deletePw'])){
                            $deletePw = $_POST['deletePw'];
                            if(password_verify($deletePw, $encrypted_pw)){
                                echo "<script>
                                location.replace('./inquiry_delete_ok.php?num=".$num."');
                                </script>";
                            } else {
                                echo "<script>
                                alert('비밀번호가 일치하지 않습니다.');
                                </script>";
                            }
                        }
                        ?>

                        <div class="reply">
                            <!-- 댓글 기능 -->
                            <h5>댓글</h5>

                            <!-- 댓글 작성하기 -->
                            <div class="reply_form">
                                <form action="./inquiry_reply.php?num=<?php $num = $_GET['num']; echo $num; ?>" method="post">
                                    <div class="reply_form_user">
                                        <input type="text" name="inquiry_reply_name" placeholder="작성자" required>
                                        <input type="password" name="inquiry_reply_pw" placeholder="비밀번호" required> 
                                    </div>
                                    <textarea name="inquiry_reply_content"cols="30" rows="10" placeholder="댓글을 작성해주세요" spellcheck="false"></textarea> <br>
                                    <input type="submit" value="작성">
                                </form>
                            </div>
                            
                            <!-- 댓글 불러오기 -->
                            <div class="reply_read">
                                <ul>
                                    <?php
                                    // db에 저장되어있던 댓글을 가져옴 
                                    $conn = mysqli_connect("atssolution.co.kr", "ats02324", "ats9119**", "ats02324");
                                    if(!$conn) {
                                        $error = mysqli_connect_error();
                                        $errno = mysqli_connect_errno();
                                        print "$errno: $error\n";
                                        exit();
                                    }
                                    $num = $_GET['num'];
                                    $replySql = "SELECT * FROM inquiryReply WHERE num=$num ORDER BY replyNum DESC";
                                    $rs = mysqli_query($conn, $replySql);
                            
                                    
                                
                                    while ($reply=mysqli_fetch_array($rs)) {
                                    ?>

                                    <li class='reply_user'>
                                        <div class='reply_user_info'>
                                            <span><?php echo $reply['id'] ?></span>
                                            <span><?php echo $reply['replyDate']?></span>
                                            <?php
                                            if(isset($_SESSION['admin'])){
                                                if($admin == TRUE){
                                                    // 관리자 계정일 경우 ?>
                                                    <span class='reply_manage'>
                                                        <span class="modi_manage">
                                                            <button data-target='<?php echo $reply['replyNum'] ?>' class="replyModiModal" >수정</button>
                                                            <div id='<?php echo $reply['replyNum'] ?>' class='replyPwModal replyModiForm'>
                                                                <form action='' method='post' class='pwModal_form replyModal'>
                                                                    <input type='button' class='modalClose' value='X' onclick='closeReplyModiModal()'>
                                                                    <p>댓글 수정 비밀번호</p>
                                                                    <input type='hidden' name='rno' value='<?php echo $reply['replyNum']?>'>
                                                                    <input type='hidden' name='bno' value='<?php echo $reply['num']?>'>
                                                                    <input type='password' name='replyModifyPw' value='<?php echo $reply['pw'] ?>'>
                                                                    <input type='submit' value='확인'>
                                                                </form>
                                                            </div>
                                                        </span>

                                                        <span class='delete_manage'>
                                                            <button data-target='<?php echo $reply['replyNum'] ?>' class='replyDeleteModal'>지우기</button>
                                                            <div class='replyPwModal replyDeleteForm'>
                                                                <form action='' method='post' class='pwModal_form replyModal'>
                                                                    <input type='button' class='modalClose' value='X' onclick='closeReplyDeleteModal()'>
                                                                    <p>댓글 삭제 비밀번호</p>
                                                                    <input type='hidden' name='rno' value='<?php echo $reply['replyNum']?>'>
                                                                    <input type='hidden' name='bno' value='<?php echo $reply['num']?>'>
                                                                    <input type='password' name='replyDeletePw' value='<?php echo $reply['pw'] ?>'>
                                                                    <input type='submit' value='확인'>
                                                                </form>
                                                            </div>
                                                        </span>
                                                    </span>
                                                <?php } else { 
                                                    // 일반 회원일 경우 ?>
                                                    <span class='reply_manage'>
                                                        <span class="modi_manage">
                                                            <button data-target='<?php echo $reply['replyNum'] ?>' class="replyModiModal" >수정</button>
                                                            <div id='<?php echo $reply['replyNum'] ?>' class='replyPwModal replyModiForm'>
                                                                <form action='' method='post' class='pwModal_form replyModal'>
                                                                    <input type='button' class='modalClose' value='X' onclick='closeReplyModiModal()'>
                                                                    <p>댓글 수정 비밀번호</p>
                                                                    <input type='hidden' name='rno' value='<?php echo $reply['replyNum']?>'>
                                                                    <input type='hidden' name='bno' value='<?php echo $reply['num']?>'>
                                                                    <input type='password' name='replyModifyPw'>
                                                                    <input type='submit' value='확인'>
                                                                </form>
                                                            </div>
                                                        </span>

                                                        <span class='delete_manage'>
                                                            <button data-target='<?php echo $reply['replyNum'] ?>' class='replyDeleteModal'>지우기</button>
                                                            <div class='replyPwModal replyDeleteForm'>
                                                                <form action='' method='post' class='pwModal_form replyModal'>
                                                                    <input type='button' class='modalClose' value='X' onclick='closeReplyDeleteModal()'>
                                                                    <p>댓글 삭제 비밀번호</p>
                                                                    <input type='hidden' name='rno' value='<?php echo $reply['replyNum']?>'>
                                                                    <input type='hidden' name='bno' value='<?php echo $reply['num']?>'>
                                                                    <input type='password' name='replyDeletePw'>
                                                                    <input type='submit' value='확인'>
                                                                </form>
                                                            </div>
                                                        </span>
                                                    </span>
                                                <?php }
                                            } else {
                                                // 일반 회원 (로그인 안 한 경우) ?>
                                                <span class='reply_manage'>
                                                    <span class="modi_manage">
                                                        <button data-target='<?php echo $reply['replyNum'] ?>' class="replyModiModal" >수정</button>
                                                        <div id='<?php echo $reply['replyNum'] ?>' class='replyPwModal replyModiForm'>
                                                            <form action='' method='post' class='pwModal_form replyModal'>
                                                                <input type='button' class='modalClose' value='X' onclick='closeReplyModiModal()'>
                                                                <p>댓글 수정 비밀번호</p>
                                                                <input type='hidden' name='rno' value='<?php echo $reply['replyNum']?>'>
                                                                <input type='hidden' name='bno' value='<?php echo $reply['num']?>'>
                                                                <input type='password' name='replyModifyPw'>
                                                                <input type='submit' value='확인'>
                                                            </form>
                                                        </div>
                                                    </span>

                                                    <span class='delete_manage'>
                                                        <button data-target='<?php echo $reply['replyNum'] ?>' class='replyDeleteModal'>지우기</button>
                                                        <div class='replyPwModal replyDeleteForm'>
                                                            <form action='' method='post' class='pwModal_form replyModal'>
                                                                <input type='button' class='modalClose' value='X' onclick='closeReplyDeleteModal()'>
                                                                <p>댓글 삭제 비밀번호</p>
                                                                <input type='hidden' name='rno' value='<?php echo $reply['replyNum']?>'>
                                                                <input type='hidden' name='bno' value='<?php echo $reply['num']?>'>
                                                                <input type='password' name='replyDeletePw'>
                                                                <input type='submit' value='확인'>
                                                            </form>
                                                        </div>
                                                    </span>
                                                </span>
                                            <?php } ?>
                                        </div>
                                        <p class='reply_user_content'>
                                            <?php echo nl2br($reply['content'])?>
                                        </p>
                                    </li>
                                    <?php } ?>
                                    
                                    <?php
                                    // 수정 삭제 비밀번호 확인 
                                    if(isset($_POST['rno'])){
                                        $num = $_GET['num']; // 해당 글의 num을 가져옴 
                                        $replyNum = $_POST['rno']; // 해당 댓글의 고유번호를 가져옴 
                                        $sql = "SELECT * FROM inquiryReply WHERE replyNum=".$replyNum."";
                                        $rs = mysqli_query($conn, $sql);
        
                                        $info = mysqli_fetch_array($rs);
        
                                        $pw = $info['pw']; 
                                        // db에 저장되어있는 사용자의 비밀번호 
                                        $encrypted_pw = password_hash($pw, PASSWORD_DEFAULT);
        
                                        // 수정
                                        if(isset($_POST['replyModifyPw'])){ // 만약 modifyPw 값이 있다면
                                            $modiPw = $_POST['replyModifyPw'];
                                            if(password_verify($modiPw, $encrypted_pw)){
                                                echo "
                                                <div class='reply_form modiForm'>
                                                    <p>< 댓글 수정란 ><p>
                                                    <form action='./inquiry_reply_modi.php?num=".$num."&rno=".$replyNum."' method='post'>
                                                        <div class='reply_form_user'>
                                                            <input type='text' name='inquiry_replyModi_name' value='".$info['id']."' required>
                                                            <input type='password' name='inquiry_replyModi_pw' placeholder='비밀번호' required> 
                                                            <input type='hidden' name='rno' value='".$info['replyNum']."'>
                                                        </div>
                                                        <textarea name='inquiry_replyModi_content'cols='30' rows='10' spellcheck='false'>".$info['content']."</textarea> <br>
                                                        <input type='submit' value='작성'>
                                                    </form>
                                                </div>
                                                ";
                                            } else {
                                                echo "<script>
                                                alert('비밀번호가 일치하지 않습니다.');
                                                </script>";
                                            }
                                        }
        
                                        // 삭제 
                                        if(isset($_POST['replyDeletePw'])){
                                            $deletePw = $_POST['replyDeletePw'];
                                            if(password_verify($deletePw, $encrypted_pw)){
                                                echo "<script>
                                                location.replace('./inquiry_reply_delete.php?num=".$num."&rno=".$replyNum."');
                                                </script>";
                                            } else {
                                                echo "<script>
                                                alert('비밀번호가 일치하지 않습니다.');
                                                </script>";
                                            }
                                        }
                                    } else {
                                        echo null;
                                    }
                                    ?>
                                </ul>

                                
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



        // 댓글의 수정과 삭제
        function closeReplyModiModal(){
            // 수정을 위한 비밀번호 확인 창 닫기
            var dialog = document.querySelectorAll('.replyModiForm');

            for(var i=0; i < dialog.length; i++){
                dialog[i].classList.remove('modalActive');
            }
        }

        function closeReplyDeleteModal(){
            // 삭제를 위한 비밀번호 확인 창 닫기
            var dialog = document.querySelectorAll('.replyDeleteForm');

            for(var i=0; i < dialog.length; i++){
                dialog[i].classList.remove('modalActive');
            }
        }
       
    </script>
</body>
</html>