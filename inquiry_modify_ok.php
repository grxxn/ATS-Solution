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

    $modiNum = $_GET['num']; // 수정하고있는 글의 번호를 받아옴 

    // form 데이터 받아오기
    $field = $_POST['field'];
    $title = $_POST['userTitle']; // 필수입력
    $name = $_POST['userName']; // 필수입력
    $pw = $_POST['userPw']; // 필수입력 
    $tel = $_POST['userTel'];
    $company = $_POST['userCompany'];
    $companyAddr = $_POST['userCompanyAddr'];
    $content = $_POST['inquiry']; // 필수입력
    $date = date('Y-m-d'); // 수정한 날짜로 변경

    // sql문 작성 - 수정이므로 insert문이 아닌 update문 사용 
    $sql = "UPDATE inquiry SET inquiry_field = '".$field."',
    title = '".$title."',
    id = '".$name."',
    pw = '".$pw."',
    tel = '".$tel."',
    company = '".$company."',
    company_addr = '".$companyAddr."',
    content = '".$content."',
    inquiryDate = '".$date."' WHERE num='".$modiNum."'";

    if(mysqli_query($conn, $sql)) {
        echo "<script>
        alert('글 수정이 완료되었습니다.');
        location.href='./inquiry_view.php?num=".$modiNum."';</script>";
    } else {
        echo "<script>
        alert('글 수정이 실패하였습니다. 다시 시도해주세요.');
        history.back();</script>";
    }
?>

</body>
</html>