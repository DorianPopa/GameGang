<div class="container">
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
