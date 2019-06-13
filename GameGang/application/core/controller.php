<?php

class Controller {

  public $db = null;
  public $model = null;

  function __construct() {
    $this->openDatabaseConnection();
    $this->loadModel();
  }

  private function openDatabaseConnection() {
    $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING);

    $this->db = new PDO(DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET, DB_USER, DB_PASS, $options);
  }

  public function loadModel() {
    require APP . 'model/model.php';
    $this->model = new Model($this->db);
  }

  public function isLoggedIn() {
    if(isset($_COOKIE['GGID'])) {
      if($this->model->getUserIdByToken(sha1($_COOKIE['GGID']))) {
        $user_id = $this->model->getUserIdByToken(sha1($_COOKIE['GGID']));

        if(isset($_COOKIE['GGID_'])) {
          return $user_id;
        }
        else {
          $cstrong = true;
          $token = bin2hex(openssl_random_pseudo_bytes(64, $cstrong));

          $this->model->deleteToken(sha1($_COOKIE['GGID']));
          $this->model->insertToken($user_id, sha1($token));

          unset($_COOKIE['GGID']);
          setcookie("GGID", $token, time() + 60 * 60 * 24 * 7, '/', null, null, true);
          setcookie("GGID_", '1', time() + 60 * 60 * 24 * 3, '/', null, null, true);

        }
      }
    }
    return false;
  }

  public function hasAddPrivileges($user_id) {
    if($this->model->getUserPrivileges($user_id) & PRIV_ADD) {
      return true;
    }
    return false;
  }

  public function hasEditPrivileges($user_id) {
    if($this->model->getUserPrivileges($user_id) & PRIV_EDIT) {
      return true;
    }
    return false;
  }

  public function hasDeletePrivileges($user_id) {
    if($this->model->getUserPrivileges($user_id) & PRIV_DELETE) {
      return true;
    }
    return false;
  }
}
