
<div class="container">
  <div class="middleContainer">
    <img alt="#" src="<?php echo URL; ?>img/background_games.jpg" class="theBigImageGames">
    <div class="textOverImageBackgroundGames">
      <div class="textInside">
        <h1> Game Library </h1>
      </div>
    </div>
  </div>

  <div class="gamesContainer">
    <ul>
      <?php foreach($games as $game) {?>
        <li>
          <h3><a href="<?php echo URL; ?>profile/game/<?php echo $game->id; ?>"> <?php echo $game->title;?> </a></h3>

          <img src="<?php echo URL; ?>img/thumbnail_<?php echo $game->title; ?>.jpg">

          <p>
            <?php echo substr($game->description, 0, 285)."..."; ?>
          </p>

          <div class="developer">
            <?php echo $game->developer; ?>
          </div>

          <div class="adminstuff">
            <?php if($this->isLoggedIn()) if($this->hasEditPrivileges($this->isLoggedIn())) { ?>
         <a href="<?php echo URL ?>games/edit/<?php echo htmlspecialchars($game->id, ENT_QUOTES, 'UTF-8') ?>">Edit</a>
       <?php } ?>

       <?php if($this->isLoggedIn()) if($this->hasDeletePrivileges($this->isLoggedIn())) { ?>
         <a href="<?php echo URL ?>games/deleteGame/<?php echo htmlspecialchars($game->id, ENT_QUOTES, 'UTF-8') ?>">Delete</a>
       <?php } ?>
          </div>

        </li>

      <?php } ?>
    </ul>
  </div>

  <div class="pageNavigator">
        <ul>
            <li>
                <a href="<?php echo URL ?>games/view/<?php if(isset($first_game_id)) if($first_game_id > 6) echo $first_game_id - 6; ?>"><img alt="#" src="<?php echo URL ?>img/arrow.png" class="prevPage"></a>
            </li>
            <li>
                <a href="<?php echo URL ?>games/view/<?php if(isset($first_game_id)) echo $first_game_id + 6; else echo "7"; ?>"><img alt="#" src="<?php echo URL ?>img/arrow.png" class="nextPage"></a>
            </li>
        </ul>
    </div>

</div>
