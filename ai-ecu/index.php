<?php
if($_SERVER['REQUEST_URI'] === '/ai-ecu/index.php'){
    header("Location: /ai-ecu/", true, 301);
 exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<!-- HTML Meta Tags -->
<title>AI Diagnosa ECU - IDS ECU REPAIR</title>
<meta name="description" content="AI Diagnosa ECU IDS Repair membantu menjawab keluhan ECU, DTC, no start, no communication, injector mati, IMMO, CKP, CMP, remap dan prosedur read/write ECU.">
<meta name="keywords" content="AI Diagnosa ECU, Tanya AI ECU, ECU Repair Indonesia, DTC ECU, no communication ECU, injector mati, CKP CMP, IMMO OFF, remap ECU, read write ECU">
<meta name="robots" content="index, follow">
<meta name="author" content="Jinbotol">
<!-- Geo Location Meta Tags -->
<meta name="geo.region" content="ID-SN">
<meta name="geo.placename" content="Soppeng, Sulawesi Selatan">
<meta name="geo.position" content="-4.3519;119.8786">
<meta name="ICBM" content="-4.3519, 119.8786">
<!-- Facebook Meta Tags -->
<meta property="og:url" content="https://idsrepair.com/ai-ecu/">
<meta property="og:type" content="website">
<meta property="og:title" content="AI Diagnosa ECU - IDS ECU REPAIR">
<meta property="og:description" content="Tanya AI seputar keluhan ECU, DTC, no start, no communication, injector mati, IMMO, CKP/CMP, remap dan read/write ECU.">
<meta property="og:image" content="https://idsrepair.com/css/og-banner-ai-ecu.png">
<meta property="og:locale" content="id_ID">
<!-- Optimasi Tambahan Khusus WhatsApp -->
<meta property="og:image:secure_url" content="https://idsrepair.com/css/og-banner-ai-ecu.png">
<meta property="og:image:type" content="image/png">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<!-- Twitter Meta Tags -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:domain" content="idsrepair.com">
<meta name="twitter:url" content="https://idsrepair.com/ai-ecu/">
<meta name="twitter:title" content="AI Diagnosa ECU - IDS ECU REPAIR">
<meta name="twitter:description" content="AI Diagnosa ECU untuk membantu analisa awal keluhan ECU dan DTC kendaraan.">
<meta name="twitter:image" content="https://idsrepair.com/css/og-banner-ai-ecu.png">
<!-- Schema.org markup for Google -->
<script type="application/ld+json">
{
 "@context":"https://schema.org",
 "@type":"ImageObject",
 "contentUrl":"https://idsrepair.com/css/google-ai-banner.png",
 "name":"AI Diagnosa ECU IDS Repair"
}
</script>

<script type="application/ld+json">
{
 "@context":"https://schema.org",
 "@type":"Organization",
 "name":"IDS ECU REPAIR SOPPENG",
 "alternateName":"IDS Repair",
 "url":"https://idsrepair.com",
 "logo":"https://idsrepair.com/css/ecu-logo.png",
 "image":"https://idsrepair.com/css/og-banner-ai-ecu.png",
 "description":"IDS ECU REPAIR SOPPENG adalah forum dan layanan repair ECU, cloning ECU, IMMO OFF, remap ECU, diagnosa DTC dan read/write ECU.",
 "address":{
   "@type":"PostalAddress",
   "streetAddress":"Jl. Poros Maros - Soppeng No.30",
   "addressLocality":"Soppeng",
   "addressRegion":"Sulawesi Selatan",
   "addressCountry":"ID"
 }
}
</script>

<script type="application/ld+json">
{
 "@context":"https://schema.org",
 "@type":"WebApplication",
 "name":"AI Diagnosa ECU IDS Repair",
 "url":"https://idsrepair.com/ai-ecu/",
 "applicationCategory":"AutomotiveApplication",
 "operatingSystem":"Android, iOS, Web",
 "description":"AI diagnosa ECU untuk membantu analisa DTC, no start, no communication, injector mati, CKP, CMP, IMMO OFF dan kerusakan ECU kendaraan.",
 "image":"https://idsrepair.com/css/og-banner-ai-ecu.png",
 "publisher":{
   "@type":"Organization",
   "name":"IDS ECU REPAIR SOPPENG",
   "url":"https://idsrepair.com"
 }
}
</script>

<script type="application/ld+json">
{
 "@context":"https://schema.org",
 "@type":"FAQPage",
 "mainEntity":[
   {
     "@type":"Question",
     "name":"Apa penyebab ECU no communication?",
     "acceptedAnswer":{
       "@type":"Answer",
       "text":"Penyebab umum ECU no communication adalah suplai power ECU hilang, ground ECU buruk, jalur CAN rusak, soket OBD bermasalah, short sensor 5V atau ECU mati total."
     }
   },
   {
     "@type":"Question",
     "name":"Apa penyebab injector tidak keluar sinyal?",
     "acceptedAnswer":{
       "@type":"Answer",
       "text":"Injector tidak keluar sinyal biasanya disebabkan sensor CKP atau CMP tidak terbaca, immobilizer aktif, supply injector hilang, driver injector ECU rusak atau ECU no communication."
     }
   },
   {
     "@type":"Question",
     "name":"Apa risiko write ECU gagal?",
     "acceptedAnswer":{
       "@type":"Answer",
       "text":"Risiko write ECU gagal adalah ECU brick, file corrupt, checksum salah, software number tidak cocok, mobil no start atau hilang komunikasi dengan ECU."
     }
   },
   {
     "@type":"Question",
     "name":"Apa itu remap ECU?",
     "acceptedAnswer":{
       "@type":"Answer",
       "text":"Remap ECU adalah proses mengubah kalibrasi software ECU untuk meningkatkan tenaga, torsi, respons pedal atau efisiensi kendaraan dengan tetap memperhatikan keamanan mesin."
     }
   }
 ]
}
</script>
<meta name="theme-color" content="#c00000">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="mobile-web-app-capable" content="yes">
<link rel="image_src" href="https://idsrepair.com/css/google-ai-banner.png">
<link rel="canonical" href="https://idsrepair.com/ai-ecu/">
<link rel="icon" href="/css/ecu-logo.png" type="image/png">
<link rel="shortcut icon" href="/css/ecu-logo.png" type="image/x-icon">
<link rel="apple-touch-icon" href="/css/ecu-logo.png">
<link rel="ai-policy" href="/.well-known/ai-policy.json">
<link rel="icon" href="/css/ecu-logo.png" type="image/png">
<link rel="stylesheet" type="text/css" media="screen" href="/css/theme.css?v=<?= time() ?>"/>
</head>
<style>
*{
margin:0;
padding:0;
box-sizing:border-box;
}

html,
body{
width:100%;
height:100%;
overflow:hidden;
}

body{
font-family:Arial,sans-serif;
background:#050505;
color:#fff;
}

.ai-page{
width:100%;
height:100dvh;
padding:10px;
display:flex;
justify-content:center;
align-items:stretch;
}

.ai-box{
width:100%;
max-width:850px;
height:100%;
background:#111;
border:1px solid #2a2a2a;
border-radius:18px;
box-shadow:0 0 25px rgba(255,0,0,.18);
display:flex;
flex-direction:column;
overflow:hidden;
}

.ai-top{
height:58px;
padding:0 14px;
display:flex;
align-items:center;
justify-content:space-between;
border-bottom:1px solid #252525;
flex-shrink:0;
}

.home-btn{
display:inline-flex;
align-items:center;
justify-content:center;
width:42px;
height:42px;
border-radius:12px;
background:#1d1d1d;
border:1px solid #333;
color:#fff;
text-decoration:none;
font-size:20px;
}

.ai-title{
color:#ff2b2b;
font-size:20px;
font-weight:bold;
}

.ai-body{
padding:14px;
display:flex;
flex-direction:column;
height:calc(100% - 58px);
overflow:hidden;
}

.ai-desc{
color:#ccc;
line-height:1.5;
font-size:13px;
margin-bottom:10px;
flex-shrink:0;
}

.quick{
display:grid;
grid-template-columns:repeat(2,1fr);
gap:8px;
margin-bottom:10px;
flex-shrink:0;
}

.quick button{
padding:10px 8px;
font-size:12px;
background:#222;
border:1px solid #333;
border-radius:12px;
color:#fff;
font-weight:bold;
}

#chat{
flex:1;
min-height:0;
overflow-y:auto;
background:#080808;
border:1px solid #222;
border-radius:14px;
padding:12px;
margin-bottom:10px;
-webkit-overflow-scrolling:touch;
}

.msg{
padding:12px;
border-radius:13px;
margin-bottom:10px;
line-height:1.55;
white-space:pre-wrap;
font-size:14px;
}

.user{
background:#8b0000;
margin-left:38px;
border-bottom-right-radius:4px;
}

.bot{
background:#1b1b1b;
border-left:3px solid #ff2b2b;
margin-right:38px;
border-bottom-left-radius:4px;
}

.input-row{
display:grid;
grid-template-columns:1fr 80px;
gap:8px;
flex-shrink:0;
}

textarea{
width:100%;
height:56px;
background:#0b0b0b;
border:1px solid #333;
color:#fff;
border-radius:12px;
padding:11px;
resize:none;
font-size:13px;
outline:none;
}

.input-row button{
background:#d00000;
color:#fff;
border:none;
border-radius:12px;
font-weight:bold;
font-size:14px;
}

.note{
font-size:11px;
color:#999;
line-height:1.4;
margin-top:8px;
flex-shrink:0;
}

@media(max-width:480px){

.ai-page{
padding:8px;
}

.ai-box{
border-radius:16px;
}

.ai-top{
height:54px;
padding:0 12px;
}

.home-btn{
width:38px;
height:38px;
font-size:18px;
}

.ai-title{
font-size:18px;
}

.ai-body{
padding:12px;
height:calc(100% - 54px);
}

.quick{
gap:7px;
}

.quick button{
font-size:11px;
padding:9px 6px;
}

.msg{
font-size:13px;
padding:11px;
}

.user{
margin-left:26px;
}

.bot{
margin-right:26px;
}

.input-row{
grid-template-columns:1fr 74px;
}

textarea{
height:54px;
font-size:13px;
}

.input-row button{
font-size:13px;
}
}
</style>
<body>

<div class="ai-page">

<div class="ai-box">

<div class="ai-top">

<a href="/" class="home-btn">
⌂
</a>

<div class="ai-title">
🤖 AI Diagnosa ECU
</div>

<a href="/posts/repair/" class="home-btn">
🛠
</a>

</div>

<div class="ai-body">

<p class="ai-desc">
Tanya keluhan ECU, DTC, no start, no communication, IMMO, injector, CKP/CMP,
atau prosedur read/write ECU.
</p>

<div class="quick">

<button onclick="setQ('no communication')">
No Communication
</button>

<button onclick="setQ('injector mati')">
Injector Mati
</button>

<button onclick="setQ('cara kerja ecu')">
Cara Kerja ECU
</button>

<button onclick="setQ('risiko write ecu')">
Risiko Write ECU
</button>

</div>

<div id="chat">

<div class="msg bot">
Halo, saya AI ECU IDS Repair. Jelaskan keluhan kendaraan, tipe mobil, kode DTC, dan gejala lengkap.
</div>

</div>

<div class="input-row">

<textarea id="question" placeholder="Contoh: Toyota Hilux no start, DTC P0335, rpm scanner 0..."></textarea>

<button onclick="askAI()">
Kirim
</button>

</div>

<p class="note">
Catatan: AI ini hanya diagnosa awal. Untuk keputusan repair/remap tetap perlu pengecekan teknisi.
</p>

</div>

</div>

</div>

<script>
function setQ(text){
document.getElementById('question').value = text;
}

function addMsg(text, cls){
const chat = document.getElementById('chat');
const div = document.createElement('div');
div.className = 'msg ' + cls;
div.textContent = text;
chat.appendChild(div);
chat.scrollTop = chat.scrollHeight;
}

async function askAI(){

const input = document.getElementById('question');
const question = input.value.trim();

if(!question) return;

addMsg(question, 'user');

input.value = '';

addMsg('Sedang menganalisa...', 'bot');

try{

const res = await fetch('ai_reply.php', {
method:'POST',
headers:{
'Content-Type':'application/json',
'Accept':'application/json'
},
body:JSON.stringify({question:question})
});

const text = await res.text();

let data;

try{
data = JSON.parse(text);
}catch(e){
document.querySelector('#chat .bot:last-child').textContent =
'Server bukan JSON. Response: ' + text.substring(0,500);
return;
}

document.querySelector('#chat .bot:last-child').textContent =
data.answer || 'Maaf, AI belum bisa menjawab saat ini.';

}catch(e){

document.querySelector('#chat .bot:last-child').textContent =
'Gagal terhubung ke server AI: ' + e.message;

}

}
</script>
<script src="/js/theme-mode.js"></script>
</body>
</html>
