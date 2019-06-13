<?php

class Home extends Controller {
  public function index() {

    if($this->isLoggedIn()) {
      $user = $this->model->getUser($this->isLoggedIn());
    }
    $mostPopularGames = $this->model->getMostPopularGames();
    // load views
    require APP . 'view/_templates/header.php';
    require APP . 'view/home/index.php';
    require APP . 'view/_templates/footer.php';
  }
}
