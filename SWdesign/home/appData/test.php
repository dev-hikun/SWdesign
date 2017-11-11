<?php
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <script type="text/javascript" src="/libraries/extern/jQuery/jquery-3.2.1.min.js"></script>
    </head>
    <body>
        <script type="text/javascript">
            $.ajax({
                type : "POST",
                url : "/appData/insertResponse.php",
                data : {
                    table : "member",
                    fields : ["email", "passwd", "name", "nickName", "birth", "addr1"],
                    values : ["test@test.codm4", "password('test')", "한글왜깨져~", "test111", "1980-01-01", "경기도 성남시 수정구 제일로 216번길 7(태평동)"]
                },
                async:false,
                success(data){
                    console.log(data);
                },
                error(e){
                    console.log(e);
                }
            });

            $.ajax({
                type : "POST",
                url : "/appData/selectResponse.php",
                data : {
                    table : "member",
                    fields : ["*"],
                    where : "memberIdx = 1",
                    order : "order by memberIdx asc"
                },
                async:false,
                success(data){
                    console.log(data);
                },
                error(e){
                    console.log(e);
                }
            })
        </script>

    </body>
</html>