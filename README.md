# 推送宝 PHP SDK


## 推送消息


- 初始化客户端

 ```
 $client = new Client('your-app-Id', 'your-api-secret');
 ```

- 准备content

 ```
 $content => array(
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
            "extra"=> array('key1'=> 'value1', 'key2'=> 'value2')
        )
   )
 ```

- 准备target
   
 发送给全部的设备
 ```
 target=> array(
     'all'=> true 
 )
 ```
 
 制定推送的services
 ```
 target=> array(
     'services'=> ['ap', 'ad', 'tps']
 )
 ```

 发送给指定的token
 ```
 target=> array(
     "tokens"=> array(
         "ad"=> ["53a53fbc4121f6b98ae37df7fbf0388ccb855a8a0184a2fab3261b6f20c2801c"],
         "ap"=> ["13fc4525ccd80f2a49330c7d1511d7026f8b61a2472ef7d6e3712af3d2c7eb6a"],
         "tps"=> ["5315b2a69a0bc26f70195142"]
            )
 )
 ```
 
 根据过滤条件发送
 ```
 target=> array(
     "filter"=> array(
                "tags"=> ["hobbyMovie", "hobbySport"],
                "locations"=> ["Shanghaishi,Shanghaishi,Pudongxinqu"],
                "appVersions"=> ["1.1"],
                "inactiveSince"=> "2014-05-30T00:00:00.000Z"
            )
 )
 ```
 
- 准备trigger

 立即推送
 ```
 $trigger= array(
            "now"=> true
        );
 ```

 定时推送
 ```
 $trigger= array(
            "scheduled"=> "2014-07-30T10:30:00.000Z"
        );
 ```
 
 地理围栏推送
 ```
 $trigger= array(
            "geoFences"=> array(
                "fences"=> ["5315f91a9a0bc26f70150301"],
                "frequency"=> "every",
                "event"=> "enterOrLeave",
                "startTime"=> "2014-06-30T10:30:00.000Z",
                "endTime"=> "2014-07-01T10:30:00.000Z"
            )
        )
 ```
 
 **目前系统不支持地理围栏推送
 
- 发送消息
 ```
 try{
      $res = $client->sendMessage($content, $target, $trigger);
 }
 catch(Exception $e){
     echo $e;
    }
 ```
 
 **说明**
 
 其中$target不传时为默认发送全部, $trigger不传时默认立即发送
 
 


