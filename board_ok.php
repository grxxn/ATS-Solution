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

    $sql = "SELECT * FROM board";
    $rs = mysqli_query($conn, $sql);
    $total_rows = mysqli_num_rows($rs); // 총 컬럼(데이터) 갯수 

    // form 데이터 받아오기 
    $num = $total_rows + 1; // 글 번호 = 데이터 갯수 + 1
    $name = $_POST['userName'];
    $pw = $_POST['userPw'];
    $title = addslashes($_POST['boardTitle']);
    $date = date('Y-m-d');
    $content = addslashes($_POST['boardContent']);
    $comment = 0; // 달린 댓글의 수. 초기 값은 0으로 설정

    // sql문 작성 (insert문)
    $sql = "INSERT INTO board VALUES ('$num', '$name', '$pw', '$title', '$date', '$content', '$comment')";

    if(mysqli_query($conn, $sql)){
        echo "<script>
        alert('글 작성이 완료되었습니다.');
        location.href='./guide3.php?page=1';</script>";
    } else {
        echo "<script>
        alert('글 작성이 실패하였습니다. 다시 시도해주세요.');
        history.back();</script>";
    }
?>

</body>
</html>