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
    $modiReply = $_GET['rno']; // 수정하고자하는 댓글의 번호

    $sql = "SELECT * FROM inquiryReply WHERE replyNum = ".$modiReply."";

    // form 데이터 받아오기 
    $name = $_POST['inquiry_replyModi_name']; 
    $pw = $_POST['inquiry_replyModi_pw']; 
    $content = $_POST['inquiry_replyModi_content'];
    $date = date('Y-m-d');
    $replyNum = $modiReply;


    // sql문 작성 - 댓글 수정이므로 update문 사용  
    $sql = "UPDATE inquiryReply SET id = '".$name."',
    pw = '".$pw."',
    content = '".$content."',
    replyDate = '".$date."' WHERE replyNum='".$replyNum."'";
    

    if(mysqli_query($conn, $sql)){
        echo "<script>
        location.href='./inquiry_view.php?num=$num';</script>";
    } else {
        echo "<script>
        alert('댓글 수정이 실패하였습니다. 다시 시도해주세요.');
        history.back();</script>";
    }
?>
</body>
</html>