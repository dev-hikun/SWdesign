<article class="title">
    <h2>클럽 등록</h2>
    <div>
        <span>클럽을 개설하여 가까운 사람들과 함께하세요!</span>
    </div>
</article>

<nav class="lnb">
    <ul class="three">
        <li <?php if($mode == 'index'): ?> class="on"<?php endif; ?>><a href="/club" title="클럽 리스트">클럽 리스트 / 검색</a></li>
        <li <?php if($mode == 'regist'): ?> class="on"<?php endif; ?>><a href="/club/regist" title="클럽 등록">클럽 등록</a></li>
        <li <?php if($mode == 'admin'): ?> class="on"<?php endif; ?>><a href="/club/regist" title="클럽 관리">클럽 관리</a></li>
    </ul>
</nav>