<?php

class Profile extends Controller {
  public function user($id = null) {
    if(isset($id)) {
      $user_id = $id;
      if($this->model->getUser($user_id)) {
          $user = $this->model->getUser($user_id);
          $favorite_games = $this->model->getFavoriteGames($user_id);

          require APP . 'view/_templates/header.php';
          require APP . 'view/profile/user.php';
          require APP . 'view/_templates/footer.php';
      }
      else {
        header('location: '. URL);
      }
    }
    else {
      header('location: '. URL);
    }
  }

  public function game($id = null) {
    if(isset($id)) {
      $game_id = $id;
      if($this->model->getGame($game_id)) {
          $game = $this->model->getGame($game_id);

          require APP . 'view/_templates/header.php';
          require APP . 'view/profile/game.php';
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

  public function sessions($id = null) {
    if(isset($id)) {
      $user_id = $id;
      if($this->model->getUser($user_id)) {
          $sessions = $this->model->getSessions($user_id);

          require APP . 'view/_templates/header.php';
          require APP . 'view/profile/sessions.php';
          require APP . 'view/_templates/footer.php';
      }
      else {
        header('location: '. URL);
      }
    }
    else {
      header('location: '. URL);
    }
  }

  public function addSession() {
    if($this->isLoggedIn()) {
      if(isset($_POST['submit_add_session'])) {
        $game_id = $this->model->getGameIdByTitle($_POST['title']);
        if($game_id) {

        }

      }
    }
  }

  public function setFavorite($game_id = null) {
    if(isset($game_id)) {
      if($this->isLoggedIn()) {
        $user_id = $this->isLoggedIn();
        if(!$this->model->neverPlayed($user_id, $game_id)) {
          $this->model->addUserPlaysGame($user_id, $game_id);
        }
        $this->model->setFavorite($user_id, $game_id);
      }
    }
    header('location: ' . URL . 'profile/game/' . $game_id);
  }

}
