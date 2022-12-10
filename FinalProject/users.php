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

?>
<main class="users">
    <?php
    // if the user asked to delete the account, delete the account
        if(isset($_GET['deletedId']) && !empty($_GET['deletedId'])){
            $deletedId = $_GET['deletedId'];
            $database->deleteRecord($deletedId);
        }
    ?>
    <div class="table_container">
        <table class="boostrap4_table_head_dark_striped">
            <!-- the title for each row of the table -->
            <thead>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Action</th>
            </thead>
            <tbody>
            <?php
            // displaying all of our records
            $users = $database->displayData();
            foreach($users as $user){
                ?>
                <tr>
                    <td><?php echo $user['id'];?></td>
                    <td><?php echo $user['fname'];?></td>
                    <td><?php echo $user['lname'];?></td>
                    <td><?php echo $user['email'];?></td>
                    <td>
                        <button class="btnEdit"><a href="edit.php?editId=<?php echo $user['id'];?>">
                                EDIT<!--<i class="fa-regular fa-user-pen"></i>-->
                            </a>
                        </button>
                        <button class="btnDelete"><a href="users.php?deletedId=<?php echo $user['id'];?>" onclick="confirm('Are you sure you wan to delete this account?')">
                                DELETE<!--<i class="fa-sharp fa-solid fa-trash"></i>-->
                            </a>
                        </button>
                    </td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
    </div>

</main>
<?php
require "./templates/footer.php";
?>