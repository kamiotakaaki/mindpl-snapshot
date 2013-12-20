<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="shortcut icon" href="../img/favicon.ico">
<link rel="icon" href="../img/favicon.ico">
<title>Snapeee</title>
<!--
Snapeeeへようこそ！

ソースコードが気になったあなた。もしかしてエンジニアですか？
現在Snapeeeを開発しているマインドパレット（http://mindpl.co.jp/）
ではiOSエンジニア、Androidエンジニア、サーバーサイドエンジニア、デザイナーを募集しています！
（インターンシップも同時に募集中！）

僕達と一緒に世界に羽ばたくメガベンチャーをつくりましょう！

詳しくは
http://mindpl.co.jp/recruit/
を御覧ください。

または、TwitterID @stkn_bb までお気軽に声かけてください♪

これからもSnapeeeをよろしくお願いします！   
-->
<?php
// get URL
$url  = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
// echo $url."<br>";

// get lang_cd
$languages = explode(',', $_SERVER['HTTP_ACCEPT_LANGUAGE']);
$languages = array_reverse($languages);

$langcd = '';

foreach ($languages as $language) {
  if (preg_match('/^ja/i', $language)) {
    $langcd = 'ja';
  } else {
    $langcd = 'en';
  }
}

// echo $langcd."<br>";

// get snapseq
// $uri = $_SERVER['REQUEST_URI'];
// echo $uri."<br>";

// $snapseq = substr($uri, strrpos($uri, '?')+1);
// echo $biz_itemseq."<br>";

$snapseq = $_GET['id'];

$sUrl = "http://api.snape.ee/v2/snap/web/snapshot_snap/?snapseq=".$snapseq."&langcd=".$langcd."&jsoncallback=none";
// echo $sUrl."<br>";

$conn = curl_init();
curl_setopt($conn, CURLOPT_URL, $sUrl);
curl_setopt($conn, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($conn, CURLOPT_TIMEOUT, 10);
curl_setopt($conn, CURLOPT_HEADER, FALSE);
$json = curl_exec($conn);
curl_close($conn);

$err = false;
if ($json == false) {
    $err = true;
    // echo "ERROR";
}

// echo $json."<br>"."\n";

$jsonObject = json_decode($json);
// var_dump($jsonObject);
// echo "<br>";

// echo $jsonObject->invite_cd;
// echo $jsonObject->twitter_id;

?>

<!-- OGP -->
<meta property="og:title" content=<?php echo '"'.$jsonObject->title.'"'?> /> 
<meta property="og:type" content="article" /> 
<meta property="og:url" content=<?php echo '"'.$url.'"'?> /> 
<meta property="og:image" content=<?php echo '"'.$jsonObject->snap_url.'"'?> /> 
<meta property="og:site_name" content="Snapeee" />
<meta property="fb:admins" content="196541887054451" />

<!-- Twitter Cards -->
<meta name="twitter:card" content="photo">
<meta name="twitter:creator" content=<?php echo '"'.$jsonObject->twitter_id.'"'?>> 
<meta name="twitter:site" content="@Snapeee_com">

<meta name="twitter:app:name:iphone" content="Snapeee">
<meta name="twitter:app:name:ipad" content="Snapeee">
<meta name="twitter:app:name:googleplay" content="Snapeee">
<meta name="twitter:app:url:iphone" content="snapeeeapp-10://">
<meta name="twitter:app:url:ipad" content="snapeeeapp-10://">
<meta name="twitter:app:url:googleplay" content="snapeee://splash/">
<meta name="twitter:app:id:iphone" content="id434364551">
<meta name="twitter:app:id:ipad" content="id434364551">
<meta name="twitter:app:id:googleplay" content="jp.co.mindpl.Snapeee">



<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
<script type="text/javascript" src="/js/jquery_snapshot2.js"></script>
<script type="text/javascript">

//User agent CSS switch
if (navigator.userAgent.indexOf('iPhone') > 0 || navigator.userAgent.indexOf('Android') > 0) {
    document.write('<link rel="stylesheet" href="/css/snapshot_ba_sp.css" /><meta name="viewport" content="width=320, initial-scale=1" />');
    
    //hide browser header
    function doScroll() { if (window.pageYOffset === 0) { window.scrollTo(0,1); } } 
window.onload = function() { setTimeout(doScroll, 100); }  

<!--$(window).bind('resize load', function(){
    <!--$("html").css("zoom" , $(window).width()/320 );
<!--});-->

} else {
    document.write('<link rel="stylesheet" href="/css/snapshot_ba.css" />');
}

var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-19980549-2");
pageTracker._trackPageview();
} catch(err) {}

</script>
</head>

<body>

<div id="wrapper"><!-- wrapper start -->
<div id="header-wrapper">
<div id="header">
		<div id="headerLogo" width="100px">
			<a href="http://snape.ee/">
			<img src="http://snape.ee/img/common/img_logo.png" height="30px" class="pc">
			<img src="/img/logo_sp.png" class="sp" height="21px">
			</a>
		</div>
		<div id="headerSns" width="200px">
			<div class="pc">
				<ul class="snsList">
					<li class="ja"><a href="#" id="click_en">English</a></li>
					<li class="en"><a href="#" class="current" id="click_ja" >日本語</a></li>
				</ul>
			</div>
			<div class="sp">
				<div class="snsList">
					<a href="http://snape.ee/link/dl.html" target="_blank" ><img src="/img/bnr_downloadapp_en.png" height="30" class="en sp"/><img src="/img/bnr_downloadapp_ja.png" height="30" class="ja sp" /></a>
				</div>
			</div>	
		</div>
		<p style="clear:both;"></p>
	</div>
</div>
</div>
    <div id="content"><!-- content start -->
    
        <div id="leftcontent"><!-- left content start -->
        
        <img id="loading_img" class="loading"　/>
            <img id="photosp" class="sp" src=<?php
                if (empty($jsonObject->snap_url)) {
                    echo '"'.'http://snape.ee/img/snapshot/placeholder.png'.'"';
                } else {
                    echo '"'.$jsonObject->snap_url.'"';
                }
                ?>
             />
            <br class="clear" />
            <img id="user_icon" src=<?php
                if (empty($jsonObject->user_image_url)) {
                    echo "http://snape.ee/img/snapshot/img_noicon.png";
                } else {
                    echo $jsonObject->user_image_url;
                }
            ?>
            />
            <div class="username">
                <p id="user_name"><?php echo $jsonObject->user_nm;?></p>
            </div>
        
            <img id="photo" class="pc" src=<?php 
                if (empty($jsonObject->snap_url)) {
                    echo "http://snape.ee/img/snapshot/placeholder.png";
                } else {
                    echo '"'.$jsonObject->snap_url.'"';
                }
            ?> />
            
            <span id="productLink">
                <?php
                    if ($jsonObject->link_url != "") {
                        if ($langcd == "ja") {
                            if ($jsonObject->price == "") {
                                echo '<a class="productpage" href="'.$jsonObject->link_url.'" target="_blank">商品ページへ</a>';
                            } else {
                                echo '<a class="productpage" href="'.$jsonObject->link_url.'" target="_blank">公式サイトへ</a>';
                            }
                        } else {
                            echo '<a class="productpage" href="'.$jsonObject->link_url.'" target="_blank">Site</a>';
                        }
                    }
                ?>
            </span>
            
            <span id="productname">
                <?php
                    if ($jsonObject->item_nm != "") {
                        echo '<p class="productname">'.$jsonObject->item_nm.'</p>';
                    }

                ?>
            </span>

            <span id="price">
                <?php 
                    if ($jsonObject->price != "") {
                        echo '<p class="price">'.$jsonObject->price.'</p>';
                    }
                ?>
            </span>
            
            <p id="phototitle"><?php echo $jsonObject->title;?></p> 
            
            <?php
                if (count($jsonObject->business_categories) > 0) {
                    echo '<div class="category">';
                    echo '<ul id="category">';
                    foreach ($jsonObject->business_categories as $biz_category) {
                            echo "<li>".$biz_category->item_group_nm."</li>";
                    }
                    echo "</ul></div>";
                }
            ?>
            
            <div id="reaction"><span id="kawaii"><?php echo $jsonObject->pushed_cnt;?></span> <span id="comment"><?php echo $jsonObject->commented_cnt;?></span></div>
            
            <div id="sns">
                <div class="fb-like" data-send="false" data-layout="button_count" data-width="200" data-show-faces="false"></div>

                <a href="https://twitter.com/share" class="twitter-share-button" 
                data-url=<?php echo '"'.$url.'"'; ?> 
                data-text=
                <?php 
                        if (empty($jsonObject->twitter_id)) {
                            echo '"RT "';
                        } else {
                            echo '"RT @'.$jsonObject->twitter_id.'"';
                        }
                ?>
                data-hashtags="Snapeee">Tweet</a>
                <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
                
                <br />
                <div class="pc">
                <div id="fb-root"></div>
                <script>$(document).ready(function(d, s, id) {
                  var js, fjs = d.getElementsByTagName(s)[0];
                  if (d.getElementById(id)) return;
                  js = d.createElement(s); js.id = id;
                  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
                  fjs.parentNode.insertBefore(js, fjs);
                }(document, 'script', 'facebook-jssdk'));</script>
                
                <script type="text/javascript">
                    $("#fb-root").after('<fb:comments id="fb_comment" href="'+location.href+'" data-num-posts="2" data-width="600" ></fb:comments>');
                </script>
                </div>
                
                <br class="clear" />
            </div>
            
        </div><!-- left content end -->
        
        <div id="rightcontent"><!-- right content start -->
        <img src="http://snape.ee/img/snapshot/img_aboutsnapeee.png" class="pc ja" />
        <img src="/img//img_aboutsnapeee_sp.png" class="sp ja" width="100%" />
        <img src="http://snape.ee/img/snapshot/img_aboutsnapeee_en.png" class="pc en" />
        <img src="/img/img_aboutsnapeee_en_sp.png" class="sp en" width="100%" />

<a href="https://itunes.apple.com/jp/app/snapeee/id434364551?mt=8" class="ios ja" target="_blank"><p>iPhoneでかわいい写真を作ろう!<br />
<img src="http://snape.ee/img/snapshot/img_appstore.png" /></p></a><p></p>
<a href="https://play.google.com/store/apps/details?id=jp.co.mindpl.Snapeee&hl=ja" class="android ja" target="_blank"><p>Androidでかわいい写真を作ろう!<br />
<img src="http://snape.ee/img/snapshot/img_googleplay.png" /></p></a>

<a href="https://itunes.apple.com/en/app/snapeee/id434364551?mt=8" class="ios en" target="_blank"><p>Make kawaii photo on iPhone!<br />
<img src="http://snape.ee/img/snapshot/img_appstore.png" /></p></a><p></p>
<a href="https://play.google.com/store/apps/details?id=jp.co.mindpl.Snapeee&hl=en" class="android en" target="_blank"><p>Make Kawaii photo on Android!<br />
<img src="http://snape.ee/img/snapshot/img_googleplay.png" /></p></a>

<p class="aulink ja">Android au版のダウンロードは<a href="http://pass.auone.jp/app/detail?app_id=5254400000001&sitemove=cloud" target="_blank">コチラ>></a></p>
<p class="aulink en">Download on T-store <a href="http://www.tstore.co.kr/userpoc/game/viewProduct.omp?insProdId=0000279143" target="_blank">here>></a></p>

        </div><!-- right content end -->
    
    
    </div><!-- content end -->
<br class="clear" />

<div id="footertop"></div>
<footer id="footer"><!-- Footer start -->

<p class="ja"><a href="/">Snapeeeについて</a> | <a href="/terms_of_use/ja/index.html">利用規約</a></p>
<p class="en"><a href="/">About Snapeee</a> | <a href="/terms_of_use/index.html">Terms of Use</a></p>
<div class="lang sp"><p><a href="#" id="spchange_ja" >日本語</a> / <a href="#" id="spchange_en" >English</a></p></div>
<p class="copyright ja">Copyright © 2011, 2013 <a href="http://www.mindpl.co.jp" target="_blank">MindPalette</a> All Rights Reserved</p>
<p class="copyright en">Copyright © 2011, 2013 <a href="http://www.mindpl.com" target="_blank">MindPalette</a> All Rights Reserved</p>
</footer><!-- footer end -->

</div><!-- wrapper end -->

<script>
function load()
{
!function(d,s,id){
    var js,fjs=d.getElementsByTagName(s)[0];
    if(!d.getElementById(id)){
        js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);
        }
    }(document,"script","twitter-wjs");
}
</script>


</body>
</html>
