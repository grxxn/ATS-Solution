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
<body id="guideForm">
    <!-- 대외자료 게시판 form -->
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

    <section class="form_container">
        <form action="./article_ok.php" method="post" class="board_form" enctype="multipart/form-data">
            <label class="article_writer">
                작성자
                <input type="text" name="userName" value="관리자" required>
            </label>
            <label>
                비밀번호
                <input type="password" name="userPw" placeholder="반드시 관리자 비밀번호를 입력해주세요" required>
            </label>
            <label class="board_title">
                제목
                <input type="text" name="articleTitle" required>
            </label>
            <label>
                <textarea name="articleContent" id="board_area" cols="30" rows="10" required wrap='hard' spellcheck="false"></textarea>
            </label>
            <input type="submit" value="작성하기">
            <input type="button" value="목록으로 돌아가기" class='back'>
        </form>
    </section>

    <script>
        var backBtn = document.querySelector('.back');

        backBtn.addEventListener('click', function(){
            history.back();
        })
    </script>
    <script src="./JS/main.js"></script>
</body>
</html>