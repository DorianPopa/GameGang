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
    // if we have POST data to create a new song entry
    if($this->isLoggedIn()){
      if($this->hasEditPrivileges($this->isLoggedIn())){
        if (isset($_POST["submit_add_game"])) {
        // do addSong() in model/model.php
        $this->model->addGame($_POST["title"], $_POST["description"],  $_POST["release_date"], $_POST["developer"]);
        }
      }
    }
    // where to go after song has been added
    header('location: ' . URL . 'games/view');
  }

  public function editGame($game_id) {
    // if we have POST data to create a new song entry
    if($this->isLoggedIn()){
      if($this->hasEditPrivileges($this->isLoggedIn())){
        if (isset($_POST["submit_edit_game"])) {
          // do addSong() in model/model.php
          $this->model->editGame($game_id, $_POST["title"], $_POST["description"],  $_POST["release_date"], $_POST["developer"]);
        }
      }
    }
    // where to go after song has been added
    header('location: ' . URL . 'games/view');
  }

  public function deleteGame($game_id) {
    if($this->isLoggedIn()){
      if($this->hasDeletePrivileges($this->isLoggedIn())){
          // do addSong() in model/model.php
          $this->model->deleteGame($game_id);
      }
    }
    header('location: ' . URL . 'games/view');
  }

}
