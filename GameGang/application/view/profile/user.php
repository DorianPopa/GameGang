<div class="container">
  <div class="profileBackgroundContainer">
    <img alt="#" src="<?php echo URL; ?>img/profile_background_<?php //echo $user->username ?>.jpg">
  </div>

  <div class="profileContainer">
    <img alt="#" src="<?php echo URL; ?>img/profile_<?php //echo $user->username ?>.jpg" class="profilePicture">
    <h2><?php if (isset($user->username)) echo htmlspecialchars($user->username, ENT_QUOTES, 'UTF-8'); ?></h2>

    <div class="userData">
      <div class="favoritegames">
        <h2 class="favgamestitle">Favorite games</h2>
        <ul class="favGamesList">
          <?php foreach($favorite_games as $game) { ?>
            <li>
              <img alt="#" src="<?php echo URL; ?>img/icon_<?php //echo $game->title ?>.jpg" class="gameicon">
              <h3><?php if (isset($game->title)) echo htmlspecialchars($game->title, ENT_QUOTES, 'UTF-8'); ?></h3>
            </li>
          <?php } ?>
        </ul>
      </div>
      <div class="recentactivity">
        <h2 class="favgamestitle">Recent activity</h2>
        <ul class="recentsessions">
          <?php foreach($recent_sessions as $session) { ?>
            <li>
              <?php if (isset($session->title)) echo htmlspecialchars($session->title, ENT_QUOTES, 'UTF-8'); ?>,
              <?php if (isset($session->duration)) $hrs = strtok($session->duration, ":"); $min = strtok(":"); echo $hrs."hr ".$min."min"; ?> <br>
              <p>
                Description: <?php if (isset($session->description)) echo htmlspecialchars($session->description, ENT_QUOTES, 'UTF-8'); ?>
              </p>
            </li>
          <?php } ?>
        </ul>
      </div>
    </div>


  </div>

</div>
