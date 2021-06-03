<?php
class APP__MemberRepository {
  public function getForPrintMemberByLoginIdAndLoginPw(string $loginId, string $loginPw): array|null {
    $sql = DB__secSql();
    $sql->add("SELECT *");
    $sql->add("FROM `member` AS M");
    $sql->add("WHERE M.loginId = ?", $loginId);
    $sql->add("AND M.loginPw = ?", $loginPw);
    
    return DB__getRow($sql);
  }

  public function getForPrintMemberById(int $id): array|null {
    $sql = DB__secSql();
    $sql->add("SELECT M.*");
    $sql->add("FROM `member` AS M");
    $sql->add("WHERE M.id = ?", $id);
    return DB__getRow($sql);
  }
}