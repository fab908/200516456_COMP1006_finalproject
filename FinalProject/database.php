<?php
class Database{
    // creating variables for the connection
    private $dbServerName = "localhost";
    private $dbUsername = "root";
    private $dbPassword = "";
    private $dbDatabase = "finalproject";
    private $dbPort = 4306;
    public $con;


    public function connect(){
        //making the connection
        $this->con = new mysqli($this->dbServerName, $this->dbUsername, $this->dbPassword, $this->dbDatabase, $this->dbPort);
        // if it didnt connect then display it
        if(mysqli_connect_error()){
        trigger_error("Failed to connect: " . mysqli_connect_error());
        }else{
            return $this->con;
        }
    }
    /*
     *      This fucntion will be responsisble for creating the account
     *          first it checks if the button register has been clicked.
     *          it will then collect all of the data from the form that was submitted
     *          then it will search for the email submitted in the database, if the email was there it would tell the
     *          user. If there was no email in the database check if the password and confirmed password is the same
     *          then it will hash the password, and store it into the database and redirect you to the content page
     */
    public function createAccount(){
        if(isset($_POST['register'])){
            // storing the data into variables
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $confirmPassword = $_POST['confirmPassword'];
            // checking if the email has been used
            $query = "SELECT id FROM accounts WHERE email = '$email'";
            // executing the query
            $result = $this->con->query($query);
            // counting how many rows have the email
            $count = $result->num_rows;
            // if there is no account with that email and if the passwords are the same
            if($count == 0){
                if($password == $confirmPassword){
                    $result = $result->fetch_assoc();
                    $_SESSION['id'] = $result['id'];
                    session_start();
                    // hash the password
                    $password = hash('sha512', $password);
                    // sql query to enter the information into the database
                    $query = "INSERT INTO accounts(fname,lname,email,password) VALUES('$fname','$lname','$email','$password')";
                    //actually submitting the query
                    $result = $this->con->query($query);
                    // getting the id number associated with the account created
                    $query = "SELECT * FROM accounts WHERE email = '$email' AND password = '$password' AND lname = '$lname' AND fname = '$fname'";
                    $result = $this->con->query($query);

                    $result = $result->fetch_assoc();
                    $id = $result['id'];
                    //if its true you get redirected
                    if($result == true){
                        $query = "SELECT id FROM accounts WHERE email = '$email' AND password = '$password' AND lname = '$lname' AND fname = '$fname'";
                        $result = $this->con->query($query);
                        $result = $result->fetch_assoc();
                        $_SESSION['id'] = $result['id'];
                        // append the id number
                        $url = "content.php";
                        Header("Location: " . $url);
                        return true;
                    }else{
                        ?>
                        <p>Could not create the account. Please Try Again Later</p>
                        <?php
                    }
                }else{
                    // else if the passwords do not match let the user know
                    ?>
                    <p>Passwords Do Not Match</p>
                    <?php
                }
            }else{
                // else if the email is already in the system let the user know
                ?>
                <p>Email already exists.</p>
                <?php
            }
        }
    }
    public function getAccountCredentials($credential){
        // getting the id from the session
        $id = $_SESSION['id'];
        // selecting all from the account with the id from session
        $query = "SELECT * FROM accounts WHERE id = '$id'";
        // submit the query
        $result = $this->con->query($query);
        // gather the information
        $result = $result->fetch_assoc();
        // return the credential asked for
        $returnValue = $result[$credential];
        return $returnValue;
    }
    // same as above except you enter the id youre looking for
    public function getCredentialFromID($id, $credential){
        $query = "SELECT * FROM accounts WHERE id = '$id'";
        $result = $this->con->query($query);
        $result = $result->fetch_assoc();
        $returnValue = $result[$credential];
        return $returnValue;
    }
    public function signIn(){
        // if the sign in button was pressed
        if(isset($_POST['signIn'])) {
            // storing the data into variables
            $email = $_POST['email'];
            $password = $_POST['password'];
            $password = hash("sha512", $password);
            // check if the email and hashed password is in the system
            $query = "SELECT * FROM accounts WHERE email = '$email' AND password = '$password'";
            $result = $this->con->query($query);
            // counting how many rows have the email
            $count = $result->num_rows;
            // if we found the login information
            if($count == 1){
                foreach($result as $row){
                    // start the sesssion
                    session_start();
                    // get the id from the database
                    $id = $row['id'];
                    // input the id in session
                    $_SESSION['id'] = $id;
                }
                // append the id number
                $url = "content.php?id=$id";
                Header("Location: " . $url);
                return true;
            }else{
                // if it didnt find the login information output this message
                ?>
                <p>Wrong email or password</p>
                <?php
            }
        }

    }
    public function notSignedIn(){
        // if there is no id in the session, send them to the logout page
        if(!isset($_SESSION['id'])){
            header('Location:logout.php');
        }
    }
    // main page profile
    public function profileMP(){
        // if the user has an image set
        if ($this->getAccountCredentials('image') != '') {
            // use the image
            ?>
            <img src="<?php echo $this->getAccountCredentials('image'); ?>" alt="profile picture"><?php
        } else { // if not use the default profile picture?>
        <img src="./img/empty-profile.jpeg" alt="profile picture">
            <?php } ?>
        <div>
            <!-- showing the first and last name -->
            <p><?php echo $this->getAccountCredentials('fname') . " " . $this->getAccountCredentials('lname'); ?></p>
        </div>
            <!-- showing the email -->
        <p><?php echo $this->getAccountCredentials('email'); ?></p>
        <!-- giving the option to edit the profile -->
        <form method="POST">
            <input type="submit" name="editProfile" value="Edit">
            <?php
    }
    public function editProfile($id){
        if(isset($_POST['makeChanges']) || isset($_POST['update'])) {
            // if something was posted, replace it with the new input
            if ($_POST['fname'] != "") {
                $fname = $_POST['fname'];
            } else {
                // else keep it the old input
                $fname = $this->getAccountCredentials('fname');
            }
            // if something was posted, replace it with the new input
            if ($_POST['lname'] != "") {
                $lname = $_POST['lname'];
            } else {
                // else keep it the old input
                $lname = $this->getAccountCredentials('lname');
            }
            // if something was posted, replace it with the new input
            if ($_POST['email'] != "") {
                $email = $_POST['email'];
            } else {
                // else keep it the old input
                $email = $this->getAccountCredentials('email');
            }
            // if something was posted, replace it with the new input
            if ($_POST['pword'] != "" && $_POST['pword'] == $_POST['confirmPWord']) {
                $password = $_POST['pword'];
                $password = $password = hash('sha512', $password);
            } else {

                // else keep it the old input
                $password = $this->getAccountCredentials('password');
            }

            // if something was posted, replace it with the new input
            if(isset($_FILES['file']['name'])) {
                $path = './img/uploads/'.$_FILES['file']['name'];
                // move the picture to the uploads folder
                // getting the extension
                $file_extension = pathinfo($path, PATHINFO_EXTENSION);
                // converting the path all to lowercase
                $file_extension = strtolower($file_extension);
                //valid extensions
                $valid_extensions = array('png', 'jpeg', 'jpg');
                if(in_array($file_extension, $valid_extensions)){
                    move_uploaded_file($_FILES['file']['tmp_name'], $path);
                }
                if($path == "./img/uploads/") {
                    //if the path doesn't have the uploaded picture extension then submit the old path
                    $path = $this->getAccountCredentials('image');
                }
            }
            $query = "UPDATE accounts SET fname = '$fname',lname = '$lname' ,email = '$email', image = '$path', password = '$password' WHERE id='$id'";
            $statement = $this->con->query($query);
            if(isset($_POST['makeChanges']) && $statement) {
                $url = "profile.php?id=$id";
            }else{
                if($statement){
                    $id = $_SESSION['id'];
                    $url = "users.php?id=$id?msg1=true";
                }
            }
            Header("Location: " . $url);
        }
    }

    public function createPost(){
        // getting the id from the session
        $id = $_SESSION['id'];
        $path = "";
        $description = "";
        // if the publish button was pressed
        if(isset($_POST['publish'])){
            // get the path for the image
            $path = './img/uploads/'.$_FILES['image']['name'];
            // move the picture to the uploads folder
            // getting the extension
            $file_extension = pathinfo($path, PATHINFO_EXTENSION);
            // converting the path all to lowercase
            $file_extension = strtolower($file_extension);
            //valid extensions
            $valid_extensions = array('png', 'jpeg', 'jpg');
            if(in_array($file_extension, $valid_extensions)){
                move_uploaded_file($_FILES['image']['tmp_name'], $path);
            }
            if(isset($_POST['description'])){
                $description = $_POST['description'];
            }
            // enter it into the database
            $query = "INSERT INTO posts (account_id,image,description) VALUES ('$id','$path' ,'$description')";
            $statement = $this->con->query($query);
        }

    }
    public function showPosts(){
        // getting the image, description, the comments, email, and profile picture from table accounts and table posts
        $query = "SELECT image, description, comment1, comment2, comment3, comment4, 
	                    (SELECT email
	                    FROM accounts
                        WHERE p.account_id = id) as email,
                        (SELECT image
                         FROM accounts
                         WHERE p.account_id = id) as profilePicture
                    FROM posts AS p
                    ORDER BY post_id DESC";
        //submitting the query
        $results = $this->con->query($query);
        //for every post there is
        foreach($results as $display){
            // if the profile picture is not null
            if($display['profilePicture'] != null){
                // use the profile picture
                $profilePicture = $display['profilePicture'];
            }else{
                // if there is no profile picture use the default
                $profilePicture = './img/empty-profile.jpeg';
            }
            // getting the information from the sql query
            $image = $display['image'];
            $username = $display['email'];
            $description = $username . ': '  . $display['description'];
            $comment1 = $display['comment1'];
            $comment2 = $display['comment2'];
            $comment3 = $display['comment3'];
            $comment4 = $display['comment4'];
            // using those variables in the template for the posts
            require './templates/postTemplate.php';
}
    }
    public function displayData(){
        // selecting all from the accounts table
        $query = "SELECT * FROM accounts";
        $result = $this->con->query($query);
        // if there were results found
        if($result->num_rows > 0){
            $data = array();
            //display the data from each row
            while($row = $result->fetch_assoc()){
                $data[] = $row;
            }
            // return ech row
            return $data;
        }else{
            echo "No Users Were Found";
        }
    }
    //delete function
    public function deleteRecord($id){
        // delete query
        $query = "DELETE FROM accounts WHERE id = '$id'";
        //submit the query
        $result = $this->con->query($query);
        // getting the user id to be deleted
        $userId = $_GET['id'];
        // if the query went through
        if($result){
            //go back to users page
            Header("Location: users.php?id=$userId?msg2=delete");
        }else{
            echo "Could not delete record. Try again";
        }
    }
}
//creating a global instance of this class
$database = new Database();
?>
