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

    $num = $_GET['num']; // 댓글이 쓰여진 글의 번호를 함께 저장 

    $sql = "SELECT * FROM inquiryReply";
    $data = mysqli_query($conn, $sql);
    $total_rows = mysqli_num_rows($data);

    // form 데이터 받아오기 
    $name = $_POST['inquiry_reply_name']; 
    $pw = $_POST['inquiry_reply_pw']; 
    $content = $_POST['inquiry_reply_content'];
    $date = date('Y-m-d');
    $replyNum = $total_rows + 1;


    // sql문(insert문) 작성 
    $sql = "INSERT INTO inquiryReply VALUES ('$name', '$pw', '$content', '$date', '$num', '$replyNum')";
    $inquirySql = "UPDATE inquiry SET comment=comment+1 WHERE num=".$num."";

    if(mysqli_query($conn, $sql) && mysqli_query($conn, $inquirySql)){
        echo "<script>
        location.href='./inquiry_view.php?num=$num';</script>";
    } else {
        echo "<script>
        alert('댓글 작성이 실패하였습니다. 다시 시도해주세요.');
        history.back();</script>";
    }
?>
</body>
</html>