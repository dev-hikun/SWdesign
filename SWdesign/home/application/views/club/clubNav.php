<?php
$clubStr = "";
if(!isset($clubIdx) && isset($_SESSION['logged_in'])){
    $con = mysqli_connect("localhost", "root", "gmlgus");
    $db_con = mysqli_select_db($con, "werun");
    $query = "select clubIdx from clubmember where memberIdx='{$_SESSION['idx']}' and permit < 3";
    $result = mysqli_query($con, $query);
    $data = mysqli_fetch_row($result);
    $clubIdx = $data[0];
    $clubStr = "?clubIdx=".$clubIdx;
}
?>
<?php if($mode != 'myclub'): ?>
<nav class="lnb">
    <ul class="three">
        <li <?php if($mode == 'lists'): ?> class="on"<?php endif; ?>><a href="/club/lists" title="클럽 리스트">클럽 리스트 / 검색</a></li>
        <li <?php if($mode == 'regist'): ?> class="on"<?php endif; ?>><a href="/club/regist" title="클럽 등록">클럽 등록</a></li>
        <li <?php if($mode == 'myclub'): ?> class="on"<?php endif; ?>><a href="/club/myclub<?= $clubStr ?>" title="나의 클럽">나의 클럽</a></li>
    </ul>
</nav>
<?php
    endif;

if($mode == 'myclub'): ?>
<nav class="lnb">
    <ul class="<?php if($isAdmin=='N'): ?>three<?php else: ?>four<?php endif; ?>">
        <li <?php if($submode == 'index'): ?> class="on"<?php endif; ?>><a href="/club/myclub?clubIdx=<?= $clubIdx ?>" title="클럽정보">클럽정보</a></li>
        <li <?php if($submode == 'notice'): ?> class="on"<?php endif; ?>><a href="/club/myclub/notice?clubIdx=<?= $clubIdx ?>" title="공지사항">공지사항</a></li>
        <li <?php if($submode == 'board'): ?> class="on"<?php endif; ?>><a href="/club/myclub/board?clubIdx=<?= $clubIdx ?>" title="게시판">게시판</a></li>
        <?php if($isAdmin == 'Y'): ?>
            <li <?php if($submode == 'admin'): ?> class="on"<?php endif; ?>><a href="/club/myclub/admin?clubIdx=<?= $clubIdx ?>" title="클럽관리">클럽관리</a></li>
        <?php endif; ?>
    </ul>
</nav>
<?php endif; ?>