<?php

class Groups extends Controller {
  public function index() {
    if($this->isLoggedIn()) {
      $groups = $this->model->getGroups();

      require APP . 'view/_templates/header.php';
      require APP . 'view/groups/index.php';
      require APP . 'view/_templates/footer.php';
    }
    else header('location: ' . URL);
  }

  public function addGroup() {
    if($this->isLoggedIn()) {
      if(isset($_POST['submit_add_group']))
        $this->model->addGroup($_POST['groupname'], $this->model->getGameIdByTitle($_POST['gametitle']));
    }
    header('location: ' . URL . 'groups/');
  }

  public function joinGroup($group_id = null) {
    if(isset($group_id)){
      echo "<script>console.log('a')</script>";
      if($this->isLoggedIn()) {
        echo "<script>console.log('b')</script>";
        if(isset($_POST['submit_join_group'])) {
          echo "<script>console.log('c')</script>";
          $this->model->joinGroup($group_id, $this->isLoggedIn());
        }
      }
    }
    header('location: ' . URL . 'groups/');
  }
}
