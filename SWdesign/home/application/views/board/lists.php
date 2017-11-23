


<?php
///////////////////////////// 클럽 게시판 ///////////////////////////
if($type == 0):
?>
<div class="boardWrap">
    <table class="board">
        <caption>게시글 목록 테이블</caption>
        <colgroup>
                <col width="60">
                <col>
                <col width="120">
                <col width="120">
                <col width="80">
        </colgroup>
        <thead>
            <tr>
                <th>번호</th>
                <th>제목</th>
                <th>글쓴이</th>
                <th>작성시각</th>
                <th>조회수</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>


<?php
//////////////////////// 클럽 게시판 끝 //////////////////////////////////
endif;
?>

<div class="paginated">
    <a data-page="1" class="now">1</a>
</div>

<script type="text/javascript">
$board = null;
var boardController = {
    type : <?= $type ?>,
    idx : <?= $clubIdx ?>,
    notice : <?= $notice ?>,
    start : 0,
    limit : 9,
    list_num : 10,
    list_data : null,
    total_num : 0,
    init : function(){
        $board = this;
        this.getList();
    },
    getList : function(){ //리스트 가져오는 메소드
        $.ajax({
            type : "POST",
            async : true,
            url : "/appData/boardResponse.php",
            data : {
                type : 'list',
                boardType : $board.type,
                adminIdx : $board.idx,
                isNotice : $board.notice
            },
            success : function(data){
				console.log(data);
                $board.list_data = data.list;
                $board.total_num = 4;
                $board.makeList();
            },
			error : function(e){
				console.log(e.responseText);
			}
        });
    },
    makeList : function(){
		console.log(this.list_data);
        tbody = $("tbody");
		var data = this.list_data;
		tbody.html("");
		var idx = 0;
        for(i=this.start; i<this.total_num; i++){
			tr = $("<tr>"); 
			no = $("<td>").text(i);
			subject = $("<td>").append($("<a>").text(data[idx]["subject"]));
			author = $("<td>").text(data[idx]["name"]);
			time = $("<td>").text(data[idx]["time"]);
			hit = $("<td>").text(data[idx]["hit"]);
			tr.append(no);
			tr.append(subject);
			tr.append(author);
			tr.append(time);
			tr.append(hit);
			tbody.append(tr);
			idx++;
		}
    }
}
</script>



<script type="text/javascript">
    $(document).ready(function(){
        boardController.init();
    });
</script>