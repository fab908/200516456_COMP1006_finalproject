<?php
    $title = 'Sign up';
    $description = 'sign up for your new account here !';
    require_once 'database.php';
    $database = new Database();
    $database->connect();

?>
    <!doctype html>
    <!-- we will close the html element in our footer template -->
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- create a dynamic title -->
        <title><?php $title =""; echo $title;?></title>
        <!-- create a dynamic description -->
        <meta name="description" content="<?php echo $description;?>">
        <meta name="robots" content="noindex, nofollow">
        <!-- add our CSS -->
        <link rel="stylesheet" href="./css/style.css">
    </head>
    <!-- the body element will be closed in our footer template -->
    <body class="login">
        <main>
            <!-- this will be the main section of the page including the logo as well as the login form -->
            <section>
                <!-- background image will be inputted for this div in css -->
                <div>
                </div>
                <!-- form side -->
                <div>
                    <img src="./img/logo.png" alt="Logo">
                    <form method="POST">
                        <p><input type="email" name="email" placeholder="Email" required></p>
                        <p><input type="password" name="password" placeholder="Password" required></p>
                        <input type="submit" name="signIn" value="Sign-In">
                        <?php
                        $database->signIn();
                        ?>
                    </form>
                    <p>Dont Have An Account?</p>
                    <a href="register.php"><input type="submit" value="Register"></a>

                </div>
            </section>
        </main>
<?php
// adding the footer
require "./templates/footer.php";
?>