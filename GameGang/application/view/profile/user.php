<div class="container">
  <?php if (isset($user->username)) echo htmlspecialchars($user->username, ENT_QUOTES, 'UTF-8'); ?>
  <?php if (isset($user->firstname)) echo htmlspecialchars($user->firstname, ENT_QUOTES, 'UTF-8'); ?>
  <?php if (isset($user->lastname)) echo htmlspecialchars($user->lastname, ENT_QUOTES, 'UTF-8'); ?>
  <ul>
    <?php foreach($favorite_games as $game) { ?>
      <li>
        <?php if (isset($game->title)) echo htmlspecialchars($game->title, ENT_QUOTES, 'UTF-8'); ?>
      </li>
    <?php } ?>
  </ul>

</div>
