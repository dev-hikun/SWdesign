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
            console.log('-------------------');
            console.log(data);
        },
        error(e){
            console.log(e);
        }
    });
}

var search = function(){
	
	var form = $("form[name=schForm");
	if(Werun.util.FormCheck(form) == false) return false;
	
    load_list(form.find("[name=clubSearch]").val());
	return false;
}

$(document).ready(function(){
    //load_list();
});
</script>