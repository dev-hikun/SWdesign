var listGenerate = {
    page : 1,
    key : "",
    list_num : 9,
    start : 0,
    end : 9,
    area : "",
    part : "",
	totalCnt : "",
    init : function(){
        this.key = "";
        this.area = "";
        this.part = "";
        this.page = 1;
        this.start = Number(this.list_num) * (Number(this.page) - 1);
        this.end = this.start + this.list_num;
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
	setPage : function(){
		var idx = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : "";
        this.page = idx == undefined? 1 : idx;
        this.start = Number(this.list_num) * (Number(this.page) - 1);
        this.end = this.start + this.list_num;
		this.go();
	},
    go : function(){
		$page = this;
		$.ajax({
			async : false,
			type : "POST",
			data : {
				start : $page.start,
				limit : $page.list_num,
				key : $page.key,
				part : $page.part,
				area : $page.area,
				table : "club"
			},
			url : "/appData/clubListResponse.php",
			success : function(data){

				console.log(data);
				if(data.success == true){
					$page.totalCnt = data.num;
					$page.setPagenate();
					make_list(data);
				}else{
					alert("리스트 로딩에 실패했습니다.");
					console.log(data);
				}
			},
			error : function(e){
				console.log(e);
			}
		});
    },
    setPagenate : function(){
        div = $("div.paginated"); //초기화
        div.html("");

        totalPage = (Math.ceil(this.totalCnt/this.list_num)); //전체 페이지 갯수
		page_num = 10;
		totalSec = Math.ceil(totalPage/page_num);
		nowSec = Math.ceil(this.page/page_num);
		startPage = ((nowSec-1)*page_num)+1;
		endPage = (startPage+9) > totalPage? totalPage : startPage+9;
		nowSec = Math.ceil(this.page/page_num);
        nextBtnPage = (nowSec*page_num)+1;
        prevBtnPage = ((nowSec-2)*page_num)+1;

		/* aTag 정의 */
        var aTag = $("<a>");
        aTagList = [];

        first = (this.page == 1)? "" : aTag.clone().addClass("first").text("<<").attr("data-page", 1);
        prev = (nowSec == 1)? "" : aTag.clone().addClass("prev").text("<").attr("data-page", prevBtnPage);
        next = (nextBtnPage > totalPage)? "" : aTag.clone().addClass("next").text(">").attr("data-page", nextBtnPage);
        last = (this.page == totalPage)? "" : aTag.clone().addClass("last").text(">>").attr("data-page", totalPage);

        div.append(first).append(prev);

        for(var i=startPage; i<=endPage; i++){
            var temp = aTag.clone().text(i).attr("data-page", i);
            if(temp.data("page") == this.page) temp.addClass("now");
            div.append(temp);
            temp = null;
        }

        div.append(next).append(last);

        //이벤트 설정
        $page = this;
        div.find('a').each(function(){
			$(this).off('click');
            $(this).click(function(e){
                e.preventDefault();
                $page.setPage($(this).data("page"));
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
        btn1 = $("<button type='button'>").html("<strong class='cOrg'>"+data[i].memberCnt+"</strong>명");
        btnBox.append(btn1);
        ////////// btn 처리 끝
        a.append(imgBox);
        a.append(titleBox).append(btnBox);

        li.append(a)

        list.append(li);
    }
    div.append(list);
}
