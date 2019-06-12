<?php

class Login extends Controller {

  public function index() {
    require APP . 'view/_templates/header.php';
    require APP . 'view/login/index.php';
    require APP . 'view/_templates/footer.php';
  }

  public function register() {
    require APP . 'view/_templates/header.php';
    require APP . 'view/login/register.php';
    require APP . 'view/_templates/footer.php';
  }

  public function logout() {
    if(isset($_COOKIE['GGID'])) {
      $this->model->deleteToken(sha1($_COOKIE['GGID']));
    }

    unset($_COOKIE['GGID']);
    unset($_COOKIE['GGID_']);
    setcookie('GGID', '', time() - 3600, '/');
    setcookie('GGID_', '', time() - 3600, '/');

    $user_id = null;

    header('location: '. URL);
  }

  public function doLogin() {
    if(isset($_POST["submit_do_login"])) {
      $username = $_POST["username"];
      $password = $_POST["password"];

      if($this->model->usernameExists($username)) {
        if(password_verify($password, $this->model->getPassword($username))) {
          $cstrong = true;
          $token = bin2hex(openssl_random_pseudo_bytes(64, $cstrong));

          $user_id = $this->model->getUserIdByUsername($username);
          $this->model->insertToken($user_id, sha1($token));

          setcookie("GGID", $token, time() + 60 * 60 * 24 * 7, '/', null, null, true);
          setcookie("GGID_", '1', time() + 60 * 60 * 24 * 3, '/', null, null, true);
          header('location: '. URL);
        }
        else {
          header('location: '. URL .'login');
        }
      }
      else {
        header('location: '. URL .'login');
      }
    }
    else {
      header('location: '. URL .'login');
    }
  }

  public function doRegister() {
    if(isset($_POST["submit_do_register"])) {
      $username = $_POST["username"];
      $password = $_POST["password"];

      if(!$this->model->usernameExists($username)) {
        $this->model->register($username, password_hash($password, PASSWORD_BCRYPT));
        header('location: '. URL .'login');
      }
      else {
        header('location: '. URL .'login/register');
      }
    }
    else {
      header('location: '. URL .'login');
    }
  }
}
