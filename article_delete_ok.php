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
    $sql = "DELETE FROM article WHERE num=".$num.""; // 삭제를 위한 sql문 작성

    if(mysqli_query($conn, $sql)){
        echo "<script>alert('삭제되었습니다.');
        location.href='./guide2.php?page=1';</script>";
    } else {
        echo "<script>
        alert('게시글이 삭제되지않았습니다. 다시 시도해주세요.');
        </script>";
    }
    
    ?>
</body>
</html>