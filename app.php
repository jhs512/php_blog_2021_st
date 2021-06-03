<?php
require_once __DIR__ . '/app/repository/MemberRepository.php';
require_once __DIR__ . '/app/repository/ArticleRepository.php';

require_once __DIR__ . '/app/service/MemberService.php';
require_once __DIR__ . '/app/service/ArticleService.php';

require_once __DIR__ . '/app/controller/MemberController.php';
require_once __DIR__ . '/app/controller/ArticleController.php';

require_once __DIR__ . '/app/global.php';

function App__getViewPath($viewName) {
  return __DIR__ . '/public/' . $viewName . '.view.php';
}

function App__runBeforActionInterCeptor() {
  global $App__memberService;

  global $App__isLogined;
  global $App__loginedMemberId;
  global $App__loginedMember;
  
  if ( isset($_SESSION['loginedMemberId']) ) {
    $App__isLogined = true;
    $App__loginedMemberId = intval($_SESSION['loginedMemberId']);
    $App__loginedMember = $App__memberService->getForPrintMemberById($App__loginedMemberId);
  }
}

function App__runInterceptors() {
  App__runBeforActionInterCeptor();
}

function App__runAction(string $action) {
  list($controllerTypeCode, $controllerName, $actionFuncName) = explode('/', $action);

  $controllerClassName = "APP__" . ucfirst($controllerTypeCode) . ucfirst($controllerName) . "Controller";
  $actionMethodName = "action";

  if ( str_starts_with($actionFuncName, "do") ) {
    $actionMethodName .= ucfirst($actionFuncName);
  }
  else {
    $actionMethodName .= "Show" . ucfirst($actionFuncName);
  }

  $usrArticleController = new $controllerClassName();
  $usrArticleController->$actionMethodName();
}

function App__run(string $action) {
  App__runInterceptors();
  App__runAction($action);  
}