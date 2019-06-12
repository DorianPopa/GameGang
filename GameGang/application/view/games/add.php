<div class="container">
  <div class="box">
      <h3>Add a game</h3>
      <form action="<?php echo URL; ?>games/addgame" method="POST">
          <label>Title</label>
          <input type="text" name="title" value="" required />
          <label>Release Date</label>
          <input type="date" name="release_date" value="" />
          <label>Developer</label>
          <input type="text" name="developer" value="" required />
          <input type="submit" name="submit_add_game" value="Submit" /> <br>
          <label>Description</label> <br>
          <textarea name="description" rows="1" cols="100"></textarea>
      </form>
  </div>
</div>
