<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>GameGang</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- JS -->
    <!-- please note: The JavaScript files are loaded in the footer to speed up page construction -->
    <!-- See more here: http://stackoverflow.com/q/2105327/1114320 -->

    <!-- CSS -->
    <link href="<?php echo URL; ?>css/style.css" rel="stylesheet">
</head>
<body>
    <!-- logo -->
    <div class="logo">
        GameGang
    </div>

    <!-- navigation -->
    <div class="navigation">
        <a href="<?php echo URL; ?>">home</a>
        <a href="<?php echo URL; ?>home/exampleone">subpage</a>
        <a href="<?php echo URL; ?>home/exampletwo">subpage 2</a>
        <a href="<?php echo URL; ?>songs">songs</a>
        <a href="<?php echo URL; ?>games/view">games</a>
        <?php if($this->isLoggedIn()) { ?> <a href="<?php echo URL; ?>login/logout">logout</a>
        <?php } else {?> <a href="<?php echo URL; ?>login">login</a> <?php } ?>

        <?php if($this->isLoggedIn()) { ?> <a href="<?php echo URL; ?>profile/user/<?php echo $this->isLoggedIn(); ?>">profile</a><?php } ?>

        <?php if($this->isLoggedIn()) { ?> <a href="<?php echo URL; ?>profile/sessions/<?php echo $this->isLoggedIn(); ?>">sessions</a><?php } ?>

        <?php if($this->isLoggedIn()) if($this->hasAddPrivileges($this->isLoggedIn())) {?>
          <a href="<?php echo URL; ?>games/add">add game</a>
        <?php } ?>

    </div>
