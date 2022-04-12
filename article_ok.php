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
    // DB 연결
    $conn = mysqli_connect("atssolution.co.kr", "ats02324", "ats9119**", "ats02324");
    // DB 연결 체크
    if(!$conn) {
        $error = mysqli_connect_error();
        $errno = mysqli_connect_errno();
        print "$errno: $error\n";
        exit();
    }

    $sql = "SELECT * FROM article";
    $rs = mysqli_query($conn, $sql);
    $total_rows = mysqli_num_rows($rs); // 총 컬럼(데이터) 갯수 

    $maxSql = "SELECT * FROM article WHERE num = (SELECT max(num) FROM article)";
    $maxRs = mysqli_query($conn, $maxSql);
    $maxData = mysqli_fetch_array($maxRs);

    // form 데이터 받아오기 
    $num = $maxData['num'] + 1; // 글 번호 = 데이터 갯수 + 1
    $name = $_POST['userName'];
    $pw = $_POST['userPw'];
    $title = addslashes($_POST['articleTitle']);
    $date = date('Y-m-d');
    $content = addslashes($_POST['articleContent']);

    // sql문 작성 (insert문)
    $sql = "INSERT INTO article VALUES ('$name', '$pw', '$title', '$content', '$date', '$num')";

    if(mysqli_query($conn, $sql)){
        echo "<script>
        alert('글 작성이 완료되었습니다.');
        location.href='./guide2.php?page=1';</script>";
    } else {
        echo "<script>
        alert('글 작성이 실패하였습니다. 다시 시도해주세요.');
        history.back();</script>";
    }
?>

</body>
</html>