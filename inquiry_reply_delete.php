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

    $num = $_GET['num']; // 삭제할 댓글이 있는 글의 번호를 가져옴 
    $replyNum = $_GET['rno']; // 삭제할 댓글의 번호를 가져옴
    $sql = "DELETE FROM inquiryReply WHERE replyNum=".$replyNum.""; // 삭제를 위한 sql문 작성
    $inquirySql = "UPDATE inquiry SET comment=comment-1 WHERE num=".$num."";

    if(mysqli_query($conn, $sql) && mysqli_query($conn, $inquirySql)){
        echo "<script>alert('댓글이 삭제되었습니다.');
        location.href='./inquiry_view.php?num=".$num."';</script>";
    } else {
        echo "<script>
        alert('댓글이 삭제되지 않았습니다. 다시 시도해주세요.');
        </script>";
    }

    ?>
</body>
</html>