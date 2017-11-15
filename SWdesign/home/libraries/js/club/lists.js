var setCateArea = function(){
    btn = $("button.txtBtn.area");

}


var load_list = function(key="", part="", area="", start="", limit=""){
    $.ajax({
        async : false,
        type : "POST",
        data : {
            start : start,
            limit : limit,
            key : key,
            part : part,
            area : area,
            table : "club"
        },
        url : "/appData/clubListResponse.php",
        success(data){
            console.log(data);
            if(data.success == true){
                make_list(data);
            }else{
                alert("리스트 로딩에 실패했습니다.");
                console.log(data);
            }
        },
        error(e){
            console.log(e);
        }
    });
}

var make_list = function(data){
    $('.club_count .cOrg').text(data.num);
    $("ul.club_list").remove();
    div = $(".club_list_wrap");

    console.log(data.num)
    if(data.num == 0){
        div.css({
            textAlign: 'center',
            border:'1px solid #e3e3e3',
            padding: '50px 0px',
            lineHeight:'50px',
            fontSize:'20px'
        }).html("조건에 해당하는 클럽이 없습니다.<br />검색어, 지역, 종목을 다시 선택해보세요.<br /><button type='button' class='txtBtn bgBlue cWhite' onclick='listGenerate.init();'>클럽 리스트 페이지로</button>");
        return;
    }else{
        div.attr('style', '');
        div.html("");
    }

    data = data.list;
    list = $("<ul>").addClass("club_list");

    for(i=0; i<data.length; i++){
        li = $("<li>");
        a = $("<a>").attr("href", "#");

        //////////// img 처리

        imgBox = $("<span>").addClass("imgBox");
        img = $("<img>");
        if(!data[i].image){
            img.attr("src", "/libraries/images/common/noimage300by150.jpg");
            img.attr("alt", "등록된 이미지가 없습니다.");
        }else{
            img.attr("src", "/site_data/club_img/"+data[i].image);
            img.attr("alt", data[i].title);
        }
        ////////////// img처리 끝

        ///////////// tag 처리
        tags = $("<div>").addClass("tags");
        loc = $("<span>").addClass("loc").text(data[i].area.substring(0, 2));
        partStr = Werun.util.getPart(data[i].part);
        part = $("<span>").addClass("part").text(partStr);

        tags.append(loc);
        tags.append(part);

        imgBox.append(img);
        imgBox.append(tags);
        ///////////// tag 처리 끝

        /////////// title 처리
        titleBox = $("<span>").addClass("titleBox")
        loc = $("<span>").addClass("loc").html("<strong>"+data[i].area+"</strong> / <strong>"+partStr+"</strong>")
        title = $("<span>").addClass("title").text(data[i].title);
        titleBox.append(loc);
        titleBox.append(title);
        /////////// title 처리 끝

        ////////// btn 처리
        btnBox = $("<span>").addClass("btnBox");
        btn1 = $("<button type='button'>").html("<strong class='cOrg'>"+memberofClub(data[i].clubIdx)+"</strong>명");
        btnBox.append(btn1);
        ////////// btn 처리 끝
        a.append(imgBox);
        a.append(titleBox).append(btnBox);

        li.append(a)

        list.append(li);
    }
    div.append(list);
}

var memberofClub = function(idx){
    var returnNum = 0;
    $.ajax({
        type : 'POST',
        url : "/appData/selectResponse.php",
        data : {
            table : "clubmember",
            fields : ["count(*) as cnt"],
            where : "clubIdx = "+idx,
            order : "order by cnt asc"
        },
        async:false,
        success(data){
            returnNum = Number(data.data.data[0].cnt) + 1; //admin까지
        },
        error(e){
            console.log(e);
        }
    });
    return returnNum;
}