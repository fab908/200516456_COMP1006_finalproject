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
<body class="register">
    <main>
        <!-- this will be the main section of the page including the logo as well as the login form -->
        <section>
            <!-- background image will be inputted for this div in css -->
            <div>
            </div>
            <!-- form side -->
            <div>
                <a href="index.php"><img src="./img/logo.png" alt="Logo"></a>
                <form method="POST">
                    <p><input type="text" name="fname" placeholder="First Name" required></p>
                    <p><input type="text" name="lname" placeholder="Last Name" required></p>
                    <p><input type="email" name="email" placeholder="Email" required></p>
                    <p><input type="password" name="password" placeholder="Password" required></p>
                    <p><input type="password" name="confirmPassword" placeholder="Confrim Password" required></p>
                    <?php
                    if(isset($_POST['register'])){
                        $database->createAccount();
                    }
                    ?>
                    <input type="submit" name="register" value="Register">
                </form>
                <a href="index.php"><input type="submit" value="Go Back"></a>
            </div>
        </section>
    </main>
<?php
// adding the footer
require "./templates/footer.php";
?>