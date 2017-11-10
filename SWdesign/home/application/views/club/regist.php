<article class="title">
    <h2>클럽 등록</h2>
    <div>
        <span>클럽을 개설하여 가까운 사람들과 함께하세요!</span>
    </div>
</article>

<?php $this->load->view('club/clubNav'); ?>


<article class="regist_wrap">
    <table class="bbs_write">
        <caption>클럽정보입력 테이블</caption>
        <colgroup>
            <col style="width:30%" />
            <col style="width:70%" />
        </colgroup>
        <tbody>
            <tr>
                <th class="required">클럽 이름</th>
                <td>
                    <input type="text" name="clubname" /> <!--placeholder = "한글이나 영문으로 2글자 이상 입력"-->
                    <button class="tableBtn">중복확인</button>
                </td>
            </tr>
            <tr>
                <th>대표 이미지</th>
                <td>
                    <input type="file" name="profileImage">
                </td>
            </tr>
            <tr>
                <th class="required">대표종목</th>
                <td>
                    <select name="parts">
                        <option>선택</option>
                        <option>야구</option>
                        <option>배드민턴</option>
                    </select>
                </td>
            </tr>
            <tr>
                <th class="required">활동 지역</th>
                <td>
                    <p><span class="cOrg">*</span> 활동 지역은 최대 3개까지 선택 가능합니다.</p>
                    <div class="addr">
                        <div class="sido">
                        </div>
                        <div class="siGungu">
                        </div>
                    </div>
                </td>
            </tr>
            <tr>

            <th class = "required">클럽 공개 여부</th>
                <td>
                    <input type="radio" name="public" value="2" checked="checked"> 아무나
                    <input type="radio" name="public" value="1"> 승인제
                    <input type="radio" name="public" value="0"> 비공개
                </td>
            </tr>
        </tbody>
    </table>

    <div class="buttonArea">
        <button type="button" class="txtBtn">취소</button>
        <button type="reset" class="resetBtn">다시입력</button>
        <button type="submit" class="txtBtn bgBlue">클럽 등록</button>
    </div>

</article>

<script type="text/javascript">
var settingSido = function(data){
    for(var i=0; i<data.length; i++){
        var aTag = $("<a></a>").attr({'data-idx':i, 'data-name':data[i].name, class:'sidoBtn'})
        aTag.text(data[i].name);
        $(".sido").append(aTag);
    }

    $(".sido a").each(function(){
        $(this).click(function(){
            if($(this).hasClass("on") == false){
                $(this).addClass("on");
                $(this).siblings("a").removeClass("on");
                settingSigungu(data, $(this).data('idx'));
            }else{
                $(this).removeClass("on");
                $(".siGungu").remove();
            }
        });
    });
}

var settingSigungu = function(data, idx){
    var parent = data[idx];
    var div = $("<div>").addClass("siGungu");
    $(".siGungu").remove();
    for(i=0; i<parent.data.length; i++){
        var addrName = "addr_"+idx+"_"+i;
        var lbl = $("<label>").attr("for", addrName);
        lbl.append($("<input type='checkbox' name='addrs' id='"+addrName+"' value='"+parent.data[i]+"'>"));
        lbl.append(parent.data[i]);
        div.append(lbl);
    }
    $(".sido").append(div);
}

var setEvent = function(){
    $.ajax({
        type : "POST",
        url : "/libraries/korea_administrative_district.json",
        async:false,
        success(data){
            settingSido(data.data);
        },
        error(e){
            console.log(e);
        }
    });
}
$(document).ready(function(){
    setEvent();
});
</script>