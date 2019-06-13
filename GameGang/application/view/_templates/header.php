<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>GameGang</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <link href="<?php echo URL; ?>css/styleish.css" rel="stylesheet">
</head>
<body>
    <div class="logo">
      <img src="<?php echo URL; ?>img/logo.png" alt="#" class="logoImage">
      <h1>GameGang</h1>
    </div>

    <div class="navigation">
      <ul>
        <li><a href="<?php echo URL; ?>">Home</a></li>
        <li><a href="<?php echo URL; ?>games/view">Games</a></li>

        <?php if($this->isLoggedIn()) { ?> <li><a href="<?php echo URL; ?>groups">Groups</a></li> <?php } ?>

        <?php if($this->isLoggedIn()) { ?> <li><a href="<?php echo URL; ?>profile/user/<?php echo $this->isLoggedIn(); ?>">Profile</a></li> <?php } ?>

        <?php if($this->isLoggedIn()) { ?> <li><a href="<?php echo URL; ?>profile/sessions/<?php echo $this->isLoggedIn(); ?>">Sessions</a></li> <?php } ?>

        <?php if($this->isLoggedIn()) if($this->hasAddPrivileges($this->isLoggedIn())) {?>
          <li><a href="<?php echo URL; ?>games/add">Add game</a></li>
        <?php } ?>
        <?php if($this->isLoggedIn()) { ?><li><a href="<?php echo URL; ?>login/logout">Logout</a></li>
        <?php } else {?> <li><a href="<?php echo URL; ?>login">Login</a></li> <?php } ?>
      </ul>

    </div>
