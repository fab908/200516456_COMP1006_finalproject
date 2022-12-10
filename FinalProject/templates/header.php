<!doctype html>
<!-- we will close the html element in our footer template -->
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- create a dynamic title -->
    <title><?php $title =""; echo $title;?></title>
    <!-- create a dynamic description -->
    <meta name="description" content="<?php $description =""; echo $description;?>">
    <meta name="robots" content="noindex, nofollow">
    <!-- add our CSS -->
    <link rel="stylesheet" href="./css/style.css">
    <!-- Linking Font Awesome -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"/>
</head>
<!-- the body element will be closed in our footer template -->
<body>
<header>
    <!-- adding the logo in a div -->
    <div class="">
        <a href="content.php"><img src="./img/logo.png" alt="header logo"></a>
    </div>
    <!-- creating the navigation for the header -->
    <nav>
        <!-- unordered list for the page navigation buttons -->
        <ul>
            <li><a href="content.php?">Home</a></li>
            <li><a href="profile.php">Profile</a></li>
            <li><a href="users.php">Users</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>
</header>
