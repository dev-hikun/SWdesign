<!DOCTYPE HTML>
<html>
<head>
    <meta charset="UTF-8">
    <title>
        <?php
        echo "We run";
        if($page_title != ""):
		?>
				<?= " - ".$page_title; ?>
        <?php endif; ?>
    </title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	
    <link href="/libraries/css/reset.css" rel="stylesheet" type="text/css">
    <link href="/libraries/css/layout.css" rel="stylesheet" type="text/css">
    <link href="/libraries/css/common.css" rel="stylesheet" type="text/css">
    <link href="/libraries/extern/jQuery/jquery-ui.css" rel="stylesheet" type="text/css">
    <?php echo $css_link; ?>
    <script type="text/javascript" src="/libraries/extern/jQuery/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="/libraries/extern/jQuery/jquery-ui.min.js"></script>

    <script type="text/javascript" src="/libraries/js/common.js"></script>
</head>
<body>
    <div class="wrap">
        <header>
            <div class="globalArea">
            <?php
                if(!isset($_SESSION['logged_in'])):
            ?>
                <nav class="global">
                        <a href="/member/login" class="login">로그인</a>
                        <a href="/member/join" class="join">회원가입</a>
                        <a href="#" class="findInfo">정보찾기</a>
                </nav>
            <?php
                else:
            ?>
                <nav class="global">
                        <a href="#" class="none" style="cursor:default"><?= $_SESSION['name']."(".$_SESSION['nickName'].")님 환영합니다." ?></a>
                        <a href="/member/login/bye" class="login">로그아웃</a>
                        <a href="#" class="findInfo">내정보</a>
                </nav>
            <?php endif; ?>
            </div>
            <h1 class="logo">
                <a href='/'><img src="/libraries/images/common/c_logo_big.jpg" alt="We run" /></a>
            </h1>
            <nav class="gnb">
                <div class="gnbArea">
                    <ul>
                        <li class="competition"><a href="#">대회 정보</a></li>
                        <li class="club"><a href="#">클럽</a></li>
                        <li class="rank"><a href="#">랭킹</a></li>
                        <li class="info"><a href="#">사이트 소개</a></li>
                    </ul>
                </div>
            </nav>
        </header>
        <section>