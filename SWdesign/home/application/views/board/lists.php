


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

<script type="text/javascript">
    $(document).ready(function(){
        boardController.init();
    });
</script>


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
    init : function(){
        $board = this;
        this.getList();
    },
    getList : function(){ //리스트 가져오는 메소드
        $.ajax({
            type : "POST",
            async : false,
            url : "/appData/boardResponse.php",
            data : {
                type : 'list',
                boardType : $board.type,
                adminIdx : $board.idx,
                isNotice : $board.notice
            },
            success : function(data){
                console.log(data);
            }
        });
    }
}
</script>