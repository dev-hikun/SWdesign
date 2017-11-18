<?php if($mode != 'myclub'): ?>
<nav class="lnb">
    <ul class="three">
        <li <?php if($mode == 'lists'): ?> class="on"<?php endif; ?>><a href="/club/lists" title="클럽 리스트">클럽 리스트 / 검색</a></li>
        <li <?php if($mode == 'regist'): ?> class="on"<?php endif; ?>><a href="/club/regist" title="클럽 등록">클럽 등록</a></li>
        <li <?php if($mode == 'myclub'): ?> class="on"<?php endif; ?>><a href="/club/myclub" title="나의 클럽">나의 클럽</a></li>
    </ul>
</nav>
<?php
    endif;
if($mode == 'myclub'): ?>
<nav class="lnb">
    <ul class="<?php if($isAdmin=='N'): ?>three<?php else: ?>four<?php endif; ?>">
        <li <?php if($submode == 'index'): ?> class="on"<?php endif; ?>><a href="/club/myclub" title="클럽정보">클럽정보</a></li>
        <li <?php if($submode == 'notice'): ?> class="on"<?php endif; ?>><a href="/club/myclub/notice?clubIdx=<?= $clubIdx ?>" title="공지사항">공지사항</a></li>
        <li <?php if($submode == 'board'): ?> class="on"<?php endif; ?>><a href="/club/myclub/board?clubIdx=<?= $clubIdx ?>" title="게시판">게시판</a></li>
        <?php if($isAdmin == 'Y'): ?>
            <li <?php if($submode == 'admin'): ?> class="on"<?php endif; ?>><a href="/club/myclub/admin?clubIdx=<?= $clubIdx ?>" title="클럽관리">클럽관리</a></li>
        <?php endif; ?>
    </ul>
</nav>
<?php endif; ?>