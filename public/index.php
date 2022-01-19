<?php
    require "../private/init.php";

    $username = "";
    if (isset($_SESSION['id']))
    {
        $username = $_SESSION['username'];
    }

    if (count($_POST) > 0 && isset($_POST['token']) && isset($_SESSION['signuptoken']) && isset($_SESSION['logintoken']))
    {
        $User = new User();

        if ($_SESSION['signuptoken'] == $_POST['token']) {
            $SignupErrors = $User->create($_POST);
            if (is_array($SignupErrors) && count($SignupErrors) == 0)
            {
                $LoginErrors = $User->login($_POST);
                if (is_array($LoginErrors) && count($LoginErrors) == 0)
                {
                    header("Location: home");
                    die;
                }
            }
        }
        if ($_SESSION['logintoken'] == $_POST['token']) {
            $LoginErrors = $User->login($_POST);
            if (is_array($LoginErrors) && count($LoginErrors) == 0)
            {
                header("Location: home");
                die;
            }
        }
    }

    $_SESSION['signuptoken'] = 'signup'; // get_random_string(60);
    $_SESSION['logintoken'] = 'login'; // get_random_string(60);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?=base()?>css/style.css">
    <link rel="shortcut icon" href="images/logo_200x200.png" type="image/x-icon">
    <script src="https://kit.fontawesome.com/4b39a549d2.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <!-- Eventually add a proper icon. Most likely the same icon which will be used for the application(.exe) file. -->
</head>
<body>
    <header>
        <nav>
            <div id="icon">The Ruins</div>
            <ul id="menu">
                <section class="mobile-header">
                    <div id="icon">The Ruins</div>
                    <div class="cancel-icon">
                        <i class="fas fa-times"></i>
                    </div>
                </section>
                <li class="menu-item"><a href="<?=base()?>">Home</a></li>
                <li class="menu-item"><a href="<?=base()?>characters">Characters</a></li>
                <li class="menu-item"><a href="<?=base()?>accessories">Accessories</a></li>
                <script>
                    $(".cancel-icon").click(function (e) { 
                        e.preventDefault();
                        if ($("#menu").hasClass("active"))
                            $("#menu").removeClass("active");
                        else
                            $("#menu").addClass("active");
                    });
                </script>
            </ul>
            <form id="searchbar" role="search">
                <input type="search" id="search" class="search-data" placeholder="Search..." autocomplete="off" required>
                <button type="submit" class="fas fa-search"></button>
                <ul id="results">
                    <!-- Search Results -->
                </ul>
                <script src="<?=base()?>js/searchbar.js"></script>
            </form>
            <div id="mobile">
                <div class="search-icon"><span class="fas fa-search"></span></div>
                <div class="menu-icon"><span class="fas fa-bars"></span></div>
                <section id="user">
                    <div class="user-icon"><span class="fas fa-user"></span></div>
                    <?php if ($username != ""): ?>
                        <div id="username"><?=htmlspecialchars($_SESSION['username']) ?></div>
                    <?php endif; ?>
                </section>
                <script>
                    $(".menu-icon").click(function (e) { 
                        e.preventDefault();
                        if ($("#menu").hasClass("active"))
                            $("#menu").removeClass("active");
                        else
                            $("#menu").addClass("active");
                    });
                    $(".search-icon").click(function (e) { 
                        e.preventDefault();
                        if ($("#searchbar").hasClass("active"))
                            $("#searchbar").removeClass("active");
                        else
                            $("#searchbar").addClass("active");
                    });
                    $(".user-icon").click(function (e) { 
                        e.preventDefault();
                        if ($("#authform").hasClass("active"))
                            $("#authform").removeClass("active");
                        else
                            $("#authform").addClass("active");
                    });
                </script>
            </div>
            <div id="authform">
                <section id="error">
                <?php
                    if(isset($SignupErrors) && count($SignupErrors) > 0) {
                        foreach ($SignupErrors as $SignupError) {
                            echo $SignupError . "<br>";
                        }
                    }
                    if(isset($LoginErrors) && count($LoginErrors) > 0) {
                        foreach ($LoginErrors as $LoginError) {
                            echo $LoginError . "<br>";
                        }
                    }
                ?>
                </section>
                <form id="signupform" method="post">
                    <div class="title">Signup</div>
                    <input type="text" name="username" placeholder="Username" value="<?=isset($_POST['username']) ? $_POST['username'] : '';?>" required>
                    <input type="email" name="email" placeholder="Email" value="<?=isset($_POST['email']) ? $_POST['email'] : '';?>" required>
                    <input type="password" name="password" placeholder="Password" required>
                    <input type="password" name="confirmpassword" placeholder="Repeat password" required>
                    <input type="hidden" name="token" value="<?=$_SESSION['signuptoken']?>">
                    <input type="submit" value="Signup">
                    <div class="authtoggle">Have an account?</div>
                </form>
                <form class="active" id="loginform" method="post">
                    <div class="title">Login</div>
                    <input type="text" name="username" placeholder="Username or email" required>
                    <input type="password" name="password" placeholder="Password" required>
                    <input type="hidden" name="token" value="<?=$_SESSION['logintoken']?>">
                    <input type="submit" value="Login">
                    <div class="authtoggle">Don't have an account?</div>
                </form>
                <a id="logout" href="<?=base()?>logout.php">Logout</a>
                <script>
                    $(".authtoggle").click(function (e) { 
                        e.preventDefault();
                        if ($("#loginform").hasClass("active")) {
                            $("#loginform").removeClass("active");
                            $("#signupform").addClass("active");
                        }
                        else {
                            $("#signupform").removeClass("active");
                            $("#loginform").addClass("active");
                        }
                    });
                </script>
            </div>
        </nav>
    </header>
    <main>
        <article>
            <?php
                function base(){ // References the source directory.
                    echo str_replace("index.php","",$_SERVER['PHP_SELF']);
                }
                if ($_SERVER['QUERY_STRING'] ?? ''){
                    $URL = explode("/", $_SERVER['QUERY_STRING']);
                    if(file_exists($URL[0].".php")){
                        require_once($URL[0].".php");
                    }else{
                        require_once("404.php");
                    }
                }else{
                    require_once("home.php");
                }
            ?>
        </article>
    </main>
    <footer>
        <p>Copyright &copy; 2021 Lucas Pihl Fredriksson. All Rights Reserved</p>
    </footer>
</body>
</html>