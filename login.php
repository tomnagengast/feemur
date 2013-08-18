<?php
include ('core/init.inc.php');

$errors = array();

if (isset($_POST['username'], $_POST['password'])){
    if (empty($_POST['username'])){
        $errors[] = 'The username cannot be empty.';
    }

    if (empty($_POST['password'])){
        $errors[] = 'The password cannot be empty.';
    }

    if (valid_credentials($_POST['username'], sha1($_POST['password'])) === false){
        $errors[] = 'Username / Password incorrect.';
    }

    if (empty($errors)){
        if (isset($_POST['set_cookie']) && $_POST['set_cookie'] == '1'){
            setcookie('username', $_POST['username'], time() + 604800);
            setcookie('password', sha1($_POST['password']), time() + 604800);
        }

        $_SESSION['username'] = htmlentities($_POST['username']);

        // Set the uid.
        $_SESSION['uid'] = fetch_user_id($_SESSION['username']);

        header('Location: index.php');
        die();
        // exit();
    }
}

include ('core/nav.inc.php');
?>

        <div class="container"
            <div>
                <?php

                if (empty($errors) === false){
                    ?>
                    <ul>
                        <?php

                        foreach ($errors as $error){
                            echo "<li>{$error}</li>";
                        }
                            // echo "hmmm....";
                        ?>
                    </ul>

                    <?php

                }else{
                    echo 'Need an account ? <a href="register.php">Register here</a>';
                }

                  ?>
            </div>
            <div id="login-form-wrap">
                <div class="feemur">
                    <a class='block' href="#"></a>
                </div>
                <div id="av-content" class='line'>
                    <div class='signup-wrap lastUnit'>
                        <form action="" method="post">
                            <p>
                                <label for="username">Username:</label>
                                <input type="text" name="username" id="username" value="<?php if (isset($_POST['username'])) echo htmlentities($_POST['username']); ?>"/>
                            </p>
                            <p>
                                <label for="password">Password:</label>
                                <input type="password" name="password" id="password" />
                            </p>
                            <p>
                                <label for="set_cookie">Keep me logged in:</label>
                                <input type="checkbox" name="set_cookie" id="set_cookie" value="1" />
                            </p>
                            <p>
                                <input type="submit" value="login" />
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
<?php
include ('core/footer.inc.php');
?>