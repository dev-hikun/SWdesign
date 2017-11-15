<article class="title">
    <h2>클럽 등록</h2>
    <div>
        <span>클럽을 개설하여 가까운 사람들과 함께하세요!</span>
    </div>
</article>

<?php $this->load->view('club/clubNav'); ?>

<article class="regist_wrap">
<?php echo form_open_multipart('club/regist/ok', array('id'=>'clubRegForm', 'name'=>'clubRegForm', 'onSubmit'=>'return formSubmit();')); ?>
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
                    <input type="text" name="title" title="클럽명" placeholder="사용하실 클럽명을 입력해주세요." required />
                </td>
            </tr>
            <tr class="addrTr">
                <th class="required">활동 지역</th>
                <td>
                    <p>
                        <span class="cOrg">*</span>
                        활동 지역은 최대 3개까지 선택 가능합니다.
                    </p>
                    <div class="addr">
                        <div class="sido">
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <th class="required">클럽소개(간단히)</th>
                <td>
                    <input type="text" name="description" title="짧은 클럽소개" placeholder="이곳에 간단히 클럽 소개를 적어주세요." required />
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <textarea name="content" placeholder="클럽 소개를 자세히 입력 해 주세요." title="상세 클럽소개" required></textarea>
                </td>
            </tr>
            <tr>
                <th class="required" required title="대표종목">대표종목</th>
                <td>
                    <select name="parts" title="클럽 대표종목">
                        <option>선택</option>
                    </select>
                </td>
            </tr>
            <tr>

            <th class = "required">클럽 공개 여부</th>
                <td>
                        <label for="public2"><input type="radio" name="public" value="2" id="public2" checked="checked">누구나 <span class="cGry">- 누구나 가입할 수 있습니다.</span> </label><br />
                        <label for="public1"><input type="radio" name="public" value="1" id="pubilc1">부분제한적 <span class="cGry">- 관리자의 승인을 통해서만 가입이 가능합니다.</span></label><br />
                        <label for="public0"> <input type="radio" name="public" value="0" id="public0">제한적 <span class="cGry">- 관리자의 초대에 의해서만 가입 가능합니다.</span></label>
                </td>
            </tr>
            <tr>
                <th>대표 이미지</th>
                <td>
                    <input type="file" name="profileImage">
                </td>
            </tr>
        </tbody>
    </table>

    <div class="buttonArea">
        <button type="button" class="txtBtn">취소</button>
        <button type="reset" class="resetBtn">다시입력</button>
        <button type="submit" class="txtBtn bgBlue">클럽 등록</button>
    </div>
</form>

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

var insertAreaTr = function(){
    if($("addrTr").find("i").length == 0 && $('tr.area').length == 0){
        $("tr.addrTr").after("<tr class='area'><th class='required'>대표지역</th><td class='areaTd'></td></tr>");
    }
}

var settingSigungu = function(data, idx){
    var parent = data[idx];
    var div = $("<div>").addClass("siGungu");
    $(".siGungu").remove();
    for(i=0; i<parent.data.length; i++){
        var addrName = "addr_"+idx+"_"+i;
        var lbl = $("<label>").attr("for", addrName);
        lbl.append($("<input type='checkbox' name='addrs' id='"+addrName+"' value='"+parent.data[i]+"'>").change(function(e){

            var pTag = $(".addr").siblings("p");

            if($(this).prop('checked') == true){
                var pullName =  parent.name+" "+$(this).val();
                //tr태그 삽입
                insertAreaTr();
                //지역의 갯수가 5개를 초과할경우
                if(pTag.find("i").length > 4){
                    alert("5개 지역까지만 선택 가능합니다.");
                    if($(this).is(":checked")) $(this).prop('checked', false);
                    return;
                }
                //input 태그 삽입
                $(".addr").prepend($("<input>").attr({name: 'addr[]', value: pullName, class : $(this).attr('id'), type : 'hidden'}));
                //i태그 삽입
                pTag.append("<i class='"+$(this).attr('id')+"'>"+pullName+"</i>");
                //radio버튼 생성
                tdTag = $(".areaTd");
                label = $("<label id='"+$(this).attr('id')+"_label' for='"+$(this).attr('id')+"_radio' style='margin-right:5px'>");
                label.html("<input type='radio' name='area' id='"+$(this).attr('id')+"_radio' value='"+pullName+"'>"+pullName);
                tdTag.append(label);

            }else{
                //대표지역 제거(i 갯수가 0개가 될 경우)
                if(pTag.find("i").length == 1) $("tr.area").remove();
                //input 제거
                $(".addr input."+$(this).attr('id')).remove();
                //pTag 내의 i태그 제거
                pTag.find("i."+$(this).attr('id')).remove();
                //td 내 radio버튼 제거
                $("label#"+$(this).attr('id')+"_label").remove();
            }
        }));
        lbl.append(parent.data[i]);
        if($(".addr").siblings("p").find("i."+addrName).length > 0) lbl.find("#"+addrName).prop('checked', true);
        div.append(lbl);
    }
    $(".sido").append(div);
}

var settingPart = function(){
    $.ajax({
        type : "POST",
        url : "/appData/selectResponse.php",
        data : {
            table : "parts",
            fields : ["partIdx", "name"],
            where : "purpose = 0 or purpose = 2",
            order : "order by partIdx asc"
        },
        success : function(data){
            var d = data.data.data;
            for(var i=0; i<d.length; i++){
                var option = $("<option></option>").val(d[i][0]).text(d[i][1]);
                $("select[name=parts]").append(option);
            }
        },
        error : function(e){
            console.log(e);
        }
    })
}


var formSubmit = function(){
console.log();
    if($("input[name=title]").val() == ""){
        alert("클럽명을 작성하지 않았습니다.");
        $("input[name=title]").focus();
        return false;
    }else if($("input[name='addr[]']").length == 0){
        alert("클럽 활동 지역을 적어도 한개는 선택해주세요.");
        $("a.sidoBtn").focus();
        return false;
    }else if($("input[name=description]").val() == ""){
        alert("짧은 클럽소개를 작성하지 않았습니다.");
        $("input[name=description").focus();
        return false;
    }else if($("select[name=parts]").val() == ""){
        alert("대표종목을 선택해주세요.");
        $("select[name=parts]").focus();
        return false;
    }else if($("input:radio[name='area']:checked").val() == undefined){
        alert("대표지역을 선택해주세요. \r\n만약 활동지역을 선택하지 않으셨다면, \n활동지역 선택 후 대표지역을 지정해주세요.");
        return false;
    }

    if(confirm('단 한개의 클럽만 관리자가 되실 수 있습니다.\r\n 클럽을 등록하시겠습니까?')){
        return true;
    }else{
        return false;
    }
}

/** 이벤트 셋팅 **/
var setEvent = function(){

    settingSido(Werun.util.getSidoArr());
   /* $.ajax({
        type : "POST",
        url : "/libraries/korea_administrative_district.json",
        async:false,
        success : function(data){
            settingSido(data.data);
        },
        error : function(e){
            console.log(e);
        }
    });*/

    $("#clubRegForm button[type=submit]").click(function(e){
        e.preventDefault();
        $("form#clubRegForm").trigger('submit');
    });


}
$(document).ready(function(){
    setEvent();
    settingPart();
});
</script>