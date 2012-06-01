<?php
//include("dbconnect.php");
require_once('includes/DbConnector.php');

$connector = new DbConnector();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="tim ma so karaoke, ma so bai hat karaoke, arirang 44, danh sach bai hat arirang 44, arirang list song vol 44, bboy_nonoyes" />
	<meta name="description" content="Tra cứu thông tin Karaoke Arirang Vol 1-44" />
	<title>Tra cứu thông tin bài hát Karaoke Arirang Vol 1-44 </title>
	<link type="text/css" rel="stylesheet" media="all" href="css/style.css" />

<!-- / Begin Google Analytics Codes --> 
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-27886197-1']);
  _gaq.push(['_setDomainName', '.nhuy.info']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

</head>
<body>
	<div id="wrapper">
		<div id="header">
			<a href="/"><img src="images/logo.jpg" alt="logo"/></a>
		</div><!-- /#header -->

		<div id="content">
			<div id="fastLink">
				<a href="/">Danh sách</a>
				<a href="?textStart=A">A</a>
				<a href="?textStart=B">B</a>
				<a href="?textStart=C">C</a>
				<a href="?textStart=D">D</a>
				<a href="?textStart=E">E</a>
				<a href="?textStart=G">G</a>
				<a href="?textStart=H">H</a>
				<a href="?textStart=I">I</a>
				<a href="?textStart=K">K</a>
				<a href="?textStart=L">L</a>
				<a href="?textStart=M">M</a>
				<a href="?textStart=N">N</a>
				<a href="?textStart=O">O</a>
				<a href="?textStart=P">P</a>
				<a href="?textStart=Q">Q</a>
				<a href="?textStart=R">R</a>
				<a href="?textStart=S">S</a>
				<a href="?textStart=T">T</a>
				<a href="?textStart=U">U</a>
				<a href="?textStart=V">V</a>
				<a href="?textStart=X">X</a>
				<a href="?textStart=Y">Y</a>				
			</div><!-- /#fastLink -->
			
			<div id="searchForm">
				<form action="" method="get">
				<input name="search" type="text" value="Nhập thông tin bạn cần tìm..." onfocus="this.value=''" id="textSong" />
				<input type="image" src="images/search.png" id="submit" name="" value="TÏm"/>
				</form>
			</div><!-- /#searchForm --> 	

		
<div id="listSong">
<?php
//include("dbconnect.php");
function utf8_to_ascii($str) {
	$chars = array(
		'a'	=>	array('A','?','?','?','?','?','?','?','?','?','?','?','?','?','?','?','?','?','?','?','?','·','‡','?','„','?','‚','?','¡','¿','?','√','?','¬','?'),
		'e' =>	array('E','?','?','?','?','?','?','?','?','?','?','È','Ë','?','?','?','Í','…','»','?','?','?',' '),
		'i'	=>	array('I','Ì','i?','?','?','?','Õ','Ã','?','?','?'),
		'o'	=>	array('O','?','?','?','?','?','?','?','?','‘','?','?','?','?','?','?','?','?','?','?','?','Û','Ú','?','ı','?','Ù','?','”','“','?','’','?','‘','?'),
		'u'	=>	array('U','?','?','?','?','?','?','?','?','?','?','˙','˘','?','?','?','?','⁄','Ÿ','?','?','?','?'),
		'y'	=>	array('Y','˝','?','?','?','?','›','?','?','?','?'),
		'd'	=>	array('D','?','?'),
		' '	=>	array(','),
	);
	foreach ($chars as $key => $arr) 
		foreach ($arr as $val)
			$str = str_replace($val,$key,$str);
	return $str;
}
$st = 0;
$p = 1;
if (isset($_GET['p']) && $_GET['p'] != "") {$st = $_GET['p'] * 10 - 10; $p =$_GET['p'];}; 
$where = "";
$pttk = "";
if (isset($_GET['search']) && $_GET['search'] != ""){
$search = strtolower(utf8_to_ascii($_GET['search']));
$where = "WHERE ascii LIKE '%$search%'";
$pttk = "search=".$search."&";
}
if (isset($_GET['textStart']) && $_GET['textStart'] != ""){
$textStart = strtolower(utf8_to_ascii($_GET['textStart']));
$where = "WHERE ascii LIKE '$textStart%'";
$pttk = "textStart=".$textStart."&";
}

//$total =  mysql_fetch_array($mysql = mysql_query("SELECT COUNT(*) as total FROM data $where"));
//$tong = $total['total'];

$total = $connector->fetchArray($connector->query("SELECT COUNT(*) as total FROM kara $where"));
$tong = $total['total'];


$checkquery ="SELECT * FROM kara $where LIMIT $st,10";

//$checkresults = mysql_query($checkquery,$con);

$checkresults = $connector->query($checkquery);

//while($row = mysql_fetch_array($checkresults))
while($row = $connector->fetchArray($checkresults))
{
echo '<div class="song"><p class="songID">'.$row['code'].'</p>';
echo '<p class="songName">'.$row['name'].'</p>';
echo '<p class="SongLyric">'.$row['more'].'</p>';
echo '<p class="author">'.$row['author'].'</p></div>';
}
?>
</div>

<div id="paginator">
<p>
<?php if($p > 1)
{?>
<a title="Tr??c" href="index.php?<?php echo$pttk."p=".($p-1);?>"><img class="arrow" src="images/leftArrow.png" alt="Tr??c"/></a>
<?php
}
?>
<?php echo $p." / ".ceil($tong/10);?>&nbsp;
<?php if($p < ceil($tong/10))
{?>
<a title="Sau" href="index.php?<?php echo$pttk."p=".($p+1);?>"><img class="arrow" src="images/rightArrow.png" alt="Sau"/></a></p>
<?php
}
?>
</div> 

						<!-- /#listSong -->
						
									</div> <!-- /#content -->
		
		<div id="footer">
			Arirang Karaoke Vol 44 List Song Updated<br/>
			Copyright © 2012<br/>
			All right reserved!
        </div> <!-- /#footer -->
		
	</div> <!-- /#wrapper -->
</body>
</html>

<script type="text/javascript">

//Change width of elements

var wrapper = document.getElementById('wrapper');
if (screen.width > 600) {
	wrapper.style.width = "400px";
}

</script>
