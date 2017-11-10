
<?php echo form_open('/member/login/ok', array('id'=>'loginForm', 'name'=>'loginForm', 'onSubmit'=>'return validation();')); ?>
            <input type="hidden" name="ref" value="<?php if($_GET): echo $_GET['ref']; endif; ?>" />
            <p class="login">
                <span class="tit">We Run - 통합 대회 관리 시스템 <strong class="cOrg">로그인</strong></span>
                <span class="contWrap">
                    <span class="radioBox">
                        <label for="is_general">
                            <input type="radio" name="permit" id="is_general" value="3" checked="checked" /> 개인
                        </label>
                        <label for="is_host">
                            <input type="radio" name="permit" id="is_host" value="2" /> 주최측
                        </label>
                    </span>
                    <span class="inputBox">
                        <span class="input">
                            <input type="text" name="email" title="이메일" placeholder="이메일" required />
                            <input type="password" name="passwd" title="비밀번호" placeholder="비밀번호" required />
                        </span>
                        <button type="submit" class="txtBtn bgBlue">로그인</button>
                    </span>

                    <span class="txtBox">
                        <i>아직 회원이 아니세요? <a href="/member/join" class="cGry cBold">회원가입</a></i>
                        <i>아이디/비밀번호를 잊으셨나요? <a href="#" class="cGry cBold">정보찾기</a></i>
                    </span>
                </span>
            </p>
		</form>

<script type="text/javascript">

var validation = function(){
	return Werun.util.FormCheck($("#loginForm"));
}

var setEvent = function(){
	$("input[type=text], input[type=password]").keypress(function(e){
		if(e.keyCode == 13){
            e.preventDefault();
            $(this).closest("form").submit();
		}
	});
}

(function(){
	setEvent();
});
</script>