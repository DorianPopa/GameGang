<?php

class Games extends Controller {
  public function view($first_game_id = null) {

    if(isset($first_game_id)) $games = $this->model->getFirstThreeGames($first_game_id);
    else $games = $this->model->getFirstThreeGames(1);

    require APP . 'view/_templates/header.php';
    require APP . 'view/games/view.php';
    require APP . 'view/_templates/footer.php';
  }

  public function add() {
    if($this->isLoggedIn()){
      if($this->hasAddPrivileges($this->isLoggedIn())){
        require APP . 'view/_templates/header.php';
        require APP . 'view/games/add.php';
        require APP . 'view/_templates/footer.php';
      }
      else {
        header('location: ' . URL . 'games/view');
      }
    }
    else {
      header('location: ' . URL . 'games/view');
    }
  }

  public function edit($game_id = null) {
    if($this->isLoggedIn()){
      if($this->hasEditPrivileges($this->isLoggedIn())){
        if(isset($game_id)) {
          $game = $this->model->getGame($game_id);

          require APP . 'view/_templates/header.php';
          require APP . 'view/games/edit.php';
          require APP . 'view/_templates/footer.php';
        }
        else {
          header('location: ' . URL . 'games/view');
        }
      }
      else {
        header('location: ' . URL . 'games/view');
      }
    }
    else {
      header('location: ' . URL . 'games/view');
    }
  }

  public function addGame() {
    if($this->isLoggedIn()){
      if($this->hasEditPrivileges($this->isLoggedIn())){
        if (isset($_POST["submit_add_game"])) {
        $this->model->addGame($_POST["title"], $_POST["description"],  $_POST["release_date"], $_POST["developer"]);
        }
      }
    }
    header('location: ' . URL . 'games/view');
  }

  public function editGame($game_id) {
    if($this->isLoggedIn()){
      if($this->hasEditPrivileges($this->isLoggedIn())){
        if (isset($_POST["submit_edit_game"])) {
          $this->model->editGame($game_id, $_POST["title"], $_POST["description"],  $_POST["release_date"], $_POST["developer"]);
        }
      }
    }
    header('location: ' . URL . 'games/view');
  }

  public function deleteGame($game_id) {
    if($this->isLoggedIn()){
      if($this->hasDeletePrivileges($this->isLoggedIn())){
          $this->model->deleteGame($game_id);
      }
    }
    header('location: ' . URL . 'games/view');
  }

}
