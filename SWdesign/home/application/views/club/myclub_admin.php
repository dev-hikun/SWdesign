<div class="myclubBanner"></div>

<div class="selectArea">
    <span class="left">
        <span>가입된 다른 클럽 선택 : </span>
        <select name='choiceClub'>
        <?php
            foreach($admin['list'] as $key=>$val):
                echo "<option value='{$val['clubIdx']}'>{$val['title']}</option>";
            endforeach;
        ?>
        </select>
    </span>
    <span class="right">
        <button type="button" class="txtBtn bgBlue" onclick="document.location.href='/club/lists'">전체 클럽 리스트</button>
    </span>
</div>

<article class="title club">
    <h2><?= $admin['title'] ?></h2>
    <div>
        <span><?= $admin['description'] ?></span>
    </div>
</article>

<?php $this->load->view('club/clubNav'); ?>


<article class="myclubContentWrap">
    <?php if($admin['public'] == 1): ?>
    <div class="boardWrap">
        <h2>가입신청 리스트</h2>
        <table class="board mt10">
            <thead>
                <tr>
                    <th>No</th>
                    <th>아이디</th>
                    <th>이름 or 닉네임</th>
                    <th>전화번호</th>
                    <th>주소</th>
                    <th>승인</th>
                    <th>반려</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                $requestArr = $this->myclubs->getRequestArr($clubIdx);
            if($requestArr):
                foreach($requestArr as $key=>$val):
                ?>
                <tr>
                    <td><?= $i ?></td>
                    <td><?= $val['email'] ?></td>
                    <td><?= $val['name'] ?></td>
                    <td><?= $val['phone'] ?></td>
                    <td class="tLeft"><?= $val['addr1']." ".$val['addr2'] ?></td>
                    <td><button type="button" class="bgBlue" onClick="if(confirm('해당 회원의 가입을 승인하시겠습니까?')){ request(<?= $val['memberIdx'] ?>, 2); }">승인</button></td>
                    <td><button type="button" class="bgOrg cWhite" onClick="if(confirm('해당 회원의 가입을 반려하시겠습니까?')){ request(<?= $val['memberIdx'] ?>, 999); }">반려</button></td>
                </tr>
                <?php
                $i++;
                endforeach;
            else:
                ?>
                <tr>
                    <td colspan="7" class='height80'>가입신청 목록이 없습니다.</td>
                </tr>
                <?php
            endif;
            ?>
            </tbody>
        </table>
    </div>
    <?php endif; ?>
    <div class="boardWrap">
        <h2>회원 목록</h2>
        <table class="board mt10">
            <thead>
                <tr>
                    <th>No</th>
                    <th>등급</th>
                    <th>아이디</th>
                    <th>이름 or 닉네임</th>
                    <th>전화번호</th>
                    <th>주소</th>
                    <th>제명</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;

            $clubMember = $this->myclubs->getClubMember($clubIdx);
            if($clubMember):
                foreach($clubMember as $key=>$val):
                    if(!is_array($val)): continue; endif;
                ?>
                <tr>
                    <td><?= $i ?></td>
                    <td>
                        <select name='level' data-idx='<?= $val['memberIdx'] ?>'>
                            <?php if($val['permit'] == '0'): ?>
                            <option value='0' <?php if($val['permit'] == '0'): echo "selected"; endif; ?>>운영자</option>
                            <?php endif; ?>
                            <option value='1' <?php if($val['permit'] == '1'): echo "selected"; endif; ?>>부운영자</option>
                            <option value='2' <?php if($val['permit'] == '2'): echo "selected"; endif; ?>>회원</option>
                        </select>
                    </td>
                    <td><?= $val['email'] ?></td>
                    <td><?= $val['name'] ?></td>
                    <td><?= $val['phone'] ?></td>
                    <td class="tLeft"><?= $val['addr1']." ".$val['addr2'] ?></td>
                    <td>
                        <?php if($val['permit'] != 0): ?>
                        <button type="button" class="bgOrg cWhite" onClick="if(confirm('해당 회원을 제명하시겠습니까?')){ request(<?= $val['memberIdx'] ?>, 999); }">제명</button>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php
                $i++;
                endforeach;
            endif;
                ?>
            </tbody>
        </table>
    </div>
</article>

<script type="text/javascript">
$(document).ready(function(){
    $defaultPermit = 2;

    $("[name=choiceClub]").val($_GET['clubIdx']);
    $("[name=choiceClub]").change(function(){
        document.location.href='/club/myclub?clubIdx='+$(this).val();
    });
    $("select[name=level]").click(function(){
        $defaultPermit = $(this).val();
    })

    $("select[name=level]").change(function(){
        var base = $defaultPermit;
        if(base == 0){
            alert("운영자의 등급은 변경하실 수 없습니다.");
            $(this).val(0);
            return;
        }

        if(<?= $this->myclubs->getPermit($_SESSION['idx'], $clubIdx) ?> == 1 && $(this).val() == 0){
            alert("부운영자는 운영자의 권한을 줄 수 없습니다.");
            $(this).val(base);
            return;
        }

        if(base == 1 && $(this).val() == 0){
            if(confirm('부운영자의 등급을 운영자로 변경 할 경우,\r운영자의 등급은 부운영자가 됩니다.\r\n계속하시겠습니까?')){
                request(<?= $_SESSION['idx'] ?>, 1);
            }else{
                $(this).val(0);
                return;
            }
        }

        if(base == 2 && $(this).val() == 0){
            alert("회원은 바로 운영자로 등급변경 할 수 없습니다.");
            $(this).val(2);
            return;
        }


        request($(this).data('idx'), $(this).val());
        alert('등급이 변경되었습니다.');
        document.location.href='location.href';
        return;

    });
});

var request = function(idx, permit){
    var type = (permit == 999)?  'expulsion' : 'changePermit';
    var perm = (permit == 999)?  '' : permit;
    var clubIdx = $_GET['clubIdx'];
    var memberIdx = idx;
    $.ajax({
        type : 'POST',
        url : '/appData/myclubResponse.php',
        data : {
            type : type,
            clubIdx : clubIdx,
            permit : perm,
            memberIdx : idx
        },
        success : function(data){
            document.location.href=location.href;
        },
        error :function(e){
            console.log(e);
        }
    });
}

</script>