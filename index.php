<?php
session_start();

//ログインチェック
//してなかったらログインフォームへ
if(empty($_SESSION["user"])){
	header("Location:login_form.php");
	exit;
}

//席の更新
if(isset($_GET["use"])){
	$name = $_GET["use"];

	$pdo = new PDO("sqlite:kobalab.sqlite");
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

	//選択した席の情報をとってくる
	$st = $pdo->query("select * from use where name = '$name';");
	$data = $st -> fetchAll();
	foreach($data as $use){
		$flag = $use["flag"];
	}

	//ログインしたユーザーのidをとってくる
	$id = $_SESSION["id"];
	$st2 = $pdo->query("select * from user where id= '$id';");
	$data2 = $st2 -> fetchAll();
	foreach($data2 as $user){
		$id = $user["id"];
	}

	//空席ならば
	if($flag == 0){
		if($id==$_SESSION["id"]){
			$flag=$_SESSION["id"]-2;
		}
	}else{
		$flag = 0;
	}

	//席情報を更新
	$stmt = $pdo -> prepare("UPDATE use SET flag = '$flag' where name = '$name';");
	$stmt->execute();
}


$pdo = new PDO("sqlite:kobalab.sqlite");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

$flag = array();
$imgs = array();

//席情報をとってくる
$st_f = $pdo->query("select * from use;");
$data_f = $st_f->fetchAll();
foreach($data_f as $use) {
	$flag[] = $use["flag"];
}

//ユーザーの画像をとってくる
$st_img = $pdo->query("select * from user;");
$data_img = $st_img->fetchAll();
foreach($data_img as $user) {
	$imgs[] = $user["img_url"];
}

//js用に変形
$flag = implode(',', $flag);
$imgs = implode(',', $imgs);

?>
<html>
<head>
	<meta charset="utf-8">
	<title>小林研究室</title>
	<link rel="stylesheet" href="style.css">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.min.js"></script>
	<script type="text/javascript" src="jquery.balloon.min.js"></script>
	<script type="text/javascript" src="particles.min.js"></script>
	

</head>
<body>

	<!-- パーティクルを描く -->
	<div id="particles-js"></div>

	<!-- お土産棚、本棚、壁、テーブル、ドア、冷蔵庫、プリンタ、小林先生 -->
	<div id ="cupboard" style="position: absolute; top: 650px; left:350px";><a href="fridge.php" class="balloon2" title="お土産はこっち！">お土産棚</a></div>
	<div id ="book" style="position: absolute; top: 650px; left:800px";><a href="book.php" class="balloon2" title="本を借りたいならここ！">本棚</a></div>


	<div id="wall_hol"  style="position: absolute; top: 702px; left:20px";></div>
	<div id="wall_hol"  style="position: absolute; top: 20px; left:20px";></div>
	<div id="wall_ver"  style="position: absolute; top: 20px; left:20px";></div>
	<div id="wall_ver"  style="position: absolute; top: 20px; left:1270px";></div>

	<div id="door" style="position: absolute; top: 700px; left:180px";>
		<?php
		if(isset($_SESSION["user"])){
			echo "["."<a href=logout.php>ログアウト"."</a>]";
		}else{
			echo "["."<a href=login_form.php>ログイン"."</a>]";
		}
		?>
	</div>
	<div id="door" style="position: absolute; top: 700px; left:1100px;">ろぐいん</a></div>


	<div id="table" style="position: absolute; top: 225px; left:325px";></div>
	<div id="table" style="position: absolute; top: 225px; left:825px";></div>


	<div id ="fridge" style="position: absolute; top: 40px; left:50px;"><a href="fridge.php" class="balloon" title="冷蔵庫の中身をチェック！"><img src="fridge.gif"></a></div>


	<div id ="print2x" style="position: absolute; top: 350px; left:50px;"><a href="index.php" class="balloon3" title="3Dプリンタの使用状況は？">aaa</a></div>
	<div id ="printz18" style="position: absolute; top: 500px; left:50px;"><a href="index.php" class="balloon3" title="3Dプリンタの使用状況は？">aaa</a></div>



	<div id = "kob" style="position: absolute; top: 550px; left:1100px;"><a href="index.php" class="balloon" title="小林先生の予定は？" ><img  src="kob.jpg"></a></div>

	<!-- 座席 -->
	<div id="a-1" style="position: absolute; top: 70px; left:300px"><a href="index.php?use=a-1" class="balloon" title="この席に座ったらクリック！"><img id="img-1" src=""></a></div>
	<div id="a-2" style="position: absolute; top: 70px; left:450px"><a href="index.php?use=a-2" class="balloon" title="この席に座ったらクリック！"><img id="img-2" src=""></div>
	<div id="a-3" style="position: absolute; top: 200px; left:550px"><a href="index.php?use=a-3" class="balloon" title="この席に座ったらクリック！"><img id="img-3" src=""></div>
	<div id="a-4" style="position: absolute; top: 330px; left:550px"><a href="index.php?use=a-4" class="balloon" title="この席に座ったらクリック！"><img id="img-4" src=""></div>
	<div id="a-5" style="position: absolute; top: 460px; left:450px"><a href="index.php?use=a-5" class="balloon" title="この席に座ったらクリック！"><img id="img-5" src=""></div>
	<div id="a-6" style="position: absolute; top: 460px; left:300px"><a href="index.php?use=a-6" class="balloon" title="この席に座ったらクリック！"><img id="img-6" src=""></div>
	<div id="a-7" style="position: absolute; top: 330px; left:200px"><a href="index.php?use=a-7" class="balloon" title="この席に座ったらクリック！"><img id="img-7" src=""></div>
	<div id="a-8" style="position: absolute; top: 200px; left:200px"><a href="index.php?use=a-8" class="balloon" title="この席に座ったらクリック！"><img id="img-8" src=""></div>

	<div id="b-1" style="position: absolute; top: 70px; left:800px"><a href="index.php?use=b-1" class="balloon" title="この席に座ったらクリック！"><img id="img-9" src=""></div>
	<div id="b-2" style="position: absolute; top: 70px; left:950px"><a href="index.php?use=b-2" class="balloon" title="この席に座ったらクリック！"><img id="img-10" src=""></div>
	<div id="b-3" style="position: absolute; top: 200px; left:1050px"><a href="index.php?use=b-3" class="balloon" title="この席に座ったらクリック！"><img id="img-11" src=""></div>
	<div id="b-4" style="position: absolute; top: 330px; left:1050px"><a href="index.php?use=b-4" class="balloon" title="この席に座ったらクリック！"><img id="img-12" src=""></div>
	<div id="b-5" style="position: absolute; top: 460px; left:950px"><a href="index.php?use=b-5" class="balloon" title="この席に座ったらクリック！"><img id="img-13" src=""></div>
	<div id="b-6" style="position: absolute; top: 460px; left:800px"><a href="index.php?use=b-6" class="balloon" title="この席に座ったらクリック！"><img id="img-14" src=""></div>
	<div id="b-7" style="position: absolute; top: 330px; left:700px"><a href="index.php?use=b-7" class="balloon" title="この席に座ったらクリック！"><img id="img-15" src=""></div>
	<div id="b-8" style="position: absolute; top: 200px; left:700px"><a href="index.php?use=b-8" class="balloon" title="この席に座ったらクリック！"><img id="img-16" src=""></div>



	<script type="text/javascript">
	//クリックで画像のオンオフする関数
	//phpの配列をjsに渡してる
	var Flag = '<?php echo  $flag; ?>';
	var Img = '<?php echo  $imgs; ?>';
	var flag = Flag.split(',');
	var imgs = Img.split(',');

	console.log(flag);
	console.log(imgs);

	for(var num=1; num<17; num++){
		if(flag[num-1] == 0){
			document.getElementById("img-"+num).src = "";
		}else if(flag[num-1] == 1){
			document.getElementById("img-"+num).src = imgs[0];
		}else if(flag[num-1] == 2){
			document.getElementById("img-"+num).src = imgs[1];
		}
	}


//吹き出しの表示位置
$(function() {
	$('.balloon').balloon({position: "bottom", minLifetime: 0 });
	$('.balloon2').balloon({ minLifetime: 0 });
	$('.balloon3').balloon({ position: "right", minLifetime: 0 });
});


//後ろのパーティクル 
particlesJS('particles-js',
{
	"particles": {
		"number": {
			"value": 80,
			"density": {
				"enable": true,
				"value_area": 800
			}
		},
		"color": {
			"value": "#ffffff"
		},
		"shape": {
			"type": "circle",
			"stroke": {
				"width": 0,
				"color": "#000000"
			},
			"polygon": {
				"nb_sides": 5
			},
			"image": {
				"src": "img/github.svg",
				"width": 100,
				"height": 100
			}
		},
		"opacity": {
			"value": 1,
			"random": false,
			"anim": {
				"enable": false,
				"speed": 1,
				"opacity_min": 0.1,
				"sync": false
			}
		},
		"size": {
			"value": 30,
			"random": true,
			"anim": {
				"enable": false,
				"speed": 40,
				"size_min": 0.1,
				"sync": false
			}
		},
		"line_linked": {
			"enable": true,
			"distance": 150,
			"color": "#ccffff",
			"opacity": 0.4,
			"width": 1
		},
		"move": {
			"enable": true,
			"speed": 6,
			"direction": "none",
			"random": false,
			"straight": false,
			"out_mode": "out",
			"attract": {
				"enable": false,
				"rotateX": 600,
				"rotateY": 1200
			}
		}
	},
	"interactivity": {
		"detect_on": "canvas",
		"events": {
			"onhover": {
				"enable": true,
				"mode": "repulse"
			},
			"onclick": {
				"enable": true,
				"mode": "push"
			},
			"resize": true
		},
		"modes": {
			"grab": {
				"distance": 400,
				"line_linked": {
					"opacity": 1
				}
			},
			"bubble": {
				"distance": 400,
				"size": 40,
				"duration": 2,
				"opacity": 8,
				"speed": 3
			},
			"repulse": {
				"distance": 200
			},
			"push": {
				"particles_nb": 4
			},
			"remove": {
				"particles_nb": 2
			}
		}
	},
	"retina_detect": true,
	"config_demo": {
		"hide_card": false,
		"background_color": "#b61924",
		"background_image": "",
		"background_position": "50% 50%",
		"background_repeat": "no-repeat",
		"background_size": "cover"
	}
}
);


</script>
</body>
</html>