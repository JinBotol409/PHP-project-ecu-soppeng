<?php
if($_SERVER['REQUEST_URI'] === '/sport/index.php'){
    header("Location: /sport/", true, 301);
 exit;
}
session_start();
$isLogin = isset($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Info Sport & Olahraga | IDS ECU REPAIR</title>

<meta name="description" content="Halaman info sport dan olahraga berisi berita ringan, tips latihan, jadwal olahraga, dan informasi seputar dunia sport.">
<meta name="theme-color" content="#c00000">
<meta name="robots" content="index, follow">

<link rel="icon" href="https://cdn.idsrepair.com/css/ecu-logo.png">
<link rel="stylesheet" type="text/css" media="screen" href="/css/theme.css?v=<?= time() ?>"/>
</head>
<style>
*{margin:0;padding:0;box-sizing:border-box;}

body{
font-family:'Orbitron',sans-serif;
background:#0b0b0b;
color:#fff;
overflow-x:hidden;
}

.header{
position:sticky;
top:0;
z-index:999;
background:#111;
border-bottom:2px solid #c00000;
padding:17px 21px;
display:flex;
justify-content:space-between;
align-items:center;
border:none!important;
box-shadow:0 0 14px rgba(255,0,0,.45);
}

.header .logo{
font-size:16px;
font-weight:bold;
color:#ff2b2b;
letter-spacing:1px;
}

.nav a{
background:#1b1b1b;
border:1px solid #333;
color:#fff;
text-decoration:none;
padding:9px 12px;
border-radius:8px;
font-size:12px;
margin-left:6px;
}

.nav a:hover{
background:#c00000;
}

.hero{
padding:45px 18px 25px;
text-align:center;
background:
linear-gradient(rgba(0,0,0,.82),rgba(0,0,0,.9)),
url('/css/bg-ecu.jpg');
background-size:cover;
background-position:center;
}

.hero h1{
font-size:28px;
color:#ff2b2b;
margin-bottom:12px;
}

.hero p{
max-width:760px;
margin:auto;
font-size:14px;
line-height:1.7;
color:#ccc;
}

.container{
max-width:950px;
margin:auto;
padding:18px;
}

.card{
background:#141414;
border:1px solid #242424;
border-radius:14px;
padding:16px;
margin-bottom:16px;
}

.card h2{
font-size:18px;
color:#ff2b2b;
margin-bottom:10px;
}

.card p{
font-size:14px;
line-height:1.7;
color:#ccc;
}

.grid{
display:grid;
grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
gap:14px;
margin-top:14px;
}

.sport-box{
background:#1d1d1d;
border:1px solid #2a2a2a;
border-radius:12px;
padding:14px;
}

.sport-box h3{
font-size:15px;
color:#fff;
margin-bottom:8px;
}

.sport-box p{
font-size:13px;
color:#aaa;
line-height:1.6;
}

.badge{
display:inline-block;
background:#c00000;
color:#fff;
padding:5px 9px;
border-radius:20px;
font-size:11px;
margin-bottom:8px;
}

footer{
margin-top:30px;
padding:22px;
text-align:center;
background:#111;
border-top:1px solid #222;
color:#777;
font-size:13px;
}

@media(max-width:600px){
.logo{font-size:16px;}
.hero h1{font-size:23px;}
.nav a{font-size:11px;padding:8px 10px;}
}
</style>
<body>

<div class="header">

<div class="logo">
🏆 Sport Info
</div>

<div class="nav">
<a href="/">Home</a>
<a href="/posts/repair.php">Posting ECU</a>

<?php if($isLogin): ?>
<a href="https://idsrepair.com/dashboard/index.php">Dashboard</a>
<?php else: ?>
<a href="/index.php">Login</a>
<?php endif; ?>

</div>

</div>

<section class="hero">

<h1>Info Sport & Olahraga</h1>

<p>
Halaman ini berisi informasi ringan seputar olahraga,
tips latihan, jadwal aktivitas sport, dan inspirasi hidup sehat
untuk komunitas IDS.
</p>

</section>

<div class="container">

<div class="card">
<h2>🔥 Update Sport Hari Ini</h2>
<p>
AWALUDDIN "SUPERNEW" ASAL SOPPENG SIAP GEBRAK RING NEX RTC VOL. 2</p>
</div>

<div class="card">

<h2>📌 Kategori Olahraga</h2>

<div class="grid">

<div class="sport-box">
<span class="badge">Otomotif</span>

<h3>Automotive Sport</h3>

<p>
Info seputar dunia otomotif sport,
drag race, touring, modifikasi performa,
komunitas kendaraan,
dan update teknologi mesin kendaraan.
</p>
</div>

<div class="sport-box">
<span class="badge"><a href="fighter-awaludin/"style="text-decoration:none;color:white;">Fighter</a></span>

<h3>Combat & Fighter Sport</h3>

<p>
Informasi seputar dunia fighter,
boxing, MMA, kick boxing,
latihan fisik, stamina,
dan perkembangan olahraga combat sport.
</p>
</div>


</div>

</div>

<div class="card">
<h2>💪 Tips Olahraga Aman</h2>
<p>
Sebelum olahraga, lakukan pemanasan 5–10 menit.
Gunakan perlengkapan yang sesuai, minum air cukup,
dan jangan memaksakan tubuh jika merasa pusing atau nyeri.
</p>
</div>

<!--<div class="card">
<h2>📅 Jadwal Aktivitas Komunitas</h2>
<p>
Bagian ini bisa kamu isi nanti dengan jadwal futsal,
badminton, touring, event otomotif, atau kegiatan olahraga komunitas IDS.
</p>
</div>-->

</div>

<footer>
© 2025 IDS ECU REPAIR SOPPENG | Sport & Community
<script src="/js/theme-mode.js"></script>
</body>
</html>