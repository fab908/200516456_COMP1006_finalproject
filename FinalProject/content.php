<?php
    session_start();
    // requiring to use the database
    require_once 'database.php';
    // creating a new instance of the database
    $database = new Database();
    // connecting
    $database->connect();
    // checking if the user is signed in
    $database->notSignedIn();
    require "./templates/header.php";
    // if the editProfile button was pressed
    if(isset($_POST['editProfile'])){
        // send them to the profile page
        header("Location: profile.php");
    }
    // if the publish button was pressed
    if(isset($_POST['publish'])){
        // send them bakc to the content page
        Header("Location: content.php");
    }
?>
<main class="content">
    <section>
    <?php
    // if the make post button hasnt been pressed, show all of the posts in the database
        if(!isset($_POST['makePost'])){
            $database->showPosts();
        }
        // if they did press makePost
        if(isset($_POST['makePost'])){
            // show this form to submit the credentials for a post
    ?>
        <form  class="makePost" method='POST' action='' enctype='multipart/form-data'>
            <p><input type='file' name='image' /></p> <!-- by default it only allows you to upload one file -->
            <input type="text" name="description" placeholder="Description"/>
            <input type="submit" name="publish" value="Publish"/>
        </form>
    <?php }
        // then put the post into the database where it will be show on the top of the feed
            $database->createPost();
        ?>
    </section>
    <section>
        <?php
        // if the user hasnt pressed editProfile, show the little bit of the profile
        // on the main page
            if(!isset($_POST['editProfile'])){
                $database->profileMP();
            }
            ?>
        <form>
            <!-- gives you the option to make a post -->
        <input type="submit" name="makePost" value="Make a Post">
        </form>
    </section>
</main>
<?php
    require "./templates/footer.php";
?>