<script type="text/javascript">
    //alert('준비중인 페이지입니다.');
</script>


<article class="title">
    <h2>클럽 리스트/검색</h2>
    <div>
        <span>내 주변 또는 종목별로 클럽을 검색하고 가입해보세요.</span>
    </div>
</article>

<?php $this->load->view('club/clubNav'); ?>

<div class="club_search">
    <div class="searchArea">
        <form onsubmit="return search();" name="schForm">
            <input type="text" name="clubSearch" placeholder="검색어를 입력해주세요." />
            <button type="submit">검색</button>
        </form>
    </div>
    <div class="btnArea">
        <button class="txtBtn all on">전체</button>
        <button class="txtBtn area">지역별 ▼</button>
        <button class="txtBtn part">종목별 ▼</button>
    </div>
</div>
<p class="club_count">
    총 <strong class="cOrg">941</strong>건의 클럽이 있습니다.
</p>

<div class="club_list_wrap">
    <ul class="club_list">
        <li>
            <a href="#">
                <span class="imgBox">
                    <img src="/libraries/images/common/noimage300by150.jpg" alt="등록된 이미지가 없습니다./" />
                    <div class="tags">
                        <span class="loc">강원</span>
                        <span class="part">테니스</span>
                    </div>
                </span>
                <span class="titleBox">
                    <span class="loc"><strong>강원 춘천시</strong> / <strong>테니스</strong></span>
                    <span class="title">테레사(테니스 레슨 받는 사람들)</span>
                </span>
                <span class="btnBox">
                    <button><strong class="cOrg">14</strong>명</button>
                    <button>상세</button>
                </span>
            </a>
        </li>
    </ul>
</div>

<div class="paginated">
    <a href="#" class="first">&lt;&lt;</a>
    <a href="#" class="prev">&lt;</a>
    <a href="#" class="now">1</a>
    <a href="#">2</a>
    <a href="#">3</a>
    <a href="#" class="next">&gt;</a>
    <a href="#" class="end">&gt;&gt;</a>
</div>


<script type="text/javascript">
var load_list = function(key="", part="", area="", start="", limit=""){
    $.ajax({
        async : false,
        type : "POST",
        data : {
            Start : start,
            limit : limit,
            key : key,
            part : part,
            area : area,
            table : "club"
        },
        url : "/appData/clubListResponse.php",
        success(data){
            make_list(data.list)
        },
        error(e){
            console.log(e);
        }
    });
}
var make_list = function(data){
	console.log(data);
	
	div = $(".club_list_wrap");
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
		imgBox.append(img);
		////////////// img처리 끝
		
		///////////// tag 처리
		tags = $("<div>").addClass("tags");
		loc = $("<span>").addClass("loc");
		locs = data[i].addr.split('|');
		locArr = [];
		/* 지역 횟수를 구함
		 * 경기 광주시|서울 도봉구|경기 용인시 일 경우 locArr[경기] = 2, locArr[서울] = 1
		 */
		for(j=0; j<locs.length; j++){
			if(locArr[locs[j].substring(0,2)] > 0){
				locArr[locs[j].substring(0,2)]++;
			}else{
				locArr[locs[j].substring(0,2)] = 1;				
			}
		}
		
		
		
		var sorted = locArr.sort(function(a,b){return b-a});
		
		console.log(sorted);
		
		tags.append(loc);
		///////////// tag 처리 끝
		
		a.append(imgBox);
		a.append(tags);
		li.append(a);
		list.append(li);
	}
	div.append(list);
}

var search = function(){
	var form = $("form[name=schForm");
	if(Werun.util.FormCheck(form) == false) return false;
	
    load_list(form.find("[name=clubSearch]").val());
	return false;
}



$(document).ready(function(){
    load_list();
});
</script>