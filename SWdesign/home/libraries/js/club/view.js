$club = null;

var clubController = {
    clubIdx : null,
    clubInfo : null,
    memberIdx : null,
    init : function(){
        $club = this;
        this.setPage();
        this.setBtn();
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
        var publicTxt = "";
        if(data.public == 2) publicTxt = "누구나. 즉시가입.";
        else if(data.public == 1) publicTxt = "운영진 승인제";
        else if(data.public == 0) publicTxt = "운영진 초대에 한해 가입가능";
        $("h4[data-name='public']").html(publicTxt);

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
    },
    setBtn : function(){
        var dataList = this.clubInfo['memberList'];
        var isExist = false;
        var isAdmin = false;
        var isWait = false;

        for(i=0; i<dataList.length; i++){
            if(dataList[i].memberIdx == this.memberIdx && (dataList[i].permit == 0 || dataList[i].permit == 1)){ //관리자
                isAdmin = true;
                isExist = true;
                break;
            }else if(dataList[i].memberIdx == this.memberIdx && dataList[i].permit == 2){ //회원
                isAdmin = false;
                isExist = true;
                break;
            }else if(dataList[i].memberIdx == this.memberIdx && dataList[i].permit == 3){ //승인대기
                isAdmin = false;
                isWait = true;
                break;
            }
        }

        var btn = $("<button type='button' class='txtBtn bgBlue'>");
        var link = "";

        if(isAdmin == true){
            btn.text("클럽관리");
            link = "/club/myclub/admin?clubIdx="+this.clubIdx;
            btn.click(function(){
                document.location.href=link;
            });
        }else if(isAdmin == false && isExist == true){
            btn.text("클럽 상세 페이지");
            link = "/club/myclub?clubIdx="+this.clubIdx;
            btn.click(function(){
                document.location.href=link;
            });

        }else if(isWait == true){
            btn.text("가입승인 대기").removeClass("bgBlue").addClass("bgOrg").addClass("cWhite");
        }else{
            btn.text("클럽가입신청");
            link = "/club/join?clubIdx="+this.clubIdx;
            btn.click(function(){
                if($club.memberIdx == undefined){
                    alert('로그인 후 이용 가능합니다.')
                    document.location.href="/member/login?ref=club/view/1";
                    return;
                }

                if(confirm('가입신청 하시겠습니까?')){
                    var permit = 3;
                    var msg = "가입신청이 완료되었습니다. \r\n클럽 운영진의 승인이 완료될 시 가입됩니다.";
                    if($club.clubInfo[0].public == 2){
                        permit = 2;
                        msg = "가입이 완료되었습니다."
                    }
                    $.ajax({
                        type : "POST",
                        url : "/appData/insertResponse.php",
                        data : {
                            table : "clubmember",
                            fields : ["clubIdx", "memberIdx", "permit"],
                            values : [$club.clubIdx, $club.memberIdx, permit]
                        },
                        async:false,
                        success : function(data){
                            alert(msg);
                            document.location.href=location.href;
                        },
                        error : function(e){
                            console.log(e);
                        }
                    });
                }
            });
        }

        if(this.clubInfo[0].public != '0'){
            $(".buttonArea").html(btn);
        }
    }
}

