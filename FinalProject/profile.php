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
    $id = $_SESSION['id'];
    require "./templates/header.php";
?>
<main>
    <section class="profile">
        <?php $database->profileMP();?>
        </form>
    </section>
    <?php
    if(isset($_POST['editProfile'])){
        //edit the information for the account. the password can only be changed in this page
        ?>
        <section class="editProfile">
            <form  method='POST' action='' enctype='multipart/form-data'>
                <p><input type='file' name='file' /></p> <!-- by default it only allows you to upload one file -->
                <div>
                    <input type="text" name="fname" placeholder="First Name"/>
                    <input type="text" name="lname" placeholder="Last Name"/>
                </div>
                <input type="email" name="email" placeholder="Email"/>
                <input type="password" name="pword" placeholder="Password"/>
                <input type="password" name="confirmPWord" placeholder="Conirm Password"/>
                <input type="submit" name="makeChanges" value="Make Changes"/>
            </form>
        </section>
        <?php  } if(isset($_POST['makeChanges'])){$database->editProfile($id);} ?>
</main>
<?php
require "./templates/footer.php";
?>