<?php
    $link = mysqli_connect("127.0.0.1", "root","kk1673147","pydb")or die("無法連接資料庫".mysqli_error());
    $query = "select * from  student";
    $result = mysqli_query($link, $query);
    while ($row = mysqli_fetch_array($result)){
        echo $row['sname']."<br>";
    }
?>