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
$img = "null";
require "./templates/header.php";
?>
<main class="edit">
    <section>
        <!-- form side -->
        <div>
            <h1>Update Profile</h1>
            <!-- form to update the user information -->
            <!-- each input already has the information in the box from the account -->
            <form method="POST">
                <p><input type="text" name="fname" value="<?php echo $database->getCredentialFromID($_GET['editId'], 'fname'); ?>" required></p>
                <p><input type="text" name="lname" value="<?php echo $database->getCredentialFromID($_GET['editId'], 'lname'); ?>" required></p>
                <p><input type="email" name="email" value="<?php echo $database->getCredentialFromID($_GET['editId'], 'email'); ?>" required></p>
                <input type="submit" name="update" value="Update">
            </form>
        </div>
    </section>
    <?php
    //if they pressed the update button then update with the info from the form above
    if(isset($_POST['update'])){
        $database->editProfile($_GET['editId']);
    }
    ?>
</main>
<?php
require "./templates/footer.php";
?>