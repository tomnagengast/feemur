<?php

include ('core/init.inc.php');

$errore = array();

if (isset($_POST['username'], $_POST['password'], $_POST['repeat_password'])){
  if (empty($_POST['username'])){
    $errors[] = 'The username cannot be empty.';
  }

  if (empty($_POST['password']) || empty($_POST['repeat_password'])){
    $errors[] = 'The password cannot be empty.';
  }

  if ($_POST['password'] !== $_POST['repeat_password']){
    $errors[] = 'Password verification failed.';
  }

  if (user_exists($_POST['username'])){
    $errors[] = 'The username you entered is already taken.';
  }

  if (empty($errors)){
    add_user($_POST['username'], $_POST['password']);

    $_SESSION['username'] = htmlentities($_POST['username']);

    header('Location: index.php');
    die();
  }
}

include ('core/nav.inc.php');
?>
    <div>
      <?php

      if (empty($errors) == false){
        ?>
        <ul>
        <?

        foreach ($errors as $error){
          echo "<li>{$error}</li>";
        }

        ?>
      </ul>
      <?
      }

      ?>
    </div>
    <form action="" method="post">
      <p>
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" value="<?php if (isset($_POST['username'])) echo htmlentities($_POST['username']) ?>" />
      </p>
      <p>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" />
      </p>
      <p>
        <label for="repeat_password">Repeat Password:</label>
        <input type="password" name="repeat_password" id="password" />
      </p>
      <p>
        <input type="submit" value="Let's do this!" />
      </p>
    </form>
<?php
include ('core/footer.inc.php');
?>