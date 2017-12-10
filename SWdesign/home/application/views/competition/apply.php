<div class="competitionViewWrap">
<?php
    $this->load->view('competition/title');
?>

    <nav class="lnb">
        <ul class="six">
            <li><a href="/competition/view">대회정보</a></li>
            <li class="on"><a href="/competition/apply/">신청현황/접수</a></li>
            <li><a href="#">대진표</a></li>
            <li><a href="#">경기현황/결과</a></li>
            <li><a href="#">대회Talk</a></li>
            <li><a href="#">공지사항</a></li>
        </ul>
    </nav>

    <h3>
        부서별 참가 허용기준
    </h3>

    <div>
        <table class="applyTable">
            <thead>
                <tr>
                    <th>구분</th>
                    <th>청년부</th>
                    <th>베테랑부</th>
                    <th>국화부</th>
                    <th>개나리부</th>
                    <th>지도자부</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th>순수동호인</th>
                    <td>만 20세 이상</td>
                    <td>만 50세 이상</td>
                    <td>만 20세 이상</td>
                    <td>만 20세 이상</td>
                    <td>만 20세 이상</td>
                </tr>
                <tr>
                    <th>초등학교, 동호인지도자</th>
                    <td>만 35세 이상</td>
                    <td>만 50세 이상</td>
                    <td>만 50세 이상</td>
                    <td>x</td>
                    <td>만 20세 이상</td>
                </tr>
                <tr>
                    <th>중학교</th>
                    <td>만 40세 이상</td>
                    <td>만 55세 이상</td>
                    <td>만 55세 이상</td>
                    <td>x</td>
                    <td>만 20세 이상</td>
                </tr>
                <tr>
                    <th>고등학교</th>
                    <td>만 45세이상</td>
                    <td>만 60세 이상</td>
                    <td>만 55세 이상</td>
                    <td>x</td>
                    <td>만 20세 이상</td>
                </tr>
                <tr class="etc">
                    <th>기타사항</th>
                    <td colspan="5">
                        ■ 연령은 주민등록상의 연도만 적용한다. (당해년도-출생년도 = 만 나이)<br>
                        ■ 청구선수는 테니스선수에 준한다.<br>
                        ■ 동호인지도자는 초등학교 선수출신에 준한다.<br>
                        ■ 동호인지도자란 순수아마추어 지도자를 말함<br>
                        ■ 선수 또는 동호인지도자 출신 간에는 파트너를 할 수 없다
                    </td>
                </tr>
            </tbody>
        </table>
    </div>


    <h3>부서별 신청현황 / 접수</h3>

    <div>
        <table class="applyTable">
            <thead>
                <tr>
                    <th>참가부서</th>
                    <th>신청기간</th>
                    <th>경기일시</th>
                    <th>신청현황</th>
                    <th>신청하기</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>지역신인부</td>
                    <td>2017.04.24(월) 12:00 ~ 2017.04.24(월) 12:00</td>
                    <td>2017.06.10(토) 12:00 ~</td>
                    <td>0/0</td>
                    <td><button class="txtBtn smallest">신청하기</button></td>
                </tr>
                <tr>
                    <td>전국신인부</td>
                    <td>2017.04.24(월) 12:00 ~ 2017.06.01(목) 12:00</td>
                    <td>2017.06.18(일) 12:00 ~</td>
                    <td>210/210</td>
                    <td><button class="txtBtn smallest" disabled>신청마감</button></td>
                </tr>
                <tr>
                    <td>개나리부</td>
                    <td>2017.04.24(월) 12:00 ~ 2017.06.17(토) 16:00</td>
                    <td>2017.06.19(월) 12:00 ~</td>
                    <td>135/999</td>
                    <td><button class="txtBtn smallest">신청하기</button></td>
                </tr>
                <tr>
                    <td>남자오픈부</td>
                    <td>2017.04.24(월) 12:00 ~ 2017.06.23(금) 12:00</td>
                    <td>2017.06.24(토) 12:00 ~</td>
                    <td>27/99</td>
                    <td><button class="txtBtn smallest">신청하기</button></td>
                </tr>
                <tr>
                    <td>혼합복식부</td>
                    <td>2017.04.24(월) 12:00 ~ 2017.06.23(금) 12:00</td>
                    <td>2017.06.24(토) 12:00 ~</td>
                    <td>41/99</td>
                    <td><button class="txtBtn smallest">신청하기</button></td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="buttonArea">
    </div>
</div>