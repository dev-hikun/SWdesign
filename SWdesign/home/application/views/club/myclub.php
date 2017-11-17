<div class="myclubBanner"></div>

<div class="selectArea">
    <span class="left">
        <span>가입된 다른 클럽 선택 : </span>
        <select>
            <option>킹갓제너럴배드민턴</option>
        </select>
    </span>
    <span class="right">
        <button type="button" class="txtBtn bgBlue" onclick="document.location.href='/club/lists'">전체 클럽 리스트</button>
    </span>
</div>

<article class="title club">
    <h2>킹갓제너럴배트민턴</h2>
    <div>
        <span>우리클럽은 배드민턴 잘하는 사람만 뽑습니다</span>
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
                <h4>4명</h4>
                <div class="line"></div>
                <p>클럽가입 방식</p>
                <h4>승인제</h4>
                <div class="line"></div>
                <p>활동지역</p>
                <h4>경기 용인시, 경기 수원시, 경기 광주시, <strong class="cOrg">경기 성남시</strong></h4>
            </li>
            <li class="listBlank">
            </li>
            <li class="listBox">
                <p>관리자</p>
                <h4><strong>이희현</strong></h4>
                <div class="line"></div>
                <p>클럽 운동 장소</p>
                <h4 class='juso'>
                    <span class="addr1">경기도 성남시 수정구 남문로 32번길 7</span>
                    <span class="addr2">태평초등학교</span>
                </h4>
                <div class="line"></div>
                <p>클럽 운동 시간</p>
                <h4>매 주 토요일 11시~</h4>
            </li>
        </ul>

        <div id="map">
            지도가 들ㅇ어갈 자리
        </div>
        <div class="buttonArea">
            <button type="button" class="txtBtn bgBlue">가입신청</button>
        </div>
    </div>
</article>

<script type="text/javascript" src="https://openapi.map.naver.com/openapi/v3/maps.js?clientId=bhxp3gGawGimS6A0p0uC&submodules=geocoder"></script>



 <script type="text/javascript">
<!--
//네이버 지도 Api
$(document).ready(function(){

    naver.maps.Service.geocode({
            address: $('.juso .addr1').text()
        }, function(status, response) {
        if (status === naver.maps.Service.Status.ERROR) {
            return alert('Something Wrong!');
        }

        var item = response.result.items[0],
            point = new naver.maps.Point(item.point.x, item.point.y);


        map.setCenter(point);
        var marker = new naver.maps.Marker({
            position: point,
            map: map
        });
    });

    var map = new naver.maps.Map('map', {
        zoom: 10, //지도의 초기 줌 레벨
        minZoom: 1, //지도의 최소 줌 레벨
        zoomControl: true, //줌 컨트롤의 표시 여부
        zoomControlOptions: { //줌 컨트롤의 옵션
            position: naver.maps.Position.TOP_RIGHT
        }
    });



});
 //-->

</script>