<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ATS Solution</title>
</head>
<body>
    <?php
    // 세션 종료 코드 
    session_start();
    // 세션 데이터를 빈 배열로 초기화
    $_SESSION = array();
    // 세션 id 값이 저장되어 있는 쿠키를 삭제
    if(ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(
            session_name(), '', time()-42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }
    // 세션 파일 삭제
    session_destroy();

    // DB 연결
    $conn = mysqli_connect("atssolution.co.kr", "ats02324", "ats9119**", "ats02324");
    if(!$conn) {
        $error = mysqli_connect_error();
        $errno = mysqli_connect_errno();
        print "$errno: $error\n";
        exit();
    }

    $sql = "UPDATE user SET admin=0 WHERE id='ats02324'";
    $rs = mysqli_query($conn, $sql);

    echo "<script>
    location.href = './index.php';
    </script>";
    ?>
</body>
</html>