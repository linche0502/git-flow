<html>
<head>
    
</head>

<body>
    <?php echo '<h1 style="padding:50px; text-align:center;">hello php</h1>'; ?>
    <form action="/test/action.php" method="POST">
        <div style="width:100%; text-align:center; padding:2px;">
            your name: <input name="name" style="">
        </div>
        <div style="width:100%; text-align:center; padding:2px;">
            your age: <input name="age">
        </div>
        <div style="width:100%; text-align:center; padding:2px;">
            your pwd: <input type="password" name="password">
            <button type="button" id="showPw">look</button>
        </div>
        <div style="width:100%; text-align:center; padding:2px;">
            <button type="submit">送</button>
        </div>
        
    </form>
    
    <script>
        document.querySelector('#showPw').addEventListener('click', () => {
            var pwdE= document.querySelector('[name="password"]')
            pwdE.type= (pwdE.type == 'password')? "text" : "password";
        });
    </script>
</body>
</html>