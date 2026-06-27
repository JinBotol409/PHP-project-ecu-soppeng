<?php
if($_SERVER['REQUEST_URI'] === '/posts/repair/index.php'){
    header("Location: /posts/repair/", true, 301);
 exit;
}
session_start();
require_once("../../includes/db.php");

function getYoutubeId($url){

if(empty($url)) return '';

preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/|youtube\.com\/embed\/|youtube\.com\/shorts\/)([^&\?\/]+)/', $url, $matches);

return $matches[1] ?? '';

}

function mediaCloudUrl($value, $folder){

if(empty($value)) return '';

$value = trim($value);

if(preg_match('/^https?:\/\//i', $value)){
    return $value;
}

return 'https://cdn.idsrepair.com/'.$folder.'/'.ltrim($value, '/');

}

/* KIRIM KOMENTAR */
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['comment_submit'])){

    if(!isset($_SESSION['user_id'])){
        header("Location: /index.php");
        exit;
    }

    $repair_id = (int)$_POST['repair_id'];
    $comment = mysqli_real_escape_string($conn, $_POST['comment']);
    $user_id = (int)$_SESSION['user_id'];
    $user_name = $_SESSION['user_name'] ?? 'Member';

    mysqli_query($conn,"
        INSERT INTO repair_comments
        (repair_id,user_id,user_name,comment)
        VALUES
        ('$repair_id','$user_id','$user_name','$comment')
    ");

    header("Location: /posts/repair/#post".$repair_id);
    exit;
}

/* search */
$search = trim($_GET['q'] ?? '');

$where = "";

if($search !== ""){
    $safeSearch = mysqli_real_escape_string($conn, $search);
    $where = "WHERE repair_posts.title LIKE '%$safeSearch%' 
              OR repair_posts.content LIKE '%$safeSearch%'";
}

/* AMBIL POSTING */
$posts = mysqli_query($conn,"
SELECT 
repair_posts.*,
tamu.nama AS nama_author,
tamu.foto_profil
FROM repair_posts
LEFT JOIN tamu
ON tamu.id = repair_posts.user_id
$where
ORDER BY repair_posts.pinned DESC, repair_posts.id DESC
");
?>

<!DOCTYPE html>
<html lang="id">
<head>
<!-- HTML Meta Tags -->
<title>Posting ECU Repair | IDS ECU REPAIR SOPPENG</title>
<meta name="description" content="Halaman posting ECU Repair IDS ECU REPAIR SOPPENG untuk berbagi repair ECU, file ECU, cloning ECU, IMMO OFF, diagnosa kerusakan ECU dan pengalaman teknisi ECU Indonesia.">
<meta name="theme-color" content="#c00000">
<meta name="keywords" content="Posting ECU Repair, Otomotif diesel makassar, Mks ecu repair, ECU Repair Indonesia, File ECU, IMMO OFF, Cloning ECU, Repair ECU Soppeng, ECU Diesel, ECU Mobil, ECU Denso, ECU Bosch, Forum ECU Indonesia, Teknisi ECU">
<meta name="robots" content="index, follow">
<meta name="author" content="Jinbotol">
<!-- Geo Location Meta Tags -->
<meta name="geo.region" content="ID-SN">
<meta name="geo.placename" content="Soppeng, Sulawesi Selatan">
<meta name="geo.position" content="-4.3519;119.8786">
<meta name="ICBM" content="-4.3519, 119.8786">
<!-- Facebook Meta Tags -->
<meta property="og:url" content="https://idsrepair.com/posts/repair/">
<meta property="og:type" content="website">
<meta property="og:title" content="Posting ECU Repair | IDS ECU REPAIR SOPPENG">
<meta property="og:description" content="Posting repair ECU, file ECU, IMMO OFF, cloning ECU, diagnosa kerusakan ECU dan diskusi teknisi ECU Indonesia.">
<meta property="og:image" content="https://cdn.idsrepair.com/css/og-banner2.png">
<meta property="og:locale" content="id_ID">
<!-- Optimasi Tambahan Khusus WhatsApp -->
<meta property="og:image:secure_url" content="https://cdn.idsrepair.com/css/og-banner2.png">
<meta property="og:image:type" content="image/png">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<!-- Twitter Meta Tags -->
<meta name="twitter:card" content="summary_large_image">
<meta property="twitter:domain" content="idsrepair.com">
<meta property="twitter:url" content="https://idsrepair.com/posts/repair/">
<meta name="twitter:title" content="Posting ECU Repair | IDS ECU REPAIR SOPPENG">
<meta name="twitter:description" content="Posting repair ECU, file ECU, IMMO OFF, cloning ECU dan diagnosa kerusakan ECU Indonesia.">
<meta name="twitter:image" content="https://cdn.idsrepair.com/css/og-banner2.png">
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<!-- Schema.org markup for Google -->
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "WebPage",
    "url": "https://idsrepair.com/posts/repair/",
    "name": "Posting ECU Repair | IDS ECU REPAIR SOPPENG",
    "description": "Halaman posting ECU Repair IDS ECU REPAIR SOPPENG untuk berbagi repair ECU, file ECU, cloning ECU, IMMO OFF dan diagnosa kerusakan ECU.",
    "publisher": {
      "@type": "Organization",
      "name": "IDSREPAIR",
      "logo": {
        "@type": "ImageObject",
        "url": "https://idsrepair.com/css/ecu-logo.png"
      }
    }
  }
  </script>
<link rel="canonical" href="https://idsrepair.com/posts/repair/">
<link rel="icon" href="https://cdn.idsrepair.com/css/ecu-logo.png" type="image/png">
<link rel="shortcut icon" href="https://cdn.idsrepair.com/css/ecu-logo.png" type="image/x-icon">
<link rel="apple-touch-icon" href="https://cdn.idsrepair.com/css/ecu-logo.png">
<link data-rh="true" rel="shortcut icon" href="https://cdn.idsrepair.com/css/ecu-logo.png" type="image/x-icon">
<link rel="stylesheet" type="text/css" media="screen" href="/css/theme.css?v=<?= time() ?>"/>
<style>
*{
margin:0;
padding:0;
box-sizing:border-box;
}

body{
background:#0d0d0d;
font-family:Arial,sans-serif;
color:#fff;
}

.navbar{
position:sticky;
top:0;
z-index:999;
background:#111;
border-bottom:1px solid #222;
padding:12px 15px;
display:flex;
align-items:center;
justify-content:space-between;
border:none!important;
box-shadow:0 0 14px rgba(255,0,0,.45);
}

.navbar .logo{
font-weight:bold;
margin-left:14px;
color:#ff2b2b;
font-size:17px;
letter-spacing:1px;
}

.nav-right{
display:flex;
gap:8px;
align-items:center;
}

.nav-btn{
background:#1c1c1c;
border:1px solid #333;
color:#fff;
padding:8px 12px;
border-radius:8px;
text-decoration:none;
font-size:12px;
}

.nav-btn:hover{
background:#ff2b2b;
}

.container{
width:100%;
max-width:750px;
margin:auto;
padding:15px;
}

.post{
background:#161616;
border:1px solid #242424;
border-radius:14px;
overflow:hidden;
margin-bottom:18px;
}

.post-img{
width:100%;
max-height:420px;
object-fit:cover;
border-radius:8px;
margin-bottom:10px;
border:1px solid #333;
}

.post-video{
width:100%;
max-height:420px;
border-radius:14px;
margin-bottom:15px;
background:#000;
object-fit:cover;
}

.content{
padding:14px;
}

.title{
font-size:18px;
font-weight:bold;
color:#ff3c3c;
margin-bottom:10px;
line-height:1.4;
}

.desc{
font-size:14px;
color:#d2d2d2;
line-height:1.7;

display:-webkit-box;
-webkit-line-clamp:5;
-webkit-box-orient:vertical;

overflow:hidden;
text-overflow:ellipsis;
}

.info{
margin-top:14px;
font-size:12px;
color:#888;
display:flex;
align-items:center;
gap:8px;
}

.author-img{
width:32px;
height:32px;
border-radius:50%;
object-fit:cover;
border:1px solid #ff2b2b;
}

.author-name{
color:#fff;
font-size:13px;
}

.author-date{
color:#888;
font-size:11px;
}

/* FILE ECU */

.ecu-file-box{
margin-top:14px;
background:#1a1a1a;
border:1px solid #2a2a2a;
border-radius:12px;
padding:12px;
display:flex;
align-items:center;
justify-content:space-between;
gap:10px;
}

.ecu-file-left{
display:flex;
align-items:center;
gap:10px;
overflow:hidden;
}

.ecu-file-icon{
width:45px;
height:45px;
border-radius:10px;
background:#2a2a2a;
display:flex;
align-items:center;
justify-content:center;
font-size:22px;
flex-shrink:0;
}

.ecu-file-info{
overflow:hidden;
}

.ecu-file-name{
font-size:13px;
font-weight:bold;
color:#fff;
white-space:nowrap;
overflow:hidden;
text-overflow:ellipsis;
max-width:180px;
}

.ecu-file-size{
font-size:11px;
color:#888;
margin-top:3px;
}

.ecu-download-btn{
width:42px;
height:42px;
border-radius:10px;
background:#c00000;
display:flex;
align-items:center;
justify-content:center;
text-decoration:none;
color:#fff;
font-size:18px;
flex-shrink:0;
}

.ecu-download-btn:hover{
background:#ff2b2b;
}

/* KOMENTAR */

.comment-toggle{
display:inline-block;
margin-top:12px;
background:#1b1b1b;
border:1px solid #333;
color:#ff3c3c;
padding:8px 12px;
border-radius:8px;
font-size:13px;
cursor:pointer;
}

.comment-toggle:hover{
background:#222;
}

.comment-section{
display:none;
margin-top:12px;
background:#101010;
border-radius:10px;
padding:12px;
}

.comment-section.active{
display:block;
}

.comment-section h3{
font-size:15px;
margin-bottom:12px;
color:#ff3c3c;
}

.comment-item{
background:#1a1a1a;
padding:10px;
border-radius:8px;
margin-bottom:10px;
}

.comment-item b{
font-size:13px;
color:#ff4d4d;
}

.comment-item p{
margin-top:5px;
font-size:13px;
line-height:1.6;
color:#ccc;
}

.comment-item small{
font-size:11px;
color:#777;
}

textarea{
width:100%;
height:80px;
resize:none;
outline:none;
background:#1b1b1b;
border:1px solid #333;
border-radius:8px;
padding:10px;
color:#fff;
font-size:13px;
margin-top:10px;
}

button{
background:#c00000;
border:none;
padding:10px 14px;
color:#fff;
border-radius:8px;
margin-top:10px;
cursor:pointer;
font-size:13px;
font-weight:bold;
}

button:hover{
background:#ff2b2b;
}

.login-link{
color:#ff3c3c;
font-size:13px;
text-decoration:none;
}

.empty{
padding:50px 20px;
text-align:center;
color:#777;
}

@media(max-width:600px){
.logo{
font-size:15px;
}

.nav-btn{
font-size:11px;
padding:7px 10px;
}

.container{
padding:10px;
}

.title{
font-size:16px;
}

.desc{
font-size:13px;
}

.post-img{
max-height:240px;
}
}
.comment-top{
display:flex;
align-items:center;
gap:10px;
margin-bottom:8px;
}

.comment-avatar{
width:38px;
height:38px;
border-radius:50%;
object-fit:cover;
border:1px solid #444;
background:#111;
}

.comment-name{
font-size:13px;
font-weight:bold;
color:#fff;
}

.comment-date{
font-size:11px;
color:#888;
}

.comment-text{
font-size:13px;
line-height:1.7;
color:#ccc;
margin-left:48px;
}
.media-slider{
display:flex;
overflow-x:auto;
scroll-snap-type:x mandatory;
background:#000;
}

.media-slider::-webkit-scrollbar{
height:6px;
}

.media-slider::-webkit-scrollbar-thumb{
background:#444;
border-radius:10px;
}

.slide{
min-width:100%;
scroll-snap-align:start;
background:#000;
display:flex;
align-items:center;
justify-content:center;
}

.media-slider .post-img{
width:100%;
height:420px;
object-fit:cover;
border-radius:0;
margin-bottom:0;
border:none;
display:block;
}

.media-slider .post-video{
width:100%;
height:420px;
object-fit:contain;
border-radius:0;
margin-bottom:0;
border:none;
background:#000;
display:block;
}

@media(max-width:600px){
.media-slider .post-img,
.media-slider .post-video{
height:260px;
}
}
.post{
position:relative;
}

.locked-post > *:not(.lock-overlay){
filter:blur(6px);
pointer-events:none;
user-select:none;
}

.lock-overlay{
position:absolute;
inset:0;
z-index:20;
background:rgba(0,0,0,.55);
display:flex;
align-items:center;
justify-content:center;
text-align:center;
color:#fff;
font-weight:bold;
font-size:15px;
padding:20px;
}

.lock-overlay a{
display:inline-block;
background:#c00000;
color:#fff;
padding:10px 14px;
border-radius:8px;
text-decoration:none;
font-size:13px;
}
.media-loading-spin{
width:34px!important;
height:34px!important;
border:4px solid #333!important;
border-top:4px solid red!important;
border-radius:50%!important;
animation:mediaSpin .8s linear infinite!important;
margin:15px auto!important;
display:block!important;
z-index:999!important;
}

@keyframes mediaSpin{
100%{transform:rotate(360deg);}
}

img:not(.no-loader),
video:not(.no-loader){
opacity:0;
transition:.3s;
}

img.media-loaded,
video.media-loaded{
opacity:1!important;
}

.media-slider iframe{
width:100%;
height:185px;
border:none;
background:#000;
display:block;
}
.search-modal{
display:none;
position:fixed;
top:60px;
left:0;
width:100%;
padding:8px 12px;
z-index:99;
background:none;
}

.search-modal.active{
display:block;
}

.search-popup{
max-width:750px;
margin:auto;
background:#111;
border:1px solid #c00000;
border-radius:10px;
padding:10px;
}

.search-form{
display:flex;
gap:8px;
align-items:center;
}

.search-form input{
flex:1;
height:28px;
background:#1b1b1b;
border:1px solid #333;
border-radius:8px;
padding:0 10px;
color:#fff;
font-size:13px;
-webkit-appearance:none;
appearance:none;
}

.search-form input:focus,
.search-form input:active{
outline:none!important;
box-shadow:none!important;
border:1px solid #333!important;
-webkit-tap-highlight-color:transparent;
}

.search-submit{
height:22px;
padding:0 14px;
background:#c00000;
border:none;
border-radius:8px;
color:#fff;

margin:0;
}

.search-reset{
height:22px;
padding:0 10px;
background:#222;
border:1px solid #333;
border-radius:8px;
color:#fff;
text-decoration:none;
display:flex;
align-items:center;
justify-content:center;

}

</style>
</head>

<body>

<div class="navbar">

<div class="logo">
IDS ECU REPAIR
</div>

<div class="nav-right">

<a href="#" class="nav-btn" onclick="openSearch();return false;">
🔍 Cari
</a>

<a href="https://idsrepair.com/" class="nav-btn">Home</a>

<?php if(isset($_SESSION['user_id'])): ?>

<a href="/posts/create_repair/" class="nav-btn">
+ Posting
</a>

<?php else: ?>
<!--
<a href="/" class="nav-btn">
Login
</a>
-->
<?php endif; ?>

</div>

</div>

<div class="container">

<?php if(mysqli_num_rows($posts) > 0): ?>

<?php $no = 0; ?>

<?php while($row = mysqli_fetch_assoc($posts)): ?>

<?php
$no++;
$locked = (!isset($_SESSION['user_id']) && $no > 5);
?>

<div class="post <?= $locked ? 'locked-post' : '' ?>" id="post<?= $row['id'] ?>">

<?php if($locked): ?>
<div class="lock-overlay">
<div>
🔒<br>
Login atau buat akun<br>
untuk melihat postingan ini
<br><br>
<a href="/">Masuk / Daftar</a>
</div>
</div>
<?php endif; ?>

<?php if(!empty($row['image']) || !empty($row['video']) || !empty($row['youtube_url'])): ?>

<div class="media-slider">

<?php if(!empty($row['image'])): ?>

<?php
$images = array_filter(array_map('trim', explode(',', $row['image'])));
?>

<?php foreach($images as $img): ?>

<div class="slide">
<a href="/posts/view_repair/?id=<?= $row['id'] ?>">
<img class="post-img" loading="lazy" src="<?= htmlspecialchars(mediaCloudUrl($img, 'repairs')) ?>">
</a>
</div>

<?php endforeach; ?>

<?php endif; ?>

<?php if(!empty($row['video'])): ?>

<div class="slide">
<video class="post-video" controls playsinline preload="none">
<source src="<?= htmlspecialchars(mediaCloudUrl($row['video'], 'videos')) ?>" type="video/mp4">
</video>
</div>

<?php endif; ?>

<?php if(!empty($row['youtube_url'])): ?>

<?php $ytId = getYoutubeId($row['youtube_url']); ?>

<?php if($ytId): ?>

<div class="slide">

<iframe
class="post-video"
loading="lazy"
src="https://www.youtube.com/embed/<?= htmlspecialchars($ytId) ?>"
title="YouTube video"
frameborder="0"
allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
allowfullscreen>
</iframe>

</div>

<?php endif; ?>

<?php endif; ?>

</div>

<?php endif; ?>

<div class="content">

<?php if($row['pinned'] == 1): ?>

<div style="
display:inline-block;
background:#c00000;
color:#fff;
padding:5px 10px;
border-radius:8px;
font-size:11px;
margin-bottom:8px;
font-weight:bold;
">
📌 POSTINGAN TERSEMAT
</div>

<?php endif; ?>

<a href="/posts/view_repair/?id=<?= $row['id'] ?>"
style="text-decoration:none;color:inherit;">

<div class="title">
<?= htmlspecialchars($row['title']) ?>
</div>

</a>

<div class="desc">
<?= nl2br(htmlspecialchars($row['content'])) ?>
</div>

<?php if(!empty($row['ecu_file'])): ?>

<div class="ecu-file-box">

<div class="ecu-file-left">

<div class="ecu-file-icon">
📦
</div>

<div class="ecu-file-info">

<div class="ecu-file-name">
<?= htmlspecialchars($row['ecu_file_original'] ?: $row['ecu_file']) ?>
</div>

<div class="ecu-file-size">
<?php
$size = (int)($row['ecu_file_size'] ?? 0);

if($size > 0){
    echo $size >= 1048576 ? round($size / 1048576,2).' MB' : round($size / 1024,2).' KB';
}else{
    $filePath = $_SERVER['DOCUMENT_ROOT'].'/uploads/ecu_files/'.$row['ecu_file'];

    if(file_exists($filePath)){

        $size = filesize($filePath);

        if($size >= 1048576){
            echo round($size / 1048576,2).' MB';
        }else{
            echo round($size / 1024,2).' KB';
        }

    }else{
        echo 'File tidak ditemukan';
    }
}
?>

</div>

</div>

</div>

<?php if(isset($_SESSION['user_id'])): ?>

<a href="/posts/download_ecu.php?id=<?= $row['id'] ?>"
class="ecu-download-btn">
⬇
</a>

<?php else: ?>

<a href="/"
class="ecu-download-btn"
style="background:#333;color:#aaa;"
onclick="alert('Login dulu untuk download file ECU');">
🔒
</a>

<?php endif; ?>

</div>

<?php endif; ?>

<div class="info">

<img src="<?= !empty($row['foto_profil']) 
? $row['foto_profil'] 
: '/css/default-profile.png'; ?>"
loading="lazy"
class="author-img"
alt="Author">

<div>

<div class="author-name">
<?= htmlspecialchars($row['nama_author'] ?? $row['author']) ?>
</div>

<div class="author-date">
<?= date('d M Y H:i', strtotime($row['created_at'])) ?>
</div>

</div>

</div>

<?php
$repair_id = (int)$row['id'];

$totalKomentarQuery = mysqli_query($conn,"
SELECT COUNT(*) AS total
FROM repair_comments
WHERE repair_id='$repair_id'
");

$jumlahKomentar = mysqli_fetch_assoc($totalKomentarQuery)['total'];

$comments = mysqli_query($conn,"
SELECT 
repair_comments.*,
tamu.nama AS nama_komentar,
tamu.foto_profil
FROM repair_comments
LEFT JOIN tamu
ON tamu.id = repair_comments.user_id
WHERE repair_comments.repair_id='$repair_id'
ORDER BY repair_comments.id ASC
");
?>

<button type="button"
class="comment-toggle"
onclick="toggleComment(<?= $row['id'] ?>)">
💬 <?= $jumlahKomentar ?> Komentar
</button>

<a href="/posts/view_repair/?id=<?= $row['id'] ?>#detail-komentar"
class="comment-toggle"
style="text-decoration:none;margin-left:6px;">
Buka Detail
</a>

<div class="comment-section" id="commentBox<?= $row['id'] ?>">

<h3>Komentar</h3>

<?php if(mysqli_num_rows($comments) > 0): ?>

<?php while($c = mysqli_fetch_assoc($comments)): ?>

<div class="comment-item">

<div class="comment-top">

<img src="<?= !empty($c['foto_profil']) 
? $c['foto_profil'] 
: '/css/default-profile.png'; ?>"
loading="lazy"
class="comment-avatar"
alt="Komentar">

<div>

<div class="comment-name">
<?= htmlspecialchars($c['nama_komentar'] ?? $c['user_name']) ?>
</div>

<small class="comment-date">
<?= date('d M Y H:i', strtotime($c['created_at'])) ?>
</small>

</div>

</div>

<p class="comment-text">
<?= nl2br(htmlspecialchars($c['comment'])) ?>
</p>

</div>

<?php endwhile; ?>

<?php else: ?>

<p style="color:#777;font-size:13px;">
Belum ada komentar.
</p>

<?php endif; ?>

<?php if(isset($_SESSION['user_id'])): ?>

<form method="POST">

<input type="hidden" name="repair_id" value="<?= $row['id'] ?>">

<textarea name="comment" placeholder="Tulis komentar atau pertanyaan..." required></textarea>

<button type="submit" name="comment_submit">
Kirim Komentar
</button>

</form>

<?php else: ?>

<a href="/" class="login-link">
Login untuk komentar
</a>

<?php endif; ?>

</div>

</div>

</div>

<?php endwhile; ?>

<?php else: ?>

<div class="empty">
Belum ada posting ECU.
</div>

<?php endif; ?>

</div>

<div class="search-modal" id="searchModal">
    <div class="search-popup">

        <form method="GET" action="/posts/repair/" class="search-form">

            <input
            type="text"
            name="q"
            placeholder="Cari postingan ECU..."
            value="<?= htmlspecialchars($search ?? '') ?>">

            <button type="submit" class="search-submit">
                🔍
            </button>

            <a href="/posts/repair/" class="search-reset">
                🛠️
            </a>

        </form>

    </div>
</div>

<script>
function toggleComment(id){
    const box = document.getElementById('commentBox' + id);

    if(box){
        box.classList.toggle('active');
    }
}
</script>
<script>
document.addEventListener("DOMContentLoaded", function(){

    document.querySelectorAll("img:not(.no-loader)").forEach(function(img){

        let loader = document.createElement("div");
        loader.className = "media-loading-spin";

        img.parentNode.insertBefore(loader, img);

        function selesai(){
            img.classList.add("media-loaded");
            if(loader) loader.remove();
        }

        img.addEventListener("load", selesai);
        img.addEventListener("error", selesai);

        if(img.complete && img.naturalWidth > 0){
            selesai();
        }

    });

    document.querySelectorAll("video:not(.no-loader)").forEach(function(video){

        let loader = document.createElement("div");
        loader.className = "media-loading-spin";

        video.parentNode.insertBefore(loader, video);

        function selesai(){
            video.classList.add("media-loaded");
            if(loader) loader.remove();
        }

        video.addEventListener("loadeddata", selesai);
        video.addEventListener("error", selesai);

        if(video.readyState >= 2){
            selesai();
        }

    });

});
</script>
<script>
function openSearch(){
  const modal = document.getElementById('searchModal');
  modal.classList.toggle('active');
}

function closeSearch(){
  document.getElementById('searchModal').classList.remove('active');
}

document.addEventListener('click', function(e){
  const modal = document.getElementById('searchModal');
  const searchBtn = document.querySelector('.nav-right a[onclick*="openSearch"]');

  if(!modal || !searchBtn) return;

  if(
    modal.classList.contains('active') &&
    !modal.contains(e.target) &&
    !searchBtn.contains(e.target)
  ){
    modal.classList.remove('active');
  }
});
</script>
<script src="/js/theme-mode.js"></script>
</body>
</html>