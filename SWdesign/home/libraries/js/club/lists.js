var listGenerate = {
    page : 1,
    key : "",
    list_num : 9,
    start : 0,
    end : 9,
    area : "",
    part : "",
    init : function(){
        this.key = "";
        this.page = 1;
        this.start = Number(this.list_num) * (Number(this.page) - 1);
        this.end = this.start + this.list_num;
        this.area = "";
        this.part = "";
        $('.txtBtn.all').addClass("on");
        $("button.txtBtn.area").text("지역별 ▼").removeClass("on");
        $("button.txtBtn.part").removeAttr('data-idx').text("종목별 ▼").removeClass("on");
        this.go();
    },
    search : function(){
        var form = $("form[name=schForm]");
        if(Werun.util.FormCheck(form) == false) return false;
        this.key = form.find("[name=clubSearch]").val();
        this.go();
        return false;
    },
    setArea : function(){
        this.area = $("button.txtBtn.area").text();
        this.go();
    },
    setPart : function(){
        this.part = $("button.txtBtn.part").attr('data-idx');
        $("button.txtBtn.part").removeAttr('data-idx');
        this.go();
    },
    setPage : function(idx){
        this.page = idx;
        this.start = Number(this.list_num) * (Number(this.page) - 1);
        this.end = this.start + this.list_num;
    },
    go : function(){
        load_list(this.key,this.part,this.area,this.start,this.end);
        this.setPagenate();
    },
    setPagenate : function(){
        div = $("div.paginated");
        div.html("");
        //현재페이지 = now;
        list_num = $('.club_count .cOrg').text();
        numofAllpage = (Math.ceil(list_num/this.end));
        console.log(this.end);
        var aTag = $("<a>");
        aTagList = [];

        first = (this.page == 1)? "" : aTag.clone().addClass("first").text("<<").attr("data-page", 1);
        prev = (this.page == 1)? "" : aTag.clone().addClass("prev").text("<");
        next = (this.page == numofAllpage)? "" : aTag.clone().addClass("next").text(">");
        final = (this.page == numofAllpage)? "" : aTag.clone().addClass("final").text(">>").attr("data-page", numofAllpage);

        div.append(first).append(prev);

        for(i=1; i<=numofAllpage; i++){
            var temp = aTag.clone().text(i).attr("data-page", i);
            if(temp.data("page") == this.page) temp.addClass("now");
            div.append(temp);
            temp = null;
        }

        div.append(next).append(final);

        //이벤트 설정
        $page = this;
        div.find('a').each(function(){
            $(this).click(function(e){
                e.preventDefault();
                $page.setPage($(this).data('page'));
                $page.go();
            });
        });
    }
}

var setCateAreaBtn = function(Werun, listGenerate){
    var cateSet = {
        isOpen : false,
        ul : null,
        btn : null,
        areaArr : [],
        init:function(btn){
            this.btn = btn;
            this.ul = this.btn.siblings("ul");
            this.ul.css('display', 'none');
            this.isOpen = false;
            this.areaArr = Werun.util.getSidoArr();
            this.setUlTag();
        },
        setUlTag:function(){
            $area = this;

            this.btn.click({ul:this.ul, isOpen:this.isOpen}, function(e){
                e.preventDefault();

                if($area.isOpen == false){
                    e.data.ul.css('display', 'block');
                    $area.isOpen = true;
                    e.data.ul.mouseleave({isOpen:e.data.isOpen}, function(e){
                        $(this).hide();
                        $area.isOpen = false;
                    })
                }else{
                    e.data.ul.css('display', 'none');
                    $area.isOpen = false;
                }
            });

            this.generateLiTag();
        },
        generateLiTag : function(){
            for(i=0; i<this.areaArr.length; i++){
                var li = $("<li>").attr("data-name", this.areaArr[i].name).text(this.areaArr[i].name);
                $area = this;
                li.click({btn:this.btn}, function(e){
                    $area.btn.addClass("on");
                    $('.txtBtn.all').removeClass("on");
                    e.data.btn.text($(this).data("name"));
                    $area.btn.trigger('click');
                    listGenerate.setArea();
                });
                this.ul.append(li);
            }
        }
    }

    cateSet.init($("button.txtBtn.area"));
}

var setCatePartBtn = function(Werun, listGenerate){
    var cateSet = {
        isOpen : false,
        ul : null,
        btn : null,
        partArr : [],
        init:function(btn){
            this.btn = btn;
            this.ul = this.btn.siblings("ul");
            this.ul.css('display', 'none');
            this.isOpen = false;
            this.partArr = Werun.util.getPart();
            this.setUlTag();
        },
        setUlTag:function(){
            $this = this;

            this.btn.click({ul:this.ul, isOpen:this.isOpen}, function(e){
                e.preventDefault();

                if($this.isOpen == false){
                    e.data.ul.css('display', 'block');
                    $this.isOpen = true;
                    e.data.ul.mouseleave({isOpen:e.data.isOpen}, function(e){
                        $(this).hide();
                        $this.isOpen = false;
                    })
                }else{
                    e.data.ul.css('display', 'none');
                    $this.isOpen = false;
                }
            });

            this.generateLiTag();
        },
        generateLiTag : function(){
            for(i=0; i<this.partArr.length; i++){
                if(this.partArr[i] == undefined) continue;
                var li = $("<li>").attr("data-idx", i).text(this.partArr[i]);
                $this = this;
                li.click({btn:this.btn}, function(e){
                    $this.btn.addClass("on");
                    $('.txtBtn.all').removeClass("on");
                    e.data.btn.attr('data-idx', $(this).data("idx")).text($(this).text());
                    $this.btn.trigger('click');
                    listGenerate.setPart();
                });
                this.ul.append(li);
            }
        }
    }

    cateSet.init($("button.txtBtn.part"));
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