<!DOCTYPE html>
<html lang="ja">
<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# article: http://ogp.me/ns/article#">
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>TehuTehu連鎖 - Tehu君の名言をマルコフ連鎖で自動生成</title>
<meta name="description" content="Tehu君の名言をマルコフ連鎖で自動生成">
<meta property="fb:app_id" content="283781975031992" />
<meta property="og:title" content="TehuTehu連鎖" />
<meta property="og:type" content="website" />
<meta property="og:url" content="http://vps1.liverty.biz/hbkr/tefu/" />
<meta property="og:image" content="http://vps1.liverty.biz/hbkr/tefu/tefuogp.png" />
<meta property="og:site_name" content="TehuTehu連鎖" />
<meta property="og:locale" content="ja_JP" />
<meta property="og:description" content="Tehu君の名言をマルコフ連鎖で自動生成" />
<meta name="twitter:card" content="summary" />
<meta name="twitter:description" content="Tehu君の名言をマルコフ連鎖で自動生成" />
<meta name="twitter:site" content="@hbkr" />
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/normalize/3.0.2/normalize.min.css" />
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/skeleton/2.0.4/skeleton.min.css">
<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Open+Sans:400,400italic,600,600italic,700,700italic">
<link rel="stylesheet" href="custom.css">
</head>

<body>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/ja_JP/sdk.js#xfbml=1&version=v2.5&appId=283781975031992";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div class="container">

<header>
<h1>TehuTehu連鎖</h1>
<p class="desc">Tehu君の名言をマルコフ連鎖で自動生成します</p>
</header>

<main>
<?php
require_once('markov.php');
require('mecabp.php');
require('data.php');

$summarizer = new Markov;
$words = array();

$stary = explode("\n", $string);
$stary = array_map('trim', $stary);
$stary = array_filter($stary, 'strlen');
shuffle($stary);
$string = implode("", $stary);

$mecab = new Mecabp;

$ary = $mecab->parse($string);

for ($i = 0; $i < count($ary); $i++) {
    $str = $ary[$i]["word"];
    array_push($words, $str);
}
array_push($words, "EOS");
?>

<div id="chat-frame">
<p class="chat-talk">
    <span class="talk-icon">
        <img src="tefuimg.jpg" alt="tartgeticon" width="50" height="50"/>
    </span>
    <span class="talk-content">

<?php
$summary = $summarizer->summarize($words, 3);
echo $summary;
?>

    <br />
    <a href="https://twitter.com/share" class="twitter-share-button"{count} data-text="<?php echo mb_strimwidth($summary, 0, 200, '…', 'UTF-8') ?>">Tweet</a>
    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
    </span></div>

<div style="margin-top:20px">※ <a href=".">リロード</a>する度に名言は変わります</div>
<hr>
</main>


<footer>
  <div class="fb-like u-pull-left" style="line-height:1" data-href="http://vps1.liverty.biz/hbkr/tefu" data-layout="button" data-action="like" data-show-faces="true" data-share="true"></div>
  <div class="u-pull-left" style="margin-left:5px;">
    <a href="https://twitter.com/share" class="twitter-share-button"{count} data-via="hbkr">Tweet</a>
    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
  </div>
  <div class="u-pull-left" style="margin-left:5px;">
    <a href="http://b.hatena.ne.jp/entry/http://vps1.liverty.biz/hbkr/tefu" class="hatena-bookmark-button" data-hatena-bookmark-title="TehuTehu連鎖" data-hatena-bookmark-layout="simple" title="このエントリーをはてなブックマークに追加"><img src="https://b.st-hatena.com/images/entry-button/button-only@2x.png" alt="このエントリーをはてなブックマークに追加" width="20" height="20" style="border: none;" /></a><script type="text/javascript" src="https://b.st-hatena.com/js/bookmark_button.js" charset="utf-8" async="async"></script>
  </div>
  <div class="u-cf">
    <a href="https://github.com/hbkr/tefutefu">github</a> / <a href="http://twitter.com/hbkr">twitter</a> kazuma ieiri
  </div>
</footer>

</div>
</body>
</html>
