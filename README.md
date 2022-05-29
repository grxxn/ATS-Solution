# ATS Solution
<a href="http://atssolution.co.kr/" target="_blank"><img src="/images/로고.JPG" alt="atssolution 로고"></img></a><br/>
주식회사 에이티에스 솔루션은 2021년 5월 창업한 스타트업으로, 바닥신호등을 판매하는 업체입니다.   
홍보를 위한 페이지 제작에 대한 업무를 맡게 되어 2021년 11월부터 2022년 1월까지 총 3달동안 진행한 프로젝트로, 완성 직후 네이버 광고 시스템을 이용하여 파워링크에 등록된 상태입니다. 

## 📌 Link
[클릭시 해당 페이지로 이동합니다.](http://www.atssolution.co.kr)
   
## 📌 Description 
- html을 통해 기업과 제품에 대한 홍보 페이지 제작
- php를 통해 대외자료, 대리점 문의 등 게시판 기능 구현
- tablet, mobile 등 사이즈별로 다른 반응형 페이지 구현
- 홈페이지 개설 후 대리점 문의 및 상품 문의전화 다수, 실제 대리점 계약 체결

   
## 📌 Do For Start
- 카페 24에서 웹호스팅 구매
- 해당 웹호스팅 서버에서는 MySQL 사용
- MySOL과 php를 연동이 필요
```
<?php
   $conn = mysqli_connect("host 주소", "계정명", "계정 비밀번호", "DB 이름");
   if(!$conn) {
      $error = mysqli_connect_error();
      $errno = mysqli_connect_errno();
      
      print "$errno: $error \n";
      exit()
   }
   
   $sql = "사용할 SQL문 작성";
   
   $rs = mysqli_query($conn, $sql)
?>
```
   
## 📌 Directory Structure  
- style - CSS 파일   
- Javascript - JS 파일   
- images - 페이지에서 사용된 이미지들을 모아놓은 파일   


## 📌 Languages
<img src="https://img.shields.io/badge/-HTML5-%23E34F26?style=flat-square&logo=HTML5&logoColor=white"> <img src="https://img.shields.io/badge/-CSS3-%231572B6?style=flat-square&logo=CSS3&logoColor=white"> <img src="https://img.shields.io/badge/-JavaScript-%23F7DF1E?style=flat-square&logo=JavaScript&logoColor=black"> <img src="https://img.shields.io/badge/-MariaDB-%23003545?style=flat-square&logo=MariaDB&logocolor=%23003545"> <img src="https://img.shields.io/badge/-PHP-%23777BB4?style=flat-square&logo=PHP&logoColor=white">


## 📌 Tools
<img src="https://img.shields.io/badge/-VisualStudioCode-%23007ACC?style=flat-square&logo=VisualStudioCode&logoColor=white" /> <img src="https://img.shields.io/badge/-FileZilla-%23BF0000?style=flat-square&logo=FileZilla&logoColor=white" /> <img src="https://img.shields.io/badge/-GitHub-%23181717?style=flat-square&logo=GitHub&logoColor=white" />


