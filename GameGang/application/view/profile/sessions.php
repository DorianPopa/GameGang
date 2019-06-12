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
            <input type="text" name="duration" value="" placeholder="hh:mm:ss.xxxx" />
            <input type="hidden" name="user_id" value="<?php echo $this->isLoggedIn(); ?>">
            <input type="submit" name="submit_add_session" value="Submit" />
        </form>
    </div>
  <?php } ?>
  <div class="box">
    <table>
        <thead style="background-color: #ddd; font-weight: bold;">
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
