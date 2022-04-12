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

    $sql = "SELECT * FROM inquiry";
    $data = mysqli_query($conn, $sql);
    $total_rows = mysqli_num_rows($data);

    // form 데이터 받아오기 
    // 제목, 이름, 비밀번호, 글 내용은 필수입력요소 
    $field = $_POST['field'];
    $title = addslashes($_POST['userTitle']); // 필수입력
    $name = $_POST['userName']; // 필수입력
    $pw = $_POST['userPw']; // 필수입력 
    $tel = $_POST['userTel'];
    $company = $_POST['userCompany'];
    $companyAddr = $_POST['userCompanyAddr'];
    $content = addslashes($_POST['inquiry']); // 필수입력
    $num = $total_rows + 1; // 글의 고유 번호
    $date = date('Y-m-d');
    $comment = 0; // 해당 글에 달린 댓글의 수. 초기 값은 0으로 설정
    if(isset($_POST['lockpost'])){
        $lockPost = '1'; // 비밀글인 경우
    } else {
        $lockPost = '0'; // 비밀글이 아닌 경우
    }


    // sql문(insert문) 작성 
    $sql = "INSERT INTO inquiry VALUES ('$field', '$title', '$name', '$pw', '$tel', '$company', '$companyAddr', '$content', '$num', '$date', '$comment', $lockPost)";

    if(mysqli_query($conn, $sql)){
        echo "<script>
        alert('글 작성이 완료되었습니다.');
        location.href='./guide4.php?page=1';</script>";
    } else {
        echo "<script>
        alert('글 작성이 실패하였습니다. 다시 시도해주세요.');
        history.back();</script>";
    }
?>
</body>
</html>