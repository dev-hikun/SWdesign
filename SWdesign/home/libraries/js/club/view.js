$club = null;

var clubController = {
    clubIdx : null,
    clubInfo : null,
    init : function(){
        $club = this;
        this.setPage();
    },
    getPageInfo : function(){
        $.ajax({
            type : "POST",
            url : "/appData/myclubResponse.php",
            data : {
                table : "club",
                type : "view",
                clubIdx : $club.clubIdx
            },
            async:false,
            success : function(data){
                $club.clubInfo = data.list;
            },
            error : function(e){
                console.log(e);
            }
        });
    },
    setPage : function(){
        this.getPageInfo();
        data = this.clubInfo[0];
        $("article.title h2, .listTop h3").html(data.title);
        $("article.title div span").html(data.description);
        $(".clubImg img").attr('src', '/site_data/club_img/'+data.image);
        $(".listTop p").html(data.contents);
        $("h4[data-name='memberCnt']").html(data.memberCnt);

        if(data.public == 2) data.public = "누구나. 즉시가입.";
        else if(data.public == 1) data.public = "운영진 승인제";
        else if(data.public == 3) data.public = "운영진 초대에 한해 가입가능";
        $("h4[data-name='public']").html(data.public);

        areas = data.addr.split('|');
        var area = "";
        for(i=0; i<areas.length; i++){
            if(areas[i] == data.area) areas[i] = "<strong class='cOrg'>"+data.area+"</strong>";
            if(i!=0) area+=", ";
            area += areas[i];
        }
        $("h4[data-name='addr']").html(area);

        $("h4[data-name='admin']").html(data.name);

        $("h4[data-name='juso'] .addr1").html(data.juso1);
        $("h4[data-name='juso'] .addr2").html(data.juso2);
        $("h4[data-name='sigan']").html(data.sigan);

        notice = $("nav.lnb a[title='공지사항']");
        notice.attr('href', notice.attr('href')+'/'+this.clubIdx);
        this.mapSetting();
    },
    mapSetting : function(){
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
    }
}

