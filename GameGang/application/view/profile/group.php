<div class="container">
  <div class="groupname">
      <h1><?php echo $group->name; ?></h1>
      <p>We are a group of <?php echo $this->model->getGame($group->game_id)->title; ?> players.</p>
  </div>
  <div class="groupdata">

    <div class="groupmembers">
      <h3>Our Members:</h3>
      <ol>
      <?php foreach($members as $user) { ?>
        <li><?php echo $this->model->getUser($user->user_id)->username; ?></li>
      <?php } ?>
      </ol>
    </div>

    <div class="groupsessions">
      <h2>Our members' game sessions:</h2>
      <ul>
      <?php foreach($sessions as $session) { ?>
        <li>"<?php echo $this->model->getSession($session->session_id)->description.'" was registered by '.$this->model->getUser($session->user_id)->username; ?></li>
      <?php }  ?>
      </ul>
    </div>
  </div>
</div>