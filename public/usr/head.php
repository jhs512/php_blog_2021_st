<?php
$isLogined = $GLOBALS['App__isLogined'];
$loginedMemberId = $GLOBALS['App__loginedMemberId'];
$loginedMember = $GLOBALS['App__loginedMember'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?=$pageTitle?></title>
  <link rel="stylesheet" href="/common.css">
</head>
<body>
  <h1><?=$pageTitle?></h1>
  <hr>
  <?php if ( $isLogined ) { ?>
    <a href="../member/mypage.php"><?=$loginedMember['nickname']?> 마이페이지</a>
    <a href="../member/doLogout.php">로그아웃</a>
  <!-- unset($_SESSION); -->
  <?php } else { ?>
    <a href="../member/login.php">로그인</a>
    <a href="../member/join.php">회원가입</a>
  <?php } ?>