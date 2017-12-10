<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<article class="banner mt10">
    <img src="/site_data/banner_img/banner_01.jpg" />
</article>

<article class="mt10">
    <div class="calender">
    </div>
</article>

<link href="/libraries/extern/fullCalender/fullcalendar.min.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="/libraries/extern/fullCalender/moment.js"></script>
<script type="text/javascript" src="/libraries/extern/fullCalender/fullcalendar.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {

        $('div.calender').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month, basicWeek, basicDay'
            },
            titleFormat : 'YYYY년 MMMM',
            monthNames : ['1월 대회목록', '2월 대회목록', '3월 대회목록', '4월 대회목록', '5월 대회목록', '6월 대회목록', '7월 대회목록',
 '8월 대회목록', '9월 대회목록', '10월 대회목록', '11월 대회목록', '12월 대회목록'],
            defaultDate: '2017-12-11',
            navLinks: true, // can click day/week names to navigate views
            editable: true,
            eventLimit: true, // allow "more" link when too many events
            events: [
                {
                    title: '[경기] 경기도 청소년 배드민턴 대회',
                    start: '2017-07-01T00:00',
                    end: '2017-07-02T24:00',
                    color: '#1d4082'
                },
                {
                    title: '[전국] 물맑은 양평군수배 배드민턴 대회',
                    start: '2017-12-11',
                    end: '2017-12-18',
                    color: '#1d4082',
                    url: '/competition/lists',
                    textColor:'#ffffff'
                }
            ]
        });

    });
</script>
<div class="mt10"></div>