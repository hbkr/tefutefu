<!DOCTYPE html>
<html lang="ja">
<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# article: http://ogp.me/ns/article#">
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>TefuTefu連鎖</title>
<meta name="description" content="Tefu君の名言形態素解析→マルコフ連鎖">
<meta property="fb:app_id" content="283781975031992" />
<meta property="og:title" content="TefuTefu連鎖" />
<meta property="og:type" content="website" />
<meta property="og:url" content="http://vps1.liverty.biz/hbkr/tefu/" />
<meta property="og:image" content="http://vps1.liverty.biz/hbkr/tefu/tefuogp.png" />
<meta property="og:site_name" content="TefuTefu連鎖" />
<meta property="og:locale" content="ja_JP" />
<meta property="og:description" content="Tefu君の名言を形態素解析→マルコフ連鎖" />
<meta name="twitter:card" content="summary" />
<meta name="twitter:description" content="Tefu君の名言を形態素解析→マルコフ連鎖" />
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/normalize/3.0.2/normalize.min.css" />
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/skeleton/2.0.4/skeleton.min.css">
<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Open+Sans:400,400italic,600,600italic,700,700italic">
<link rel="stylesheet" href="custom.css">
</head>

<body>
<div class="container">

<header>
<h1>TefuTefu連鎖</h1>
<p class="desc">Tefu君の名言を形態素解析→マルコフ連鎖</p>
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

<div style="margin-top:20px">※ <a href=".">リロード</a>する度に文章は変わります</div>
<hr>
</main>


<footer>
<a href="https://github.com/hbkr/tefutefu">github</a> / <a href="http://twitter.com/hbkr">twitter</a> kazuma ieiri
</footer>

</div>
</body>
</html>
