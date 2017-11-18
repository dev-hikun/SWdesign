$myclub = null;

var myclubController = {
    clubIdx : null,
    clubList : null,
    memberIdx : 1,
    select : null,
    clubInfo : null,
    init : function(){
        $myclub = this;
        this.setClubList();
        this.setEventtoSelect();
    },
    getClubList : function(){
        $.ajax({
            type : "POST",
            url : "/appData/myclubResponse.php",
            data : {
                table : "club",
                type : "list",
                memberIdx : $myclub.memberIdx
            },
            async:false,
            success : function(data){
                $myclub.clubList = data.list;
            },
            error : function(e){
                console.log(e);
            }
        });
    },
    setClubList : function(){
        this.getClubList();
        this.select = $("[name=choiceClub]");
        for(i=0; i<this.clubList.length; i++){
            option = $("<option>").attr('value', this.clubList[i].clubIdx).text(this.clubList[i].title);
            this.select.append(option);
        }
    },
    setEventtoSelect : function(){
        this.select.change(function(){
            $myclub.clubIdx = $(this).val();
            $myclub.setPage();
        });
        this.select.trigger("change");
    },
    getPageInfo : function(){
        $.ajax({
            type : "POST",
            url : "/appData/myclubResponse.php",
            data : {
                table : "club",
                type : "view",
                clubIdx : $myclub.clubIdx,
                memberIdx : $myclub.memberIdx
            },
            async:false,
            success : function(data){
                $myclub.clubInfo = data.list;
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
        console.log(data);
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
        notice = $("nav.lnb a[title='게시판']");
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

