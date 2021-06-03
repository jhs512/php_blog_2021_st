<?php
class APP__MemberService {
  private APP__MemberRepository $memberRepository;

  public function __construct() {
    global $App__memberRepository;
    $this->memberRepository = $App__memberRepository;
  }

  public function getForPrintMemberByLoginIdAndLoginPw(string $loginId, string $loginPw): array|null {
    return $this->memberRepository->getForPrintMemberByLoginIdAndLoginPw($loginId, $loginPw);
  }

  public function getForPrintMemberById(int $id): array|null {
    return $this->memberRepository->getForPrintMemberById($id);
  }
}