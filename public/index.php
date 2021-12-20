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
            <form role="search">
                <div class="wrapper">
                    <input id="search" placeholder="search..." type="search" autocomplete="off">
                    <button type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                    <ul id="results">
                        <!-- Search Results -->
                    </ul>
                    <script src="<?=base()?>js/searchbar.js"></script>
                </div>
            </form>
            <ul id="menu">
                <li class="menu-item"><a href="<?=base()?>">Home</a></li>
                <li class="menu-item"><a href="<?=base()?>characters">Characters</a></li>
                <li class="menu-item"><a href="<?=base()?>accessories">Accessories</a></li>
            </ul>
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