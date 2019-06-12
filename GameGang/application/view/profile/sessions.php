<div class="container">
  <?php if($this->isLoggedIn()) { ?>
    <div class="box">
        <h3>Add a session</h3>
        <form action="<?php echo URL; ?>profile/addsession" method="POST">
            <label>Game</label>
            <input type="text" name="title" value="" required />
            <label>Description</label>
            <input type="text" name="description" value="" required />
            <label>Duration</label>
            <input type="text" name="duration" value="" />
            <input type="hidden" name="user_id" value="<?php echo $this->isLoggedIn(); ?>">
            <input type="submit" name="submit_add_session" value="Submit" />
        </form>
    </div>
  <?php } ?>
  <div class="box">


  </div>
</div>
