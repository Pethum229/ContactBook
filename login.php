<?php
$page_id =2;
include_once "inc_header.php";
$show_regform = FALSE;

if (isset($_POST['sent'])){

    // Registration Form
    if ($_POST['sent']=="REGISTER"){

        $show_regform = TRUE;
        $msg = "";

        // Username Validation
        $_POST['uname'] = htmlspecialchars(trim($_POST['uname']),ENT_QUOTES,'UTF-8');
        if (empty($_POST['uname'])) $msg.="Your name cannot be empty <br>";

        // Password Valdation
        if (empty($_POST['passwd1']) || empty($_POST['passwd2'])) $msg.="Password cannot be empty <br>";
        elseif ($_POST['passwd1'] != $_POST['passwd2']) $msg.="Passwords do not match <br>";

        // Email Validation
        $_POST['email'] = trim($_POST['email']);
        if (empty($_POST['email'])) $msg.="Email cannot be empty<br>";
        elseif (!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)) $msg.="Email address is not valid <br>";
        
        // db operations
        if ($msg ==""){
            try{  
                // connect to db
                include "db_connection.php";
                
                // Check for existing email
                $check = $db->prepare("SELECT `id` FROM `users` WHERE `email`=?");
                $check -> execute(array($_POST['email']));

                if ($check->rowCount()>0) $msg.="Email address you entered is registered already";
                else{
                    // Insert User
                    $pwd = password_hash($_POST['passwd1'],PASSWORD_DEFAULT);
                    
                    $ok = $db -> prepare("INSERT INTO `users` (`name`,`email`,`password`) VALUES (?,?,?)")->execute(array($_POST['uname'],$_POST['email'],$pwd));
                    
                    if ($ok) header("location:login.php?registered=1");
                    else $msg.="Something is wrong! Please contact website admin <br>";
                }

            }catch (PDOException $e){
                $msg.=$e->getMessage();
            }
        }
    }
    // Login Form
    elseif ($_POST['sent']=="LOGIN") {
        // Password Validation
        if (empty($_POST['passwd'])) $msg.="Passwords cannot be empty<br>";

        // Email Validation
        $_POST['email'] = trim($_POST['email']);
        if (empty($_POST['email'])) $msg.="Email cannot be empty<br>";
        elseif (!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)) $msg.="Email address is not valid <br>";

        // db operations
        if ($msg ==""){
            try{  
                // connect to db
                include "db_connection.php";

                // Check for registered user
                $check = $db->prepare("SELECT `id`,`name`,`password` FROM `users` WHERE `email`=?");
                $check ->execute(array($_POST['email']));

                if ($check->rowCount()>0){
                    if ($result = $check->fetch()){
                        // Password Verification
                        if (password_verify($_POST['passwd'],$result['password'])){
                            // Set session variables
                            $_SESSION['id']= $result['id'];
                            $_SESSION['name']= $result['name'];
                            // Redirect to homepage
                            header("location:index.php");
                        }else $msg.="Password you entered is incorrect";

                    }
                }else $msg.="Email address you entered is not registered";
                
            }catch (PDOException $e){
                $msg.=$e->getMessage();
            }
        }
    }
}
?>
    <title>Login/Registration</title>


    <style>

        #msg{
            display: none;
            padding: 5px 0;
            margin: 5px 0;
            min-height: 30px;
            width: 100%;
            text-align: center;
        }
        .err{
            background: #d11919;
            color: #fff;
        }
        #okmsg{
            display: block;
            padding: 5px 0;
            margin: 5px 0;
            min-height: 30px;
            width: 100%;
            text-align: center;
            background: #459e19;
            color: #fff;
        }

    <?php
        if ($show_regform) echo "#reg{display:block} #log{display:none}";
        else echo "#reg{display:none}";

        if ($msg!="") echo "#msg{display:block}";
    ?>

        h2{
            color: #fff;
            text-transform: uppercase;
            font-size: 1.2em;
        }
        form{
            width: 500px;
            box-shadow: 0 0 3px #000;
            overflow: hidden;
            padding: 50px 20px;
        }
        .wrap{
            width: 540px;
            margin: 10px auto;
        }
        .item{
            width: 40%;
            display: block;
            float: left;
            color: #fff;
            padding: 5px 0;
        }
        .row{
            width: 100%;
            float: left;
            font-size: 1.1em;
            margin-bottom: 5px;
        }
        .in1{
            width: 57%;
            padding: 5px 1%;
            background: #ebe5e5;
            border: 1x solid #ccc;
            font-family: 'Open Sans', sans-serif;
        }
        .in2{
            width: 99%;
            background: #f3b918;
            color: #000;
            font-family: 'Open Sans', sans-serif;
            font-size: 1.1em;
            border: 0;
            padding: 10px 0;
            margin: 20px .5% 0;
            box-shadow: 0 0 3px #000;
        }
        .in2:hover{
            background: #f27609;
        }
        .link{
            color: #f27609;
            padding: 10px 0;
            cursor: pointer;
        }
        

        /* Media Quaries */

        @media screen and (max-width:580px) {
            .wrap{
                width: 90%;
                margin: 10px 2%;
            }
            form{
                width: 96%;
                padding: 50px 2%;
                margin: 0 2%;
            }
        }

        @media screen and (max-width:445px) {
            form{
                padding: 15px 2%;
            }
            .item{
                width: 100%;
            }
            .in1{
                width: 96%;
            }
        }

        @media screen and (max-width:320px) {
            .wrap{
                width: 310px;
                margin: 10px 5px;
            }
        }

    </style>
</head>
<body>
    <main>
    <header>
        <h1>Contact Book</h1>
    </header>
    <?php
        if (isset($_GET['registered']) && $_GET['registered']==1) echo "<div id='okmsg'>You have registered successfully.</div>";
    ?>
    <div id="msg" class="err">
        <?php
            if ($msg!="") echo $msg;
        ?>
    </div>
    <div class="wrap" id="log">
        <h2>Login</h2>
        <form name="loginform" onsubmit="return validateLogin()" method="POST">
            <label class="row">
                <span class="item">Email</span>
                <input type="email" class="in1" required name="email" value="<?php if (isset($_POST['sent']) && $_POST['sent']=="LOGIN" && !empty($msg)) echo $_POST['email']; ?>">
            </label>
            <label class="row">
                <span class="item">Password</span>
                <input type="password" class="in1" required name="passwd">
            </label>
            <div class="row">
                <input type="submit" value="LOGIN" class="in2" name="sent">
            </div>
        </form>
        <div class="link" onclick="show('reg')">Don't you have an account? Register</div>
    </div>
    <div class="wrap" id="reg">
        <h2>Register</h2>
        <form onsubmit="return validateRegister()" method="POST" name="registerform">
            <label class="row">
                <span class="item">Your Name</span>
                <input type="text" class="in1" required name="uname" maxlength="20" value="<?php if (isset($_POST['uname'])) echo $_POST['uname'] ?>">
            </label>
            <label class="row">
                <span class="item">Email</span>
                <input type="email" class="in1" required name="email" maxlength="60" value="<?php if (isset($_POST['email'])) echo $_POST['email'] ?>">
            </label>
            <label class="row">
                <span class="item">Password</span>
                <input type="password" class="in1" required name="passwd1" maxlength="50">
            </label>
            <label class="row">
                <span class="item">Re-Enter Password</span>
                <input type="password" class="in1" required name="passwd2" maxlength="50">
            </label>
            <div class="row">
                <input type="submit" value="REGISTER" class="in2" name="sent">
            </div>
        </form>
        <div class="link" onclick="show('log')">Do you already have an account? Login</div>
    </div>

    <script>
        function show(v){
            if (v == 'log'){
                document.getElementById('reg').style.display='none';
                document.getElementById('log').style.display='block';
            }else{
                document.getElementById('reg').style.display='block';
                document.getElementById('log').style.display='none';
            }
        }

        // Validate Login Form

        function validateLogin(){
            console.log('Error Test');
            var msg = "";

            // Email Validation

            var email = document.forms["loginform"]["email"].value;
            console.log (email);

            var at_symbol = email.indexOf("@");
            var last_dot = email.lastIndexOf(".");

            if (last_dot<at_symbol) msg += "Email is Invalid<br>";

            // Display Messages
            if (msg !== ""){
                document.getElementById("msg").style.display="block";
                document.getElementById("msg").innerHTML=msg;

                return false;
            }
        }

        // Validate Registration Form

        function validateRegister(){
            var msg = "";

            // Email Validation

            var email = document.forms["registerform"]["email"].value;

            var at_symbol = email.indexOf("@");
            var last_dot = email.lastIndexOf(".");

            if (last_dot<at_symbol) msg += "Email is Invalid<br>";

            // Password Validation

            var pwd1 = document.forms["registerform"]["passwd1"].value;
            var pwd2 = document.forms["registerform"]["passwd2"].value;

            if (pwd1 !== pwd2){
                msg += "Password does not match with confirm password<br>";
            }

            // Username

            var user_name = document.forms["registerform"]["uname"].value;

            if (user_name.trim() == "") msg += "Name is invalid<br>";

            // Display Messages
            if (msg !== ""){
                document.getElementById("msg").style.display="block";
                document.getElementById("msg").innerHTML=msg;

                return false;
            }
        }
    </script>
<?php include_once "inc_footer.php" ?>