
<div class="gamescontainer">
  <ul>
    <?php foreach($games as $game) {?>

      <li>
        <img src="<?php echo URL ?>img/image.jpg" alt="Image" /> <br>

        <a href="<?php echo URL ?>profile/game/<?php if (isset($game->id)) echo htmlspecialchars($game->id, ENT_QUOTES, 'UTF-8'); ?>">
          <?php if (isset($game->title)) echo htmlspecialchars($game->title, ENT_QUOTES, 'UTF-8'); ?>
        </a>

        <p><?php if (isset($game->developer)) echo htmlspecialchars($game->developer, ENT_QUOTES, 'UTF-8'); ?></p>

        <?php if($this->isLoggedIn()) if($this->hasEditPrivileges($this->isLoggedIn())) { ?>
          <a href="<?php echo URL ?>games/edit/<?php echo htmlspecialchars($game->id, ENT_QUOTES, 'UTF-8') ?>">edit game</a>
        <?php } ?>

        <?php if($this->isLoggedIn()) if($this->hasDeletePrivileges($this->isLoggedIn())) { ?>
          <a href="<?php echo URL ?>games/deleteGame/<?php echo htmlspecialchars($game->id, ENT_QUOTES, 'UTF-8') ?>">delete game</a>
        <?php } ?>
      </li>

    <?php } ?>
  </ul>
</div>
