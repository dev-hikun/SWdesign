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
    <div class="clubImg">
        <img src="/libraries/images/common/noimage980by170.jpg" />
    </div>

    <div class="infoList">
        <div class="listTop listBox">
            <h3>킹갓제너럴배드민턴</h3>
            <p>
                배드민턴알못 가입 불능.<br />
                킹갓잘알만 뽑음
            </p>
        </div>
        <ul class="listTable">
            <li class="listBox">
                <p>클럽 회원</p>
                <h4 data-name="memberCnt">4명</h4>
                <div class="line"></div>
                <p>클럽가입 방식</p>
                <h4 data-name="public">승인제</h4>
                <div class="line"></div>
                <p>활동지역</p>
                <h4 data-name="addr">경기 용인시, 경기 수원시, 경기 광주시, <strong class="cOrg">경기 성남시</strong></h4>
            </li>
            <li class="listBlank">
            </li>
            <li class="listBox">
                <p>관리자</p>
                <h4 data-name="admin"><strong>이희현</strong></h4>
                <div class="line"></div>
                <p>클럽 운동 장소</p>
                <h4 data-name="juso" class='juso'>
                    <span class="addr1">경기도 성남시 수정구 남문로 32번길 7</span>
                    <span class="addr2">태평초등학교</span>
                </h4>
                <div class="line"></div>
                <p>클럽 운동 시간</p>
                <h4 data-name="sigan">매 주 토요일 11시~</h4>
            </li>
        </ul>

        <div id="map">
            지도 Area. Error시 이 메세지 보임.
        </div>
        <div class="buttonArea">
        <?php if($mode == "views"): ?>
            <button type="button" class="txtBtn bgBlue">가입신청</button>
        <?php endif; ?>
            <button type="button" class="txtBtn bgBlue">탈퇴하기</button>
        </div>
    </div>
</article>

<script type="text/javascript" src="https://openapi.map.naver.com/openapi/v3/maps.js?clientId=bhxp3gGawGimS6A0p0uC&submodules=geocoder"></script>
<script type="text/javascript" src="/libraries/js/club/myclub.js"></script>

<script type="text/javascript">
$(document).ready(function(){
    myclubController.memberIdx = <?= $_SESSION['idx'] ?>;
    myclubController.init();
});
</script>