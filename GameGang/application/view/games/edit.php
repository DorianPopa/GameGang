<div class="container">
  <div class="editContainer">
      <h2>Edit an existing game</h2>
      <form action="<?php echo URL; ?>games/editgame/<?php echo $game_id; ?>" method="POST">
          <label>Change Title</label>
          <input type="text" name="title" class="inputField" value="<?php echo htmlspecialchars($game->title, ENT_QUOTES, 'UTF-8'); ?>" required />
          <label>Change Release Date</label>
          <input type="date" name="release_date" class="inputField" value="<?php echo htmlspecialchars($game->release_date, ENT_QUOTES, 'UTF-8'); ?>" />
          <label>Change Developer</label>
          <input type="text" name="developer" class="inputField" value="<?php echo htmlspecialchars($game->developer, ENT_QUOTES, 'UTF-8'); ?>" required />

          <label>Change Description</label> <br>
          <textarea name="description" class="inputField" rows="15" cols="110"><?php echo htmlspecialchars($game->description, ENT_QUOTES, 'UTF-8'); ?></textarea>
          <input type="submit" class="submitButton" name="submit_edit_game" value="Submit" /> <br>
      </form>
  </div>
</div>
