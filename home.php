<html>
    <head>
        <title>PHP Test</title>
    </head>
    <body>
        <?php echo '<p>Hello World</p>'; ?>
        <form action = "action.php" method="POST">
            your name:<input type="text" name="name" /><br><br>
            your age:<input type="text" name="age" /><br><br>
            your password: <input type="password" name="password" /><button type="button" id="showPw"> look</button><br><br>
            <input type="submit" value="送出"/>
            
        </form>
        <!-- 顯示密碼 -->
        <script>
            document.querySelector('#showPw').addEventListener('click', () => {
                var pwdE= document.querySelector('[name="password"]')
                pwdE.type= (pwdE.type == 'password')? "text" : "password";
            });
        </script> 
    </body>
</html>