<style>
.alert {
    padding: 8px 35px 8px 14px;
    margin-bottom: 20px;
    text-shadow: 0 1px 0 rgba(255,255,255,0.5);
    background-color: #fcf8e3;
    border: 1px solid #fbeed5;
    -webkit-border-radius: 4px;
    -moz-border-radius: 4px;
    border-radius: 4px;
}
</style>
<?php
 
function curl($url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5000);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('User-Agent: Mozilla/5.0 (iPhone; CPU iPhone OS 8_0 like Mac OS X) AppleWebKit/600.1.3 (KHTML, like Gecko) Version/8.0 Mobile/12A4345d Safari/600.1.4'));
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    @curl_setopt($ch, CURLOPT_REDIR_PROTOCOLS, -1);
    $contents = curl_exec($ch);
    curl_close($ch);
    return $contents;
}
 
function getBilibiliAVCover($avNum)
{
    $contents = curl('https://m.bilibili.com/video/' . $avNum . '.html');
    preg_match("~\"pic\":\"(.*?)\"~", $contents, $matches);
    if (count($matches) == 0) {
        echo '没有找到相应的图片，请换个 av 号试一下。';
        exit;
    }
	$img = $matches[1];
   // $img = file_get_contents($matches[1]);
   // file_put_contents('default.png', $img);
   curl($img);
   ?>
   <div class="alert" >
  <a href = "<?php echo $img ?>" rel='noreferrer' target='_blank' ><?php echo $img ?></a> <br/>
  <img src="<?php echo $img ?>">
    </div>
	<?php
	//echo "";
}
?>
<!DOCTYPE html>
<html lang="zh-CN">            
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title></title>
<meta name="description" content="">
<meta name="keywords" content="" />
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

</head>
<form action="#" method="post">
  <p>输入视频的AV号: <input type="text" name="AV" value = "<?php echo $av; ?>" placeholder="数字前面记得带上av" /></p>

  <input type="submit" name = "sub" value="Submit"  />
</form>

 <?php
     if (!$_POST['sub']) {
       exit ('');
    }
//print_r($_POST);
$av = $_POST['AV'];
getBilibiliAVCover("$av");
exit;
 ?>
