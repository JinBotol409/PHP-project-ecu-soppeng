<?php
header("X-Robots-Tag: noindex, nofollow", true);
session_start();
require_once("../includes/db.php");
require_once("../vendor/autoload.php");

use Aws\S3\S3Client;

/*
    DELETE REPAIR + DELETE SEMUA FILE TERKAIT
    - image: repairs/
    - video: videos/ atau repairs/ lama
    - og_image: og_images/
    - ecu_file: ecu_files/
    - youtube_url: hanya link database, tidak ada file fisik

    Isi konfigurasi R2 sama seperti create_repair Cloudflare.
*/
define("R2_ACCOUNT_ID", "5e6a1a66eede9317807017b1890dfeef");
define("R2_ACCESS_KEY_ID", "0b91ea800a96f1a7217bec08cc9f5b31");
define("R2_SECRET_ACCESS_KEY", "338ae723efa5c17a31e88ec8d5ab8d28bdfbbbd94a377bad52de3c0f9e9ec4fd");
define("R2_BUCKET", "idsrepair-images");
define("R2_PUBLIC_URL", "https://cdn.idsrepair.com");

if(!isset($_SESSION['user_id'])){
    header("Location: /");
    exit;
}

if(!isset($_GET['id'])){
    header("Location: /dashboard/my_posts/");
    exit;
}

$id = (int)$_GET['id'];
$user_id = (int)$_SESSION['user_id'];
$user_name = $_SESSION['user_name'] ?? '';

$q = mysqli_query($conn,"
SELECT * FROM repair_posts
WHERE id='$id'
LIMIT 1
");

$post = mysqli_fetch_assoc($q);

if(!$post){
    header("Location: /dashboard/my_posts/");
    exit;
}

/* hanya pemilik posting yang boleh hapus */
$ownerOk = false;

if(isset($post['user_id']) && (int)$post['user_id'] === $user_id){
    $ownerOk = true;
}

if(!$ownerOk && isset($post['author']) && $post['author'] === $user_name){
    $ownerOk = true;
}

if(!$ownerOk){
    die("Kamu tidak boleh hapus postingan orang lain.");
}

function r2Client(){
    if(!class_exists('Aws\\S3\\S3Client')){
        return null;
    }

    if(R2_ACCOUNT_ID === '' || R2_ACCESS_KEY_ID === '' || R2_SECRET_ACCESS_KEY === ''){
        return null;
    }

    return new S3Client([
        'version' => 'latest',
        'region' => 'auto',
        'endpoint' => 'https://'.R2_ACCOUNT_ID.'.r2.cloudflarestorage.com',
        'use_path_style_endpoint' => true,
        'credentials' => [
            'key' => R2_ACCESS_KEY_ID,
            'secret' => R2_SECRET_ACCESS_KEY,
        ],
    ]);
}

function deleteLocalIfExists($path){
    if($path && file_exists($path)){
        @unlink($path);
    }
}

function cleanValueList($value){
    $items = [];

    if(empty($value)){
        return $items;
    }

    $parts = explode(',', $value);

    foreach($parts as $part){
        $part = trim($part);
        if($part !== ''){
            $items[] = $part;
        }
    }

    return $items;
}

function r2KeyFromValue($value, $defaultFolder){
    $value = trim($value);

    if($value === ''){
        return '';
    }

    $cdn = rtrim(R2_PUBLIC_URL, '/').'/';

    if(strpos($value, $cdn) === 0){
        return ltrim(substr($value, strlen($cdn)), '/');
    }

    if(preg_match('#^https?://[^/]+/(.+)$#i', $value, $m)){
        return ltrim($m[1], '/');
    }

    $value = ltrim($value, '/');

    if(strpos($value, 'repairs/') === 0 ||
       strpos($value, 'videos/') === 0 ||
       strpos($value, 'og_images/') === 0 ||
       strpos($value, 'ecu_files/') === 0){
        return $value;
    }

    return trim($defaultFolder, '/').'/'.$value;
}

function deleteR2ObjectSafe($s3, $key){
    if(!$s3 || !$key){
        return;
    }

    try{
        $s3->deleteObject([
            'Bucket' => R2_BUCKET,
            'Key' => $key,
        ]);
    }catch(Exception $e){
        // Jangan gagalkan hapus database hanya karena object R2 sudah tidak ada / gagal hapus.
    }
}

$s3 = r2Client();

/* HAPUS IMAGE: bisa banyak dipisah koma */
foreach(cleanValueList($post['image'] ?? '') as $img){
    deleteLocalIfExists("../uploads/repairs/".$img);
    deleteR2ObjectSafe($s3, r2KeyFromValue($img, 'repairs'));
}

/* HAPUS OG IMAGE */
foreach(cleanValueList($post['og_image'] ?? '') as $og){
    deleteLocalIfExists("../uploads/og_images/".$og);
    deleteR2ObjectSafe($s3, r2KeyFromValue($og, 'og_images'));
}

/* HAPUS VIDEO: upload Cloudflare baru pakai videos/, lokal lama pakai uploads/repairs */
foreach(cleanValueList($post['video'] ?? '') as $video){
    deleteLocalIfExists("../uploads/repairs/".$video);
    deleteR2ObjectSafe($s3, r2KeyFromValue($video, 'videos'));
}

/* HAPUS FILE ECU */
foreach(cleanValueList($post['ecu_file'] ?? '') as $ecuFile){
    deleteLocalIfExists("../uploads/ecu_files/".$ecuFile);
    deleteR2ObjectSafe($s3, r2KeyFromValue($ecuFile, 'ecu_files'));
}

/* HAPUS KOMENTAR POSTING */
mysqli_query($conn,"DELETE FROM repair_comments WHERE repair_id='$id'");

/* HAPUS DATA POSTING: youtube_url ikut hilang karena row dihapus */
mysqli_query($conn,"DELETE FROM repair_posts WHERE id='$id'");

header("Location: /dashboard/my_posts/");
exit;
?>
