<div class="container">
  <div class="addnewgroup">
    <form action="<?php echo URL; ?>groups/addgroup" method="post">
      <input type="text" name="groupname" value="" placeholder="Group name"/>
      <input type="text" name="gametitle" value="" placeholder="Game title"/>
      <input type="submit" name="submit_add_group" value="Submit" />
    </form>
  </div>

  <div class="existinggroups">
    <h2>Welcome to the groups page!</h2>
    <?php foreach($groups as $group) { ?>
      <h4><?php echo $group->name ?></h4>
      <h3><?php echo $this->model->getGroupMemberCount($group->id); ?></h3>
      <form action="<?php echo URL; ?>groups/joingroup/<?php echo $group->id ?>" method="post">
        <input type="submit" name="submit_join_group" value="Join" />
      </form>
    <?php } ?>
  </div>
</div>
