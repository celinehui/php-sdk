<?php
require 'tuisongbaoException.php';
class HttpHelper
{
  public static function _request($url, $method, $params=''){
    $ch = curl_init($url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER, TRUE);
    if ($method == 'get') {
      curl_setopt($ch, CURLOPT_URL, $url . '?' . http_build_query($params));
    } else {
      curl_setopt($ch, CURLOPT_POST, TRUE);
      curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
      curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    }

    $result = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    if($httpCode == 400){
      throw new TuisongbaoException($result, $httpCode);
    }
    else if ($httpCode != 200){
      throw new TuisongbaoException('', $httpCode);
    }
    else{
      $result = json_decode($result, TRUE);
    }
    curl_close($ch);

    return $result;
  }
}

?>
