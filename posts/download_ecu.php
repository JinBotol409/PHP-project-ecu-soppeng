<?php
header("X-Robots-Tag: noindex, nofollow", true);
session_start();
require_once("../includes/db.php");

if(!isset($_SESSION['user_id'])){
    header("Location: /index.php");
    exit;
}

if(!isset($_GET['id'])){
    die("File tidak ditemukan");
}

$id = (int)$_GET['id'];

$q = mysqli_query($conn,"
SELECT ecu_file, ecu_file_original
FROM repair_posts
WHERE id='$id'
LIMIT 1
");

$data = mysqli_fetch_assoc($q);

if(!$data || empty($data['ecu_file'])){
    die("File tidak ditemukan");
}

$ecuFile = trim($data['ecu_file']);
$downloadName = !empty($data['ecu_file_original'])
    ? $data['ecu_file_original']
    : basename(parse_url($ecuFile, PHP_URL_PATH));

$downloadName = basename(str_replace(['"', "\r", "\n"], '', $downloadName));

if($downloadName === ''){
    $downloadName = 'ecu_file.bin';
}

if(ob_get_level()){
    ob_end_clean();
}

/*
  Jika ecu_file sudah URL Cloudflare/CDN,
  file tetap diambil dari CDN, tapi nama download dipaksa dari ecu_file_original.
  Jangan redirect, karena redirect membuat browser memakai nama file acak dari CDN.
*/
if(preg_match('/^https?:\/\//i', $ecuFile)){

    $ch = curl_init($ecuFile);

    if(!$ch){
        die("Gagal membuka file CDN");
    }

    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'.$downloadName.'"; filename*=UTF-8\'\''.rawurlencode($downloadName));
    header('Cache-Control: no-cache, must-revalidate');
    header('Pragma: public');

    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_FAILONERROR, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, false);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
    curl_setopt($ch, CURLOPT_BUFFERSIZE, 1024 * 1024);
    curl_setopt($ch, CURLOPT_WRITEFUNCTION, function($ch, $chunk){
        echo $chunk;
        flush();
        return strlen($chunk);
    });

    $ok = curl_exec($ch);

    if($ok === false){
        if(!headers_sent()){
            http_response_code(404);
        }
        echo "File CDN tidak bisa dibaca";
    }

    curl_close($ch);
    exit;
}

/* Jika ecu_file masih nama file lokal lama */
$filePath = __DIR__ . "/../uploads/ecu_files/" . $ecuFile;

if(!file_exists($filePath)){
    die("File tidak ada di server");
}

header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="'.$downloadName.'"; filename*=UTF-8\'\''.rawurlencode($downloadName));
header('Content-Length: ' . filesize($filePath));
header('Cache-Control: no-cache, must-revalidate');
header('Pragma: public');

readfile($filePath);
exit;
?>