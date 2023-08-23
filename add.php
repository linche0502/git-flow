<?php
    $link = mysqli_connect("127.0.0.1", "root","kk1673147","pydb")or die("無法連接資料庫".mysqli_error());
    $query = "insert into  `student` (`sno` , `sname`, `sage`, `ssex`) values('".$_POST['sno']."', '".$_POST['sname']."', '".$_POST['sage']."', '".$_POST['ssex']."');";
    echo $query;
    $result = mysqli_query($link, $query)or die("無法連接資料庫".mysqli_error());
    echo"<script>alert('新增成功');</script>"; 
    // 因為最外面是雙引號如果裡面也是雙引號會被誤認為已經結束
    echo"<script>location.href='list.php'</script>"; 
    // 網址轉到list.php
?>