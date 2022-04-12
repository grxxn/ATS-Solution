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
    if(!isset($_POST['adminID']) || !isset($_POST['adminPW'])) exit;
    $id = $_POST['adminID'];
    $pw = $_POST['adminPW'];

    // DB 연결
    $conn = mysqli_connect("atssolution.co.kr", "ats02324", "ats9119**", "ats02324");
    if(!$conn) {
        $error = mysqli_connect_error();
        $errno = mysqli_connect_errno();
        print "$errno: $error\n";
        exit();
    }

    $sql = "SELECT * FROM user";
    $rs = mysqli_query($conn, $sql);
    $info = mysqli_fetch_array($rs);

    if($id === 'ats02324' && $pw === 'ats**0504'){
        // id와 pw가 일치할 경우, user테이블 admin을 1로 변경
        $sql = "UPDATE user SET admin=1 WHERE id='ats02324'";
        mysqli_query($conn, $sql);
        // 메인 페이지로 이동
        echo "<script>
        location.href = './index.php';
        </script>";

        // 세션 설정
        if(!session_id()){
            // id가 없을 경우 세션 시작
            session_start();
        }
        $_SESSION['admin'] = TRUE;
    } else {
        echo "<script>
        alert('아이디 또는 비밀번호가 일치하지 않습니다. 다시 확인해주세요.');
        location.href = './login.php';
        </script>";

        $_SESSION['admin'] = FALSE;
    }
    ?>
    
</body>
</html>