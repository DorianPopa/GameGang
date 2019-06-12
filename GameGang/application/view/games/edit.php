<div class="container">
  <div class="editContainer">
      <h3>Edit a game</h3>
      <form action="<?php echo URL; ?>games/editgame/<?php echo $game_id; ?>" method="POST">
          <label>Title</label>
          <input type="text" name="title" value="<?php echo htmlspecialchars($game->title, ENT_QUOTES, 'UTF-8'); ?>" required /> <br>
          <label>Release Date</label>
          <input type="date" name="release_date" value="<?php echo htmlspecialchars($game->release_date, ENT_QUOTES, 'UTF-8'); ?>" /> <br>
          <label>Developer</label>
          <input type="text" name="developer" value="<?php echo htmlspecialchars($game->developer, ENT_QUOTES, 'UTF-8'); ?>" required /> <br>
          <label>Description</label> <br>
          <textarea name="description" rows="3" cols="110"><?php echo htmlspecialchars($game->description, ENT_QUOTES, 'UTF-8'); ?></textarea> <br>
          <input type="submit" name="submit_edit_game" value="Submit" /> <br>
      </form>
  </div>
</div>
