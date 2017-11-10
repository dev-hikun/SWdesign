
<article class="title">
    <h2 class="join">일반회원 가입</h2>
    <div>
        <span>&nbsp;</span>
    </div>
</article>

<nav class="lnb join">
    <ul class="three">
        <li class="on">01 회원약관동의</li>
        <li>02 회원정보 입력</li>
        <li>03 가입완료</li>
    </ul>
</nav>

<div class="termsForm">
    <div class="agreeHeader">
        <div class="agreeText">
            <p>위런에 오신 것을 환영합니다. 회원 가입 후 위런 회원만을 위한 다양한 혜택을 누리세요.</p>
            <p>위런 회원 가입을 위하여 아래 회원약관 및 개인정보처리방침 등을 확인하시고 동의하여 주시기 바립니다.</p>
        </div>
        <div class="agreeCheck">
            <label for="is_agree">
                <input type="checkbox" id="is_agree" name="is_agree" />전체 약관에 동의합니다
            </label>
        </div>
    </div>
    <div class="termsHeader">
        <p class="tit">위런 회원 이용약관</p>
    </div>
    <div class="termsBox">
        이용약관 내용이 들어가는 부분
    </div>
    <div class="termsCheck">
        <label for="is_agree1">
            <input type="checkbox" id="is_agree1" name="is_agree1" />위런 회원약관에 동의합니다.
        </label>
    </div>
    <div class="termsHeader">
        <p class="tit">개인정보 수집, 제공 및 활용 동의</p>
    </div>
    <div class="termsBox">
        개인정보 수집, 제공 및 활용 동의 내용이 들어가는 부분
    </div>
    <div class="termsCheck">
        <label for="is_agree2">
            <input type="checkbox" id="is_agree2" name="is_agree2" />위런의 개인정보 수집, 제공 및 활용에 동의합니다.
        </label>
    </div>
	<div class="buttonArea">
		<button type="button" class="txtBtn" onclick="history.back();">취소</button>
		<button type="button" class="txtBtn bgBlue" onclick="chkAgree();">다음</button>
	</div>
</div>

<script type="text/javascript">
function chkAgree(){
    if($("#is_agree").prop("checked") == false){
        alert("약관에 전체 동의하셔야 회원가입이 가능합니다.");
        return false;
    }else{
        document.location.href='/member/join/general/2';
    }
}

$(document).ready(function(){

    $("#is_agree").change(function(){
        $("#is_agree1, #is_agree2").prop("checked", $(this).prop("checked"));
    });

    $("#is_agree1, #is_agree2").change(function(){
        var all = $("#is_agree");
        var chk1 = $("#is_agree1").prop("checked");
        var chk2 = $("#is_agree2").prop("checked");

        if(chk1 == true && chk2 == true) all.prop("checked", true);
        else all.prop("checked", false);
    });
});
</script>