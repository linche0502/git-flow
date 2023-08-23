<!doctype html>
<html>
    <head>
        <style>
            td{
                border: 1 solid;
                text-align:center;
                padding: 5px;
            }
        </style>
    </head>
    <body>
    <h1 style="padding:50px; text-align:center;">php connect DB</h1>
    
    
    <?php 
        $link= mysqli_connect("127.0.0.1","root","01234567","testdb") or die("connect error:".mysqli_error());
        
        switch ($_GET['method']){
            case "add":
                $sno= '';
                $sname= '';
                $sage= '';
                $ssex= '';
                // 按下確認後
                if($_POST['sno']){
                    $query= "INSERT INTO student (sno, sname, sage, ssex) VALUE ('".$_POST['sno']."','".$_POST['sname']."','".$_POST['sage']."','".$_POST['ssex']."')";
                    $result= mysqli_query($link, $query);
                    if($result){ ?>
                        <script>
                            alert('新增成功');
                            window.location= '/test/db_connect.php';
                        </script>
                    <?php }else{ ?>
                        <script>
                            alert('新增失敗');
                            window.location= '/test/db_connect.php';
                        </script>
                    <?php }
                }
                break;
            case "update":
                if(!$_POST['sno']){
                    // 第一次近來, 沒有POST資料時
                    $query= "SELECT * FROM student WHERE sno='".$_GET['sno']."'";
                    $result=  mysqli_query($link, $query);
                    if($result){
                        $data= mysqli_fetch_row($result);
                        $sno= $data[0];
                        $sname= $data[1];
                        $sage= $data[2];
                        $ssex= $data[3];
                    }else{ ?>
                        <script>
                            alert('獲取資料失敗');
                            window.location= '/test/db_connect.php';
                        </script>
                    <?php }
                }else{
                    // 更改資料
                    $query= "UPDATE student SET sno='".$_POST['sno']."', sname='".$_POST['sname']."', sage='".$_POST['sage']."', ssex='".$_POST['ssex']."' WHERE sno='".$_GET['sno']."'";
                    $result=  mysqli_query($link, $query);
                    if($result){ ?>
                        <script>
                            alert('更改成功');
                            window.location='/test/db_connect.php';
                        </script>
                    <?php }else{ ?>
                        <script>
                            alert('更新資料失敗');
                            window.location= window.location.href;
                        </script>
                    <?php }
                }
                break;
            case "delete":
                if($_GET['delete_check'] == 'true'){
                    $query= 'DELETE FROM student WHERE sno="'.$_GET['sno'].'";';
                    $result=  mysqli_query($link, $query);
                    if($result){ ?>
                        <script>
                            alert('刪除成功');
                            window.location='/test/db_connect.php';
                        </script>
                    <?php }else{ ?>
                        <script>
                            alert('刪除失敗');
                            window.location='/test/db_connect.php';
                        </script>
                    <?php }
                }else{ ?>
                    <script>
                        if(confirm('確定要刪除嗎?')){
                            window.location='/test/db_edit.php?method=delete&delete_check=true&sno=<?=$_GET['sno']?>';
                        }else{
                            window.location='/test/db_connect.php';
                        }
                    </script>";
                 <?php }
        }
    ?>
    
    <p><a href="/test/db_connect.php"><button style="font-size:1.25rem;">回上頁</button></a></p>
    <form method="POST" style="width:100%; text-align:center;">
        <input type="hidden" name="O_sno" value="<?=$_GET['sno']?>">
        <table>
            <tbody>
                <tr>
                    <td>學號: </td>
                    <td><input name="sno" value="<?=$sno?>"></td>
                </tr>
                <tr>
                    <td>姓名: </td>
                    <td><input name="sname" value="<?=$sname?>"></td>
                </tr>
                <tr>
                    <td>年齡: </td>
                    <td><input name="sage" value="<?=$sage?>"></td>
                </tr>
                <tr>
                    <td>性別: </td>
                    <td>
                        <input type="radio" name="ssex" id="男" value="男" <?=($ssex=='男')?'checked':''?>>
                        <label for="男">男</label>
                        <input type="radio" name="ssex" id="女" value="女" <?=($ssex=='女')?'checked':''?>>
                        <label for="女">女</label>
                    </td>
                </tr>
                <tr>
                    <td colspan=2 style="text-align:center;"><button type="submit">送出</button></td>
                <tr>
            </tbody>
        </table>
    </form>
    
    </body>
</html>

