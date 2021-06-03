<?php
$pageTitle = "게시물 상세내용, ${id}번 게시물";
?>
<?php require_once __DIR__ . "/../head.php"; ?>

<div>
  <a href="list.php">리스트</a>
  <a href="modify.php?id=<?=$article['id']?>">수정</a>
  <a onclick="if ( confirm('정말 삭제 하시겠습니까?') == false ) return false;" href="doDelete.php?id=<?=$article['id']?>">삭제</a>
</div>
<hr>

<div>번호 : <?=$article['id']?></div>
<div>작성날짜 : <?=$article['regDate']?></div>
<div>수정날짜 : <?=$article['updateDate']?></div>
<div>제목 : <?=$article['title']?></div>
<div>내용 : <?=$article['body']?></div>

<?php require_once __DIR__ . "/../foot.php"; ?>