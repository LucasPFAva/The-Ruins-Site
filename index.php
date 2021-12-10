<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?=base()?>style.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="<?=base()?>home">Home</a></li>
                <li><a href="<?=base()?>characters">Characters</a></li>
                <li><a href="<?=base()?>accessories">Accessories</a></li>
            </ul>
        </nav>
    </header>
    <?php
        function base(){ // References the source directory.
            echo str_replace("index.php","",$_SERVER['PHP_SELF']);
        }
        $URL = explode("/", $_SERVER['QUERY_STRING']);
        if(file_exists($URL[0].".php")){
            require_once($URL[0].".php");
        }else{
            require_once("404.php");
        }
    ?>
</body>
</html>