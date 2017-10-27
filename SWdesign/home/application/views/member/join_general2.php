
<article class="title">
    <h2 class="join">일반회원 가입</h2>
    <div>
        <span>&nbsp;</span>
    </div>
</article>

<nav class="lnb join">
    <ul class="three">
        <li>01 회원약관동의</li>
        <li class="on">02 회원정보 입력</li>
        <li>03 가입완료</li>
    </ul>
</nav>

<?php echo form_open('/member/join/general/2'); ?>

<div class="termsForm">
    <div class="agreeHeader">
        <div class="agreeText">
            <p>아래 <strong class="cOrg">*</strong> 표시 된 내용은 필수입력사항입니다..</p>
        </div>
    </div>

    <div class="buttonArea">
        <button type="button" class="txtBtn">취소</button>
        <button type="submit" class="txtBtn bgGry">다시입력</button>
        <button type="submit" class="txtBtn bgBlue">회원가입</button>
    </div>
</div>
</form>