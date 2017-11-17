$myclub = null;

var myclubController = {
    clubIdx : null,
    clubList : null,
    memberIdx : 1,
    select : null,
    clubInfo : null,
    init : function(){
        $myclub = this;
        this.setClubList();
        this.setEventtoSelect();
        this.setPage();
    },
    getClubList : function(){
        $.ajax({
            type : "POST",
            url : "/appData/myclubResponse.php",
            data : {
                table : "club",
                type : "list",
                memberIdx : $myclub.memberIdx
            },
            async:false,
            success : function(data){
                $myclub.clubList = data.list;
            },
            error : function(e){
                console.log(e);
            }
        });
    },
    setClubList : function(){
        this.getClubList();
        this.select = $("[name=choiceClub]");
        for(i=0; i<this.clubList.length; i++){
            option = $("<option>").attr('value', this.clubList[i].clubIdx).text(this.clubList[i].title);
            if(this.clubIdx == this.clubList[i].clubIdx) option.prop('selected', true);
            this.select.append(option);
        }
    },
    setEventtoSelect : function(){
        this.select.change(function(){
            document.location.href='/club/myclub/notice/' + $(this).val();
        });
    },
    getPageInfo : function(){
        $.ajax({
            type : "POST",
            url : "/appData/myclubResponse.php",
            data : {
                table : "club",
                type : "view",
                clubIdx : $myclub.clubIdx,
                memberIdx : $myclub.memberIdx
            },
            async:false,
            success : function(data){
                $myclub.clubInfo = data.list;
            },
            error : function(e){
                console.log(e);
            }
        });
    },
    setPage : function(){
        this.getPageInfo();
        data = this.clubInfo[0];
        console.log(this.clubInfo);
        $("article.title h2").html(data.title);
        $("article.title div span").html(data.description);
    }
}

