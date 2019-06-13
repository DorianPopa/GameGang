<div class="container">
  <div class="groupdata">
    <?php echo $group->name; ?>
  </div>

  <div class="groupmembers">
    <h2>Members:</h2>
    <?php foreach($members as $user) { ?>
      <h3><?php echo $this->model->getUser($user->user_id)->username; ?></h3>
    <?php } ?>
  </div>

  <div class="groupsessions">
    <h2>Sessions:</h2>
    <?php foreach($sessions as $session) { ?>
      <?php echo $this->model->getSession($session->session_id)->description.', '.$this->model->getUser($session->user_id)->username; ?> <br>
    <?php }  ?>
  </div>
</div>