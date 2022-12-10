<!-- this is the template for each post -->
<section class="post">
    <div>
        <div>
            <!-- this image will house the profile picture of who posted it -->
            <img src="<?php echo $profilePicture; ?>" alt="Profile Picture">
            <!-- show the username of who posted it -->
            <p><?php echo $username; ?></p>
            <div>
                <!-- not functioning but would delete the post once clicked -->
                <form method="POST">
                    <input type="submit" name="deletePost" value="X" />
                </form>
            </div>
        </div>
        <div>
            <!-- the actual image to be showcased -->
            <img src="<?php echo $image; ?>" alt="picture">
            <!-- the description -->
            <p><?php echo $description; ?></p>
        </div>
        <div>
            <!-- title for comments -->
            <h1>Comments</h1>
            <!-- form to take in the comments -->
            <form  method='POST'>
                <input type="text" name="comment" placeholder="Comment..."/>
                <input type="submit" name="send" value="Send"/>
            </form>
            <!-- table to display the comments -->
            <table>
                <tbody>
                <!-- if the comment isnt empty it will display the comment in a <td> -->
                <?php if($comment1 != ""){ ?>
                    <td><?php echo $comment1; ?></td>
                <?php } ?>
                <?php if($comment2 != ""){ ?>
                    <td><?php echo $comment2; ?></td>
                <?php } ?>
                <?php if($comment3 != ""){ ?>
                    <td><?php echo $comment3; ?></td>
                <?php } ?>
                <?php if($comment4 != ""){ ?>
                    <td><?php echo $comment4; ?></td>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</section>