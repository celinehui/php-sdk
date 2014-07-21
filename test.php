<?php
require 'client.php';
class ClientTest extends PHPUnit_Framework_TestCase
{

  public $appId = 'cb70bf51d87f5111e71c3d4e';
  public $apisecret = 'ccdf9d7f6c0172b1a8bbc419';
  public $client;
  public $content;

  protected function setUp()
  {
    $this->client = new Client($this->appId, $this->apisecret);
    $this->content= array(
        "alert"=> "hello world!",
        "rich"=> array(
            "body"=> "rich page html"
        ),
        "extra"=> array(),
        "apns"=> array(
            "alert"=> "alert text for apns",
            "badge"=> 10,
            "sound"=> "the name of a sound file in the application bundle",
            "extra"=> array()
        ),
        "tps"=> array(
            "alert"=> "alert text for tps",
             "style"=> "110",
            "action"=> "2|www.tuisongbao.com",
            "extra"=> array()
        )
    );
  }

  protected function tearDown()
  {
    //- TODO
  }

  public function testSendMessageSuccess(){
    $target= array(
            "services"=> ["ad", "tps"],
            "tokens"=> array(
               "ad"=> ["53a53fbc4121f6b98ae37df7fbf0388ccb855a8a0184a2fab3261b6f20c2801c"],
               "tps"=> ["5315b2a69a0bc26f70195142"]
            )
        );

    $res = $this->client->sendMessage($this->content, $target);
    print_r($res);
    $this->assertTrue(is_int($res['id']));
  }

  public function testSendMessageToAllSuccess(){
    $res = $this->client->sendMessage($this->content);
    print_r($res);
    $this->assertTrue(is_int($res['id']));
  }

  public function testSendMessageFailedWithGeofence(){
    $target= array(
            "services"=> ["ad", "tps"],
            "filter"=> array(
                "tags"=> ["hobbyMovie", "hobbySport"],
                "locations"=> ["Shanghaishi,Shanghaishi,Pudongxinqu"],
                "appVersions"=> ["1.1"],
                "inactiveSince"=> "2014-05-30T00:00:00.000Z"
            )
        );

    $trigger= array(
            "geoFences"=> array(
                "fences"=> ["5315f91a9a0bc26f70150301"],
                "frequency"=> "every",
                "event"=> "enterOrLeave",
                "startTime"=> "2014-06-30T10:30:00.000Z",
                "endTime"=> "2014-07-01T10:30:00.000Z"
            )
        );

    try{
      $res = $this->client->sendMessage($this->content, $target, $trigger);
    }
    catch(Exception $e){
      $this->assertTrue(is_string($e->xdebug_message));
    }
  }

  public function testSendMessageFailedWithServiceUnconfiged(){
    $target= array(
            "services"=> ["ad", "tps"],
            "tokens"=> array(
              "ad"=> ["53a53fbc4121f6b98ae37df7fbf0388ccb855a8a0184a2fab3261b6f20c2801c"],
              "ap"=> ["13fc4525ccd80f2a49330c7d1511d7026f8b61a2472ef7d6e3712af3d2c7eb6a"],
              "tps"=> ["5315b2a69a0bc26f70195142"]
            )
        );

    $trigger= array(
            "scheduled"=> "2014-07-30T10:30:00.000Z"
        );

    try{
      $res = $this->client->sendMessage($this->content, $target, $trigger);
    }
    catch(Exception $e){
      $this->assertTrue(is_string($e->xdebug_message));
    }

  }
}

?>
