<?php
require 'config.php';
require 'httpHelper.php';
const POST = 'post';
const GET = 'get';

class Client
{
  function __construct($appId, $apisecret)
  {
    $this->baseUrl = "https://{$appId}:{$apisecret}@".HOST;
  }

  public function sendMessage($content, $target=array('all'=> true), $trigger=array('now'=> true)) {
    $message = array(
      'content' => $content,
      'target' => $target,
      'trigger' => $trigger
      );

    $url = $this->baseUrl.MESSAGE_R;

    try{
      $ret = HttpHelper::_request($url, POST, $message);
      $result = array('id' => $ret['nid']);
      return $result;
    }
    catch(Exception $e){
      throw $e;
    }
  }
}
?>
