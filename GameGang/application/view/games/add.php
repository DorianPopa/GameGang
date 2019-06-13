<div class="container">
  <div class="addGameContainer">
      <h2>Add a game</h2>
      <form action="<?php echo URL; ?>games/addgame" method="POST">
          <label>Title</label>
          <input type="text" class="inputField" name="title" value="" required />
          <label>Release Date</label>
          <input type="date" class="inputField" name="release_date" value="" />
          <label>Developer</label>
          <input type="text" class="inputField" name="developer" value="" required />
          
          <label>Description</label> <br>
          <textarea name="description" class="inputField" rows="15" cols="100"></textarea>
          <input type="submit" class="submitButton" name="submit_add_game" value="Add game" /> <br>
      </form>
  </div>
</div>
