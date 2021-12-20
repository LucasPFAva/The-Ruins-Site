<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?=base()?>style.css">
    <link rel="shortcut icon" href="images/logo_200x200.png" type="image/x-icon">
    <script src="https://kit.fontawesome.com/4b39a549d2.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <!-- Eventually add a proper icon. Most likely the same icon which will be used for the application(.exe) file. -->
</head>
<body>
    <header>
        <nav>
            <form role="search" id="search-form">
                <input type="search">
                <button type="submit">
                    <i class="fas fa-search fa-2x"></i>
                </button>
                <ul id="suggestions">
                    <!-- Search Results -->
                </ul>
                <script>
                    $('#search-form input').keypress(function (e) { 
                        let searchData = $('#search-form input').val();
                        $('#suggestions').html('');

                        for (i = 0; i < 10; i++) {
                            let element = document.createElement('li');
                            if (i == 0)
                                element.innerHTML = searchData;
                            else
                                element.innerHTML = i;
                            $('#suggestions').append(element);
                        }
                        if (e.which == 13) {
                            console.log(searchData)
                        }
                    });
                </script>
            </form>
            <ul id="menu">
                <li class="menu-item"><a href="<?=base()?>home">Home</a></li>
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
                $URL = explode("/", $_SERVER['QUERY_STRING']);
                if(file_exists($URL[0].".php")){
                    require_once($URL[0].".php");
                }else{
                    require_once("404.php");
                }
            ?>
        </article>
    </main>
    <footer>
        <p>Copyright &copy; 2021 Lucas Pihl Fredriksson. All Rights Reserved</p>
    </footer>
</body>
</html>