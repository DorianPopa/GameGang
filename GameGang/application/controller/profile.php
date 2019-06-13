<?php

class Profile extends Controller {
  public function user($id = null) {
    if(isset($id)) {
      $user_id = $id;
      if($this->model->getUser($user_id)) {
          $user = $this->model->getUser($user_id);
          $favorite_games = $this->model->getFavoriteGames($user_id);
          $recent_sessions = $this->model->getRecentSessions($user_id);
          $groups = $this->model->getGroupsOfUser($user_id);

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
          $mostplayed = $this->model->getMostPlayed($game_id);

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
          $this->model->addSession($_POST['user_id'], $game_id, $_POST['description'], $_POST['duration']);
        }

      }
    }
    header('location: '. URL .'profile/sessions/'.$this->isLoggedIn());
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

  public function group($id = null) {
    if(isset($id)){
      $group = $this->model->getGroup($id);
      $members = $this->model->getGroupMembers($id);
      $sessions = $this->model->getGroupSessions($id);
  
      require APP . 'view/_templates/header.php';
      require APP . 'view/profile/group.php';
      require APP . 'view/_templates/footer.php';
    }
  }


}

