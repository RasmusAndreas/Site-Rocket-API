<?php

$urls = getUrls();
foreach ($urls as $url) {
  $result = ping($url["domain"]);
  if ($result !== 200 && $result !== 0){
    insertUptime($url["id"], $result);
  }
}

function ping($url) {
  $curl = curl_init();
  curl_setopt($curl, CURLOPT_URL, $url);
  curl_setopt($curl, CURLOPT_HTTPHEADER, ['Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8']);
  curl_setopt($curl, CURLOPT_USERAGENT, 'User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36');
  curl_setopt($curl, CURLOPT_AUTOREFERER, true);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_NOBODY, true);
  curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
  curl_exec($curl);
  $retcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
  curl_close($curl);
  return $retcode;
}

function getUrls() {
  $target_url = "http://sovid.dk/api/scripts/geturls";
  $post = array('client_secret'=>'tMGzy0M2XBkPsrQQDGZSpJWuzqB1IuVVO9I6fOlV');
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL,$target_url);
  curl_setopt($ch, CURLOPT_HTTPHEADER, ['Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8']);
  curl_setopt($ch, CURLOPT_USERAGENT, 'User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36');
  curl_setopt($ch, CURLOPT_AUTOREFERER, true);
  curl_setopt($ch, CURLOPT_POST,1);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
  curl_setopt($ch, CURLOPT_VERBOSE,true);
  $result = curl_exec ($ch);
  $curlresponse = json_decode($result, true);
  curl_close($ch);
  return $curlresponse;
}

function insertUptime($websiteID, $statusCode) {
  $target_url = "http://sovid.dk/api/scripts/uptime/$websiteID";
  $post = array('client_secret'=>'tMGzy0M2XBkPsrQQDGZSpJWuzqB1IuVVO9I6fOlV', 'statusCode' => $statusCode);
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL,$target_url);
  curl_setopt($ch, CURLOPT_HTTPHEADER, ['Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8']);
  curl_setopt($ch, CURLOPT_USERAGENT, 'User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36');
  curl_setopt($ch, CURLOPT_AUTOREFERER, true);
  curl_setopt($ch, CURLOPT_POST,1);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
  curl_setopt($ch, CURLOPT_VERBOSE,true);
  $result = curl_exec ($ch);
  curl_close($ch);
}
