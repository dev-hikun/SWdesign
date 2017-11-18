<div class="myclubBanner"></div>

<div class="selectArea">
    <span class="left">
        <span>가입된 다른 클럽 선택 : </span>
        <select name='choiceClub'>
        </select>
    </span>
    <span class="right">
        <button type="button" class="txtBtn bgBlue" onclick="document.location.href='/club/lists'">전체 클럽 리스트</button>
    </span>
</div>

<article class="title club">
    <h2>-</h2>
    <div>
        <span>-</span>
    </div>
</article>

<?php $this->load->view('club/clubNav'); ?>

<article class="myclubContentWrap">
       <?php $this->werunboard->getList() ?>
</article>


<script type="text/javascript" src="/libraries/js/club/myclub_notice.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    myclubController.memberIdx = <?= $_SESSION['idx'] ?>;
    myclubController.clubIdx = <?= $clubIdx ?>;
    myclubController.init();
});
</script>