<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ATS Solution</title>
    <link rel="stylesheet" href="./CSS/styles.css?var=2">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
    <link rel="short icon" href="./favicon.ico">
    <script src="https://kit.fontawesome.com/9805a1e1da.js" crossorigin="anonymous"></script>
</head>
<body id="login">
    <div class="loginForm">
        <h2>LOGIN</h2>
        <p>관리자 아이디와 비밀번호를 입력해주세요.</p>
        <form action="./login_ok.php" method="post" class="loginInput">
            <input type="text" name="adminID" placeholder="ID">
            <input type="password" name="adminPW" placeholder="PASSWORD">
            <input type="submit" value="login">
        </form>
    </div>

    <script src="./JS/main.js?var=4"></script>
</body>
</html>