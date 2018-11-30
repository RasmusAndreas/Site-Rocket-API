<?php

// Create an image, 1x1 pixel in size
$im=imagecreate(1,1);

// Set the background colour
$white=imagecolorallocate($im,255,255,255);

// Allocate the background colour
imagesetpixel($im,1,1,$white);

// Set the image type
header("content-type:image/jpg");

// Create a JPEG file from the image
imagejpeg($im);

// Free memory associated with the image
imagedestroy($im);

// CURL TO GET CONTENT
$seo_data = [];
$curl = curl_init();

$url = $_SERVER['HTTP_REFERER'];

curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_HTTPHEADER, ['Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8']);

curl_setopt($curl, CURLOPT_USERAGENT, 'User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36');
curl_setopt($curl, CURLOPT_AUTOREFERER, true);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$result = curl_exec($curl);

$result = preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', "", $result);

curl_close($curl);

$doc = new DOMDocument();
@$doc->loadHTML($result);

$nodes = $doc->getElementsByTagName('title');

//get and display what you need:
$title = $nodes->item(0)->nodeValue;

$images = $doc->getElementsByTagName('img');
$missingAlts = 0;

for ($i = 0; $i < $images->length; $i++)
{
    $image = $images->item($i);
    if($image->getAttribute('alt') === NULL || $image->getAttribute('alt') == '') {
        $missingAlts++;
    }
}

$metas = $doc->getElementsByTagName('meta');

for ($i = 0; $i < $metas->length; $i++)
{
    $meta = $metas->item($i);
    if($meta->getAttribute('name') == 'description') {
        $description = $meta->getAttribute('content');
    }
}

$body = $doc->getElementsByTagName('body');
$body = $body->item(0)->nodeValue;

$h1 = $doc->getElementsByTagName('h1');
$h2 = $doc->getElementsByTagName('h2');
$h3 = $doc->getElementsByTagName('h3');
$h4 = $doc->getElementsByTagName('h4');
$h5 = $doc->getElementsByTagName('h5');
$h6 = $doc->getElementsByTagName('h6');

// Create 

$seo_data['title'] = $title;
$seo_data['title_chars'] = mb_strlen($title, 'utf-8');
if(isset($description)) {
    $seo_data['description'] = $description;
} else {
    $seo_data['description'] = '';
}
$seo_data['description_chars'] = mb_strlen($seo_data['description'], 'utf-8');
$seo_data['total_images'] = count($images);
$seo_data['missing_alt'] = $missingAlts;
$seo_data['h1'] = count($h1);
$seo_data['h2'] = count($h2);
$seo_data['h3'] = count($h3);
$seo_data['h4'] = count($h4);
$seo_data['h5'] = count($h5);
$seo_data['h6'] = count($h6);
$seo_data['word_count'] = str_word_count($body);

// echo "<pre>";
// print_r($seo_data);
// echo "</pre>";

function postData($data, $url, $website, $apikey, $loadtime) {
    $target_url = 'http://sovid.dk/api/scripts/seo/'. $website . '/' . $apikey . '/' . $loadtime;
    $post = array(
        'client_secret'=>'tMGzy0M2XBkPsrQQDGZSpJWuzqB1IuVVO9I6fOlV',
        'url' => $url,
        'wordCount' => $data['word_count'],
        'metaDescription' => $data['description_chars'],
        'altText' => $data['missing_alt'],
        'title' => $data['title_chars'],
        'h1' => $data['h1'],
        'h2' => $data['h2'],
        'h3' => $data['h3'],
        'h4' => $data['h4'],
        'h5' => $data['h5'],
        'h6' => $data['h6'],
    );
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $target_url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8']);
    curl_setopt($ch, CURLOPT_USERAGENT, 'User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36');
    curl_setopt($ch, CURLOPT_AUTOREFERER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch, CURLOPT_VERBOSE,true);
    $result = curl_exec($ch);
    $curlresponse = json_decode($result, true);
    curl_close($ch);
    return $curlresponse;
}

$end = postData($seo_data, $_SERVER['HTTP_REFERER'], $_GET['website'], $_GET['apikey'], $_GET['loadtime']);
var_dump($end);