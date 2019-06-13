<div class="container">
  
  <div class="addnewgroup">
  <h2>Welcome to the groups page!</h2>
    <form action="<?php echo URL; ?>groups/addgroup" method="post">
      <input type="text" class="inputField" name="groupname" value="" placeholder="Group name"/>
      <input type="text" class="inputField" name="gametitle" value="" placeholder="Game title"/>
      <input type="submit" class="submitButton" name="submit_add_group" value="Create new group" />
    </form>
  </div>

  <div class="existinggroups">
    <h2>Existing groups</h2>
    <table>
      <thead>
        <tr>
            <td>Group name</td>
            <td>Game Title</td>
            <td>Number of members</td>
            <td></td>
        </tr>
      </thead>
      <tbody>
        <?php foreach($groups as $group) { ?>
          <tr>
            <td><a href="<?php echo URL;?>profile/group/<?php echo $group->id?>"><?php echo $group->name ?></a></td>
            <td><?php echo $this->model->getGame($group->game_id)->title; ?></td>
            <td><?php echo $this->model->getGroupMemberCount($group->id); ?></td>
            <td>
              <form action="<?php echo URL; ?>groups/joingroup/<?php echo $group->id ?>" method="post">
                <input type="submit" class="submitButton" name="submit_join_group" value="Join" />
              </form>
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</div>
