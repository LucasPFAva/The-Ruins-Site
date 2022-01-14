<?php
    require "../private/init.php";

    $username = "";
    if (isset($_SESSION['id']))
    {
        $username = $_SESSION['username'];
    }
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
            <!-- <div id="account-form">        # Search up a guide on how to make this properly.
                <form action="" method="post">
                    <section class="auth-header">
                        <div id="icon">Login</div>
                    </section>
                    <section class="auth-content">
                        <input type="email" name="email" id="email">
                        <input type="password" name="password" id="password">
                        <button type="submit">Login</button>
                    </section>
                    <section class="auth-footer">
    
                    </section>
                </form>
            </div> -->
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
            <form action="#">
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
                <?php if ($username != ""): ?>
                    <div class="username"><? htmlspecialchars($_SESSION['username'] ?></div>
                <?php endif; ?>
                <div class="user-icon"><a href="<?=base()?>account"><span class="fas fa-user"></span></a></div>
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
                        if ($("nav form").hasClass("active"))
                            $("nav form").removeClass("active");
                        else
                            $("nav form").addClass("active");
                    });
                </script>
            </div>
            <!-- <form role="search">
                <div class="wrapper">
                    <input id="search" placeholder="search..." type="search" autocomplete="off">
                    <button type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                    <ul id="results">

                    </ul>
                    <script src="<?=base()?>js/searchbar.js"></script>
                </div>
            </form> -->
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