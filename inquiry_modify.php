<!-- 수정 양식 -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ATS Solution</title>
    <link rel="stylesheet" href="./CSS/styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/9805a1e1da.js" crossorigin="anonymous"></script>
</head>
<body id="guideForm2">
    <!-- 문의게시판 전용 form -->
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
                <div class="guide_text">
                    <h5>대리점 문의</h5> 
                    <hr>
                    <p>
                        내용을 상세히 기재해 주시면 보다 정확한 답변을 드릴 수 있습니다.
                    </p>
                </div>

                <?php
                // DB 연결
                $conn = mysqli_connect("atssolution.co.kr", "ats02324", "ats9119**", "ats02324");
                // DB 연결 체크
                if(!$conn) {
                    $error = mysqli_connect_error();
                    $errno = mysqli_connect_errno();
                    print "$errno: $error\n";
                    exit();
                }

                $num = $_GET['num'];
                $sql = "SELECT * FROM inquiry WHERE num = ".$num."";

                $rs = mysqli_query($conn, $sql);
                $info = mysqli_fetch_array($rs);

                ?>

                <form name="inquiryForm" class="inquiry_form" action="./inquiry_modify_ok.php?num=<?php echo $num?>" method="post" enctype="multipart/form-data">
                    <p class="inquiry_hint">
                        ( * 표시 필수입력 )
                    </p>
                    <label class="inquiry_title">
                        제목 
                        <div class="inquiry_title_grp">
                            <select name="field" class="inquiry_field">
                                <option value="대리점 문의">대리점 문의</option>
                                <option value="상품 문의">상품 문의</option>
                                <option value="기타 문의">기타 문의</option>
                            </select>
                            <input type="text" name="userTitle" id="titleInput" required value="<?php echo $info['title']; ?>">
                        </div>
                    </label>
                    <label>
                        작성자 *
                        <input type="text" name="userName" required value="<?php echo $info['id']; ?>">
                    </label>
                    <label>
                        비밀번호 *
                        <input type="password" name="userPw" required>
                    </label>
                    <label>
                        연락처
                        <input type="tel" name="userTel" placeholder="- 생략 (숫자로만 작성)" value="<?php echo $info['tel']; ?>">
                    </label>
                    <label>
                        회사명 
                        <input type="text" name="userCompany" placeholder="(개인일 경우 이름 작성)" value="<?php echo $info['company']; ?>"> 
                    </label>
                    <label>
                        회사주소
                        <input type="text" name="userCompanyAddr" value="<?php echo $info['company_addr']; ?>">
                    </label>
                    <label>
                        문의내용
                        <textarea name="inquiry" id="inquiry" cols="30" rows="10" required spellcheck="false"><?php echo $info['content']; ?></textarea>
                    </label>
                    <input type="submit" value="문의하기" class="submit_btn">
                </form>
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
</body>
</html>