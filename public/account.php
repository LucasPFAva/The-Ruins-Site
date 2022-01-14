<form method="post">
    <?php
        if(isset($SignupErrors) && count($SignupErrors) > 0) {
            foreach ($SignupErrors as $SignupError) {
                echo $SignupError . "<br>";
            }
        }
    ?>
    <div id="title">Signup</div>
    <input id="textbox" type="text" name="username" placeholder="Username" value="<?=isset($_POST['username']) ? $_POST['username'] : '';?>" required>
    <input id="textbox" type="email" name="email" placeholder="Email" value="<?=isset($_POST['email']) ? $_POST['email'] : '';?>" required>
    <input id="textbox" type="password" name="password" placeholder="Password" required>
    <input id="textbox" type="password" name="confirmpassword" placeholder="Repeat password" required>
    <input type="hidden" name="token" value="<?=$_SESSION['signuptoken']?>">
    <input type="submit" value="Signup">
    <div>Have an account?</div><a href="/">Log in</a>
</form>
<form method="post">
    <?php
        if(isset($LoginErrors) && count($LoginErrors) > 0) {
            foreach ($LoginErrors as $LoginError) {
                echo $LoginError . "<br>";
            }
        }
    ?>
    <div id="title">Login</div>
    <input id="textbox" type="text" name="username" placeholder="Username or email" required>
    <input id="textbox" type="password" name="password" placeholder="Password" required>
    <input type="hidden" name="token" value="<?=$_SESSION['logintoken']?>">
    <input type="submit" value="Login">
    <div>Don't have an account?</div><a href="/">Signup Now</a>
</form>
<a href="/logout.php">Log out</a>