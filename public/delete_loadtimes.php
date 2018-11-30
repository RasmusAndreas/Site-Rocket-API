<?php
function getUrls() {
  $target_url = "http://sovid.dk/api/scripts/deleteOldLoadtimes";
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
?>
