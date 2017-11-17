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
    <ul class="three">
        <li <?php if($submode == 'info'): ?> class="on"<?php endif; ?>><a href="" title="클럽정보">클럽정보</a></li>
        <li <?php if($submode == 'notice'): ?> class="on"<?php endif; ?>><a href="" title="공지사항">공지사항</a></li>
        <li <?php if($submode == 'board'): ?> class="on"<?php endif; ?>><a href="" title="게시판">게시판</a></li>
    </ul>
</nav>
<?php endif; ?>