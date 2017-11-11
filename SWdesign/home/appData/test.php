<?php
?>

<html>
    <head>
        <script type="text/javascript" src="/libraries/extern/jQuery/jquery-3.2.1.min.js"></script>
    </head>
    <body>
        <script type="text/javascript">
            $.ajax({
                type : "POST",
                url : "/appData/insertResponse.php",
                data : {
                    table : "member",
                    fields : ["email", "passwd", "name", "nickName", "birth"],
                    values : ["test@test.aa.aa", "password('test')", "테스트1", "test111", "1980-01-01"]
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