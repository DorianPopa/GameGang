<div class="container">

  <div class="middleContainer">
    <img alt="#" src="<?php echo URL; ?>img/background_home.jpg" class="theBigImage">
    <div class="textOverImageBackground">
      <div class="textInside">
        <h1> <?php if($this->isLoggedIn())  echo "Welcome ". $user->username ."!";
                   else echo "Salut faracontarule!"; ?> </h1>
        This is a text-box that's transparent and resides over the big picture.
        It contains some text that has no meaningful value and it's there just because the
        devs wanted it to be there.<br>
        If you have any questions about it, please don't ask them or we will gladly ask you to to love yourself.
      </div>
    </div>
  </div>

  <div class="bottomContainer">
    <div class="mostPopular">
      <h1>Most popular games</h1>
      <div class="titleList">
        <ul>
          <?php foreach($mostPopularGames as $game) { ?>
            <li>
              <img src="<?php echo URL; ?>img/thumbnail_<?php echo $this->model->getGame($game->game_id)->title; ?>.jpg">

              <h3><a href="<?php echo URL; ?>profile/game/<?php echo $game->game_id ?>"> <?php echo $this->model->getGame($game->game_id)->title; ?></a></h3>

              <div class="timePlayed">
                <?php echo substr($game->duration, 0, -11)." hours played"; ?>
              </div>
            </li>

          <?php } ?>
        </ul>

      </div>
    </div>
  </div>

</div>
