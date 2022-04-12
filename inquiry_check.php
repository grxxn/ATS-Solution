<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ATS Solution</title>
    <link rel="stylesheet" href="./CSS/styles.css?var=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/9805a1e1da.js" crossorigin="anonymous"></script>
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
    
    $num = $_GET['num'];  // 글번호 
    $sql = "SELECT * FROM inquiry WHERE num=$num";
    $rs = mysqli_query($conn, $sql);

    $info = mysqli_fetch_array($rs);

    ?>
    <div class="chk_modal">
        <div class="chk_modal_content">
            <form action="" class="chk_form" method="POST">
                <input type="button" value="X" class="chk_modal_close" onclick="backList()">
                <p>해당 글은 비밀글입니다. 비밀번호를 입력해주세요.</p>
                <input type="password" name="pw_chk">
                <input type="submit" value="확인">
            </form>
        </div>
    </div>

    <?php
    $dbPw = password_hash($info['pw'], PASSWORD_DEFAULT);

    if(isset($_POST['pw_chk'])){
        $pw = $_POST['pw_chk'];
        if(password_verify($pw, $dbPw)){
            $pw == $dbPw;?>
            <script type="text/javascript">location.replace("inquiry_view.php?num=<?php echo $info['num'] ?>");</script>
        <?php
        } else { ?>
            <script type="text/javascript">alert('비밀번호가 일치하지않습니다.')</script>
        <?php } 
    } ?>
   

    <script>
        function backList(){
            location.href='./guide4.php?page=1';
        }
    </script>
    <script src="./JS/main.js"></script>
</body>
</html>