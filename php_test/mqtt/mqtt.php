<?php
    require('phpMQTT.php');
    
    $mqttHost= '127.0.0.1'; 
    $mqttPort= 1883;
    $mqttClientId= "php_mqtt_subscriber";
    $topicName= "my/topic";
    $userName= 'name';
    $password= 'password';
    
    $mqtt= new Bluerhinos\phpMQTT($mqttHost, $mqttPort, $mqttClientId);
    
    if ($mqtt->connect(true,NULL,$userName,$password)) {
        $topics[$topicName]= array("qos"=>0, "function"=>"handleMessage");
        $mqtt->subscribe($topics,0);
        while($mqtt->proc()){
            
        }
        // $mqtt->publish("topic",$message, 0);
        $mqtt->close();
    }else{
        echo "Fail or time out";
    }


    function handleMessage($topic, $message){
        echo "收到 \t $topic : \t $message \n";
    }

?>