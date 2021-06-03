<?php
class APP__ArticleRepository {
  public function getForPrintArticles(): array {
    $sql = DB__secSql();
    $sql->add("SELECT *");
    $sql->add("FROM article AS A");
    $sql->add("ORDER BY A.id DESC");
    return DB__getRows($sql);
  }

  public function getForPrintArticleById(int $id): array|null {
    $sql = DB__secSql();
    $sql->add("SELECT *");
    $sql->add("FROM article AS A");
    $sql->add("WHERE id = ?", $id);
    return DB__getRow($sql);
  }

  public function writeArticle(string $title, string $body):int {
    $sql = DB__secSql();
    $sql->add("INSERT INTO article");
    $sql->add("SET regDate = NOW()");
    $sql->add(", updateDate = NOW()");
    $sql->add(", title = ?", $title);
    $sql->add(", `body` = ?", $body);
    $id = DB__insert($sql);

    return $id;
  }

  public function modifyArticle(int $id, string $title, string $body) {
    $sql = DB__secSql();
    $sql->add("UPDATE article");
    $sql->add("SET updateDate = NOW()");
    $sql->add(", title = ?", $title);
    $sql->add(", `body` = ?", $body);
    $sql->add("WHERE id = ?", $id);
    $id = DB__update($sql);
  }

  public function deleteArticle(int $id) {
    $sql = DB__secSql();
    $sql->add("DELETE FROM article");
    $sql->add("WHERE id = ?", $id);
    $id = DB__delete($sql);
  }
}