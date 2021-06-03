<?php

class DB__SeqSql {
  private string $templateStr = "";
  private array $params = [];

  public function __toString(): string
  {
    $str = '[';
    $str .= 'SQL=(' . $this->getTemplate() . ')';
    $str .= ', PARAMS=(' . implode(',', $this->getParams()) . ')';
    $str .= ']';
    
    return $str;
  }

  public function add(string $sqlBit, string $param = null) {
    $this->templateStr .= " " . $sqlBit;

    if ( $param ) {
      $this->params[] = $param;
    }
  }

  public function getTemplate(): string {
    return trim($this->templateStr);
  }

  public function getForBindParam1stArg(): string {
    $paramTypesStr = "";

    $count = count($this->params);

    for ( $i = 0; $i < $count; $i++ ) {
      $paramTypesStr .= "s";
    }

    return $paramTypesStr;
  }

  public function getParams(): array {
    return $this->params;
  }

  public function getParamsCount(): int {
    return count($this->params);
  }
}

function DB__secSql() {
  return new DB__SeqSql();
}

function DB__getStmtFromSecSql(DB__SeqSql $sql): mysqli_stmt {
  global $dbConn;
  $stmt = $dbConn->prepare($sql->getTemplate());
  if ( $sql->getParamsCount() ) {
    $stmt->bind_param($sql->getForBindParam1stArg(), ...$sql->getParams());
  }
  
  return $stmt;
}

function DB__getRow(DB__SeqSql $sql): array|null {
  $rows = DB__getRows($sql);

  if ( isset($rows[0]) ) {
    return $rows[0];
  }

  return null;
}

function DB__getRows(DB__SeqSql $sql): array {
  $stmt = DB__getStmtFromSecSql($sql);
  $stmt->execute();
  $result = $stmt->get_result();
  $rows = [];

  while ( $row = $result->fetch_assoc() ) {
    $rows[] = $row;
  }
  
  return $rows;
}

function DB__execute(DB__SeqSql $sql) {
  $stmt = DB__getStmtFromSecSql($sql);
  $stmt->execute();
}

function DB__insert(DB__SeqSql $sql): int {
  global $dbConn;
  DB__execute($sql);

  return mysqli_insert_id($dbConn);
}

function DB__update(DB__SeqSql $sql) {
  DB__execute($sql);
}

function DB__delete($sql) {
  DB__execute($sql);
}

function getIntValueOr(&$value, $defaultValue): int {
  if ( isset($value) ) {
    return intval($value);
  }

  return $defaultValue;
}

function getStrValueOr(&$value, $defaultValue): string {
  if ( isset($value) ) {
    return strval($value);
  }

  return $defaultValue;
}

function jsAlert($msg) {
  echo "<script>";
  echo "alert('${msg}');";
  echo "</script>";
}

function jsLocationReplaceExit($url, $msg = null) {
  if ( $msg ) {
    jsAlert($msg);
  }

  echo "<script>";
  echo "location.replace('${url}')";
  echo "</script>";
  exit;
}

function jsHistoryBackExit($msg = null) {
  if ( $msg ) {
    jsAlert($msg);
  }

  echo "<script>";
  echo "history.back();";
  echo "</script>";
  exit;
}