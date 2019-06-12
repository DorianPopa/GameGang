<div class="container">
  <div class="anotherbigImageContainer">
            <img alt="#" src="<?php echo URL; ?>img/background_<?php echo $game->title; ?>.jpg" class="anothertheBigImage">
            <div class="anothertextOverImageBackground">
                <div class="anothertextInside">
                    <h1><?php echo $game->title; ?></h1>
                </div>
            </div>
        </div>

        <div class="gameData">
          <div class="description">
            <h2 class="descriptiontitle">Description</h2>

                <?php echo $game->description; ?>

          </div>
          <div class="mostPlayed">
            <h2 class="mostplayedtitle">Recent activity</h2>
            <ul class="recentsessions">
              <?php foreach($mostplayed as $player) { ?>
                <li>
                  <?php echo $this->model->getUser($player->user_id)->username; ?>,
                  <?php echo $player->duration; ?> <br>
                </li>
              <?php } ?>
            </ul>
          </div>
        </div>

  <div class="box">
    <?php if (isset($game->title)) echo htmlspecialchars($game->title, ENT_QUOTES, 'UTF-8'); ?>
    <?php if (isset($game->release_date)) echo htmlspecialchars($game->release_date, ENT_QUOTES, 'UTF-8'); ?>
    <?php if (isset($game->developer)) echo htmlspecialchars($game->developer, ENT_QUOTES, 'UTF-8'); ?>
  </div>
  <div class="box">
    <?php if($this->isLoggedIn()) { ?>
      <form action="<?php echo URL; ?>profile/setfavorite/<?php echo $game_id ?>">
        <input type="submit" name="submit_set_favorite"
        value="<?php if($this->model->neverPlayed($this->isLoggedIn(), $game_id)) {
                       if($this->model->getFavorite($this->isLoggedIn(), $game_id)) echo "Remove from favorites";
                       else echo "Add to favorites";
                     } else echo "Add to favorites"; ?>" /> <br>
      </form>
    <?php } ?>
  </div>
</div>
