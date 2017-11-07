
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

<?php echo form_open_multipart('/member/join/ok', array('id'=>'joinForm', 'name'=>'joinForm')); ?>

<div class="termsForm">
    <div class="agreeHeader">
        <div class="agreeText">
            <p>아래 <strong class="cOrg">*</strong> 표시 된 내용은 필수입력사항입니다.</p>
        </div>
    </div>

    <div class="termsHeader">
        <p class="tit">기본정보</p>
    </div>
    <table class="bbs_write">
        <caption>기본정보</caption>
        <colgroup>
            <col style="width:30%" />
            <col style="width:70%" />
        </colgroup>
        <tbody>
            <tr>
                <th class="required">이메일</th>
                <td>
                    <input type="text" placeholder="ex) admin" name="id" title="이메일 아이디" required>
                    <span>@</span>
                    <input type="text" placeholder="ex) werun.pe.kr" name="domain" title="이메일 도메인" required>
                    <button class="tableBtn" type="button" name="dupChk">중복확인</button>
					<input type="hidden" name="email" />
                </td>
            </tr>
            <tr>
                <th class="required">비밀번호</th>
                <td>
                    <input type="password" placeholder="8자 이상의 영문,숫자,특수문자 조합" title="비밀번호" name="password" required>
                    <input type="password" placeholder="패스워드 확인" title="비밀번호 확인" name="password2" required>
                </td>
            </tr>
            <tr>
                    <th class = "required">이름</th>
                    <td><input type="text" placeholder="한글 or 영문 전체 이름 입력." title="이름" name="name" required></td>
            </tr>
            <tr>
                <th class = "required">닉네임</th>
                <td>
                <input type = "text" placeholder = "한글 or 영문, 2글자 이상" title="닉네임" name ="nickname" required>
                </td>
            </tr>
            <tr>
                <th class = "required">생년월일</th>
                    <td>
                        <input type="text" placeholder="0000-00-00" title="생년월일" name="bDate" required />
                    </td>
            </tr>
            <tr>
                <th class = "required">성별</th>
                    <td>
                        <label for="sex">
                            <input type="radio" name="sex" id="sex" value="남" checked="checked" />남성
                            <input type="radio" name="sex" id="sex" value="여" />여성
                        </label>
                    </td>
            </tr>
            <tr>
                <th class = "required">전화번호</th>
                    <td>
                        <input type="text" placeholder="010-1234-5678" title="전화번호" name="phone" required />
                    </td>
            </tr>
            <tr>
                <th>주소</th>
                <td>
                    <p>
                        <button class="tableBtn" type="button" name="addrSearch">주소검색</button>
                        <input type="text" name="addr1" readonly="readonly" />
                    </p>

                    <p class="mt5">
                        <input type="text" name="addr2" title="상세주소" placeholder="상세주소" />
                    </p>

                    <input type="hidden" name="zipCode" />
                </td>
            </tr>
        </tbody>
    </table>


    <div class="termsHeader">
        <p class="tit">선택정보</p>
    </div>
    <table class="bbs_write">
        <caption>기본정보</caption>
        <colgroup>
            <col style="width:30%" />
            <col style="width:70%" />
        </colgroup>
        <tbody>
            <tr>
                <th>관심있는 종목</th>
                <td>
                    <div class="parts">
                        <label for="part1">
                            <input type="checkbox" value="1" name="part[]" id="part" />야구
                        </label>
                        <label for="part2">
                            <input type="checkbox" value="2" name="part[]" id="part2" />배드민턴
                        </label>
                    </div>
                    <input type="hidden" name="permit" value="3" />
                </td>
            </tr>
            <tr>
                <th>이름공개여부</th>
                <td>

                <label for="public1">
                    <input type="radio" name="public" id="public1" value="1" checked="checked" />
                    예
                </label>
                <label for="public2" class="ml10">
                    <input type="radio" name="public" id="public2" value="0" />
                    아니오(닉네임으로 공개)
                </label>

                </td>
            </tr>
            <tr>
                <th>프로필 이미지</th>
                <td>

                    <input type="file" name="profileImage">

                </td>
            </tr>
        </tbody>
    </table>

    <div class="buttonArea">
        <button type="button" class="txtBtn" onclick="history.back();">뒤로가기</button>
        <button type="reset" class="resetBtn">다시입력</button>
        <button type="submit" name="submit" class="txtBtn bgBlue">회원가입</button>
    </div>
</div>

</form>



<script type="text/javascript">

/* 주소 받아주기 */
var jusoCallBack = function(addr1, addr2, addr3, zipcode){
    $("[name=addr1]").val(addr1+" "+addr2);
    $("[name=addr2]").val(addr3);
    $("[name=zipCode]").val(zipcode);
}

/* 주소검색 팝업 */
var goPopup = function(){
    var pop = window.open("/popup/juso","pop","width=570,height=440, scrollbars=yes, resizable=yes");
}

/* 중복확인 버튼 ui 변경하기 */
var ChangeDupBtn = function(b){
	if(b == true){
		$("[name=email]").val($("[name=id]").val()+"@"+$("[name=domain]").val());
		$("[name=dupChk]").text("중복확인 완료").addClass("bgTrans").addClass("cOrg").css({
			cursor : "default",
			outline : "0px none"
		}).off();
	}else{
		return false;
	}
}

/* 중복체크 ajax */
var chkDuplicate = function(){

	id = $("[name=id]");
	domain = $("[name=domain]");

    if(id.val() == "" || domain.val() == ""){
        alert("이메일 또는 도메인을 입력해주세요.");
        id.focus();
        return false;
    }

    //형식체크
    if(Werun.util.EmailCheck(id.val()+"@"+domain.val()) == false){
        alert("이메일 형식이 올바르지 않습니다.");
        return false;
    };

	$.ajax({
	  type: "POST",
	  url: "/member/join/chk",
	  data: {
		   id:     $("[name=id]").val(),
		   domain: $("[name=domain]").val()
		},
	  success:function(data){
		if(data == "true"){
			alert("이미 가입되어 있는 이메일입니다.\r\n다른 이메일을 사용하시기 바랍니다.");
		}else{
			ChangeDupBtn(confirm("사용 가능한 이메일입니다. 사용하시겠습니까?"));
		}
	  },
	  error:function(request, status, error){
		console.log('code: '+request.status+"\n"+'message: '+request.responseText+"\n"+'error: '+error);
	  }
	});

}

/*이벤트 설정 */
var setEvent = function(){
    $("[name=addr1]").click(function(){ goPopup(); });
    $("[name=addrSearch]").click(function(){ goPopup(); });
    $("[name=bDate]").datepicker();
    $("[name=dupChk]").click(function(){ chkDuplicate(); });
    $("#joinForm [name=submit]").click(function(){
        if($("[name=email]").val() == ""){
            alert("이메일 중복확인이 필요합니다.");
            $("[name=email]").focus();
            return false;
        }

        if(($("[name=password]").val() != $("[name=password2]").val()) == true){
            alert("비밀번호와 비밀번호 확인이 올바르지 않습니다.");
            $("[name=password]").focus();
            return false;
        }

        if(Werun.util.LengthCheck($("[name=password]").val(), 8) == false){
            alert("비밀번호는 8자 이상으로 입력해주세요.");
            $("[name=password]").focus();
            return false;
        }
        if(Werun.util.FormCheck($(this).closest("form")) == false){
            return false;
        }
        return true;
    });
}

$(document).ready(function(){

    setEvent();

});
</script>