
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

<?php echo form_open_multipart('/member/join/ok'); ?>

<div class="termsForm">
    <div class="agreeHeader">
        <div class="agreeText">
            <p>아래 <strong class="cOrg">*</strong> 표시 된 내용은 필수입력사항입니다..</p>
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
                    <input type="text" placeholder="ex) admin" name="email">
                    <span>@</span>
                    <input type="text" placeholder="ex) werun.pe.kr" name="email">
                    <button class="tableBtn" type="button">중복확인</button>
                </td>
            </tr>
            <tr>
                <th class="required">비밀번호</th>
                <td>
                    <input type="password" placeholder="8자 이상의 영문,숫자,특수문자 조합" name="password">
                    <input type="password" placeholder="패스워드 확인" name="password2">
                </td>
            </tr>
            <tr>
                    <th class = "required">이름</th>
                    <td><input type="text" placeholder="한글 or 영문 전체 이름 입력." name="name"></td>
            </tr>
            <tr>
                <th class = "required">닉네임</th>
                <td>
                <input type = "text" placeholder = "한글 or 영문, 2글자 이상" name ="nickname">
                </td>
            </tr>
            <tr>
                <th class = "required">생년월일</th>
                    <td>
                        <input type="text" placeholder="0000-00-00" name="bDate" />
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
                    <select name="parts">
                        <option>야구</option>
                        <option>배드민턴</option>
                    </select>
                </td>
            </tr>
            <tr>
                <th>거주지</th>
                <td>
                    <span>시/도 : </span>
                    <select name="state">
                        <option value="서울">서울</option>
                    </select>
                    <span class="pl20">시/군/구 : </span>
                    <select name="city">
                        <option value="강남구">강남구</option>
                    </select>
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
        <button type="submit" class="txtBtn bgBlue">회원가입</button>
    </div>
</div>

</form>



<script type="text/javascript">
$(document).ready(function(){
    $("[name=bDate]").datepicker();
    //{
    //    dayNames: [ "월", "화", "수", "목", "금", "토", "일" ],
    //    dateFormat : "yyyy-mm-dd"
    //});
});
</script>