<?php
class APP__UsrArticleController {
  private APP__ArticleService $articleService;

  public function __construct() {
    global $App__articleService;
    $this->articleService = $App__articleService;
  }

  public function actionShowWrite() {
    require_once App__getViewPath("usr/article/write");
  }

  public function actionDoModify() {
    $id = getIntValueOr($_GET['id'], 0);
    $title = getStrValueOr($_GET['title'], "");
    $body = getStrValueOr($_GET['body'], "");

    if ( !$id ) {
      jsHistoryBackExit("번호를 입력해주세요.");
    }

    if ( !$title ) {
      jsHistoryBackExit("제목을 입력해주세요.");
    }

    if ( !$body ) {
      jsHistoryBackExit("내용을 입력해주세요.");
    }

    $article = $this->articleService->getForPrintArticleById($id);

    if ( $article == null ) {
      jsHistoryBackExit("${id}번 게시물은 존재하지 않습니다.");
    }

    $this->articleService->modifyArticle($id, $title, $body);

    jsLocationReplaceExit("detail.php?id=${id}", "${id}번 게시물이 수정되었습니다.");
  }

  public function actionDoDelete() {
    $id = getIntValueOr($_GET['id'], 0);
    
    if ( !$id ) {
      jsHistoryBackExit("번호를 입력해주세요.");
    }

    $article = $this->articleService->getForPrintArticleById($id);

    if ( $article == null ) {
      jsHistoryBackExit("${id}번 게시물은 존재하지 않습니다.");
    }

    $this->articleService->deleteArticle($id);

    jsLocationReplaceExit("list.php", "${id}번 게시물이 삭제되었습니다.");
  }

  public function actionDoWrite() {
    $title = getStrValueOr($_GET['title'], "");
    $body = getStrValueOr($_GET['body'], "");

    if ( !$title ) {
      jsHistoryBackExit("제목을 입력해주세요.");
    }

    if ( !$body ) {
      jsHistoryBackExit("내용을 입력해주세요.");
    }

    $id = $this->articleService->writeArticle($title, $body);

    jsLocationReplaceExit("detail.php?id=${id}", "${id}번 게시물이 생성되었습니다.");
  }

  public function actionShowList() {
    $articles = $this->articleService->getForPrintArticles();

    require_once App__getViewPath("usr/article/list");
  }

  public function actionShowDetail() {
    $id = getIntValueOr($_GET['id'], 0);

    if ( $id == 0 ) {
      jsHistoryBackExit("번호를 입력해주세요.");
    }
    
    $article = $this->articleService->getForPrintArticleById($id);

    if ( $article == null ) {
      jsHistoryBackExit("${id}번 게시물은 존재하지 않습니다.");
    }

    require_once App__getViewPath("usr/article/detail");
  }

  public function actionShowModify() {
    $id = getIntValueOr($_GET['id'], 0);

    if ( $id == 0 ) {
      jsHistoryBackExit("번호를 입력해주세요.");
    }

    $article = $this->articleService->getForPrintArticleById($id);

    if ( $article == null ) {
      jsHistoryBackExit("${id}번 게시물은 존재하지 않습니다.");
    }

    require_once App__getViewPath("usr/article/modify");
  }
}