<?php
require("phpMQTT.php");

// MQTT 伺服器設定
$mqttServer = "localhost";  // MQTT 伺服器地址
$mqttPort = 1883;                  // MQTT 伺服器端口
$mqttClientId = "php_mqtt_subscriber"; // 客戶端 ID，請確保是唯一的
$mqttTopic = "my/topic";           // 要訂閱的主題

// MQTT 使用者驗證設定
$mqttUsername = "your_username";    // MQTT 使用者名稱
$mqttPassword = "your_password";    // MQTT 使用者密碼

// 建立 MQTT 客戶端實例
$mqtt = new Bluerhinos\phpMQTT($mqttServer, $mqttPort, $mqttClientId);

// 連接到 MQTT 伺服器並進行使用者驗證
if ($mqtt->connect(true, NULL, $mqttUsername, $mqttPassword)) {
    // 設定要訂閱的主題和處理函式
    $topics[$mqttTopic] = array("qos" => 0, "function" => "handleMessage");
    
    // 訂閱主題
    $mqtt->subscribe($topics, 0);

    // 處理 MQTT 事件直到程式結束
    while ($mqtt->proc()) {
        // 處理 MQTT 事件
    }

    // 關閉 MQTT 連接
    $mqtt->close();
} else {
    echo "連接到 MQTT 伺服器失敗...";
}

// 處理收到的消息的函式
function handleMessage($topic, $message) {
    echo "收到新消息：主題 - $topic, 消息 - $message\n";
}
?>
