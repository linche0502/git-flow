<!doctype html>
<html>
    <head>
        <style>
            td{
                outline: 1 solid;
                text-align:center;
                padding: 5px;
            }
        </style>
    </head>
    <body>
    <h1 style="padding:50px; text-align:center;">php connect DB</h1>
    
    
    <?php 
        $link= mysqli_connect("127.0.0.1","root","01234567","testdb") or die("connect error:".mysqli_error());
        $query= "SELECT * FROM student";
        $result= mysqli_query($link, $query) or die("send error".mysqli_error());
    ?>
    
    <p style="text-align:end; padding-right:1rem;"><a href="/test/db_edit.php?method=add"><button style="font-size:1.25rem;">新增</button></a></p>
    <table style="width:100%;">
        <thead>
            <tr style="font-size:1.5rem;">
                <td>號碼</td>
                <td>姓名</td>
                <td>年齡</td>
                <td>性別</td>
                <td style="width:8rem;"></td>
            </tr>
        </thead>
        <tbody>
            <?php while($row= mysqli_fetch_array($result)){ ?>
                <tr>
                    <td><?=$row['sno']?></td>
                    <td><?=$row['sname']?></td>
                    <td><?=$row['sage']?></td>
                    <td><?=$row['ssex']?></td>
                    <td>
                        <a href="/test/db_edit.php?method=update&sno=<?=$row['sno']?>"><button>編輯</button></a>
                        <a href="/test/db_edit.php?method=delete&sno=<?=$row['sno']?>"><button>刪除</button></a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    
    
    </body>
</html>

