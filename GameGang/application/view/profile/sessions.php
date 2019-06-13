<div class="container">
  <div class="sessionContainer">
    <?php if($this->isLoggedIn()) { ?>
      <div class="addSessionField">
          <h3>Add a new game session</h3>
          <form action="<?php echo URL; ?>profile/addsession" method="POST">
              <input type="text"    class="inputField" name="title" placeholder="Game" value="" required />
              <input type="text"    class="inputField" name="description" placeholder="Description" value="" required />
              <input type="text"    class="inputField" name="duration" value="" placeholder="hh:mm:ss.xxxx" />
              <input type="hidden" name="user_id" value="<?php echo $this->isLoggedIn(); ?>">
              <input type="submit"  class="submitButton" name="submit_add_session" value="Submit" />
          </form>
      </div>
    <?php } ?>
    <div class="mySessionsTable">
      <h3>My game sessions</h3>
      <table>
          <thead>
            <tr>
                <td>Title</td>
                <td>Description</td>
                <td>Duration</td>
            </tr>
          </thead>
          <tbody>
          <?php foreach ($sessions as $session) { ?>
              <tr>
                  <td><?php if (isset($session->title)) echo htmlspecialchars($session->title, ENT_QUOTES, 'UTF-8'); ?></td>
                  <td><?php if (isset($session->description)) echo htmlspecialchars($session->description, ENT_QUOTES, 'UTF-8'); ?></td>
                  <td><?php if (isset($session->duration)) echo htmlspecialchars($session->duration, ENT_QUOTES, 'UTF-8'); ?></td>
              </tr>
          <?php } ?>
          </tbody>
      </table>
    </div>
  </div>
</div>
