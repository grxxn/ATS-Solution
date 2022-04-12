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

    $conn = mysqli_connect("atssolution.co.kr", "ats02324", "ats9119**", "ats02324");
    if(!$conn) {
        $error = mysqli_connect_error();
        $errno = mysqli_connect_errno();
        print "$errno: $error\n";
        exit();
    }

    $num = $_GET['num']; // 삭제할 글의 번호를 쿼리스트링으로부터 가져옴
    $sql = "DELETE FROM inquiry WHERE num=".$num.""; // 삭제를 위한 sql문 작성
    $replySql = "DELETE FROM inquiryReply WHERE num=".$num.""; // 삭제할 글에 달린 댓글도 같이 삭제

    if(mysqli_query($conn, $sql) && mysqli_query($conn, $replySql)){
        echo "<script>alert('게시글이 삭제되었습니다.');
        location.href='./guide4.php?page=1';</script>";
    } else {
        echo "<script>
        alert('게시글이 삭제되지 않았습니다. 다시 시도해주세요.');
        </script>";
    }

    ?>
</body>
</html>
