<?php

class Controller {
  /**
   * @var null Database Connection
    */
  public $db = null;

  /**
    * @var null Model
    */
  public $model = null;

  /**
   * Whenever controller is created, open a database connection too and load "the model".
   */
  function __construct() {
    $this->openDatabaseConnection();
    $this->loadModel();
  }

    /**
     * Open the database connection with the credentials from application/config/config.php
     */
  private function openDatabaseConnection() {
    // set the (optional) options of the PDO connection. in this case, we set the fetch mode to
    // "objects", which means all results will be objects, like this: $result->user_name !
    // For example, fetch mode FETCH_ASSOC would return results like this: $result["user_name] !
    // @see http://www.php.net/manual/en/pdostatement.fetch.php
    $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING);

    // generate a database connection, using the PDO connector
    // @see http://net.tutsplus.com/tutorials/php/why-you-should-be-using-phps-pdo-for-database-access/
    $this->db = new PDO(DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET, DB_USER, DB_PASS, $options);
  }

  /**
   * Loads the "model".
   * @return object model
   */
  public function loadModel() {
    require APP . 'model/model.php';
    // create new "model" (and pass the database connection)
    $this->model = new Model($this->db);
  }

  public function isLoggedIn() {
    //if the user already has a token
    if(isset($_COOKIE['GGID'])) {
      //if the token corresponds to a user
      if($this->model->getUserIdByToken(sha1($_COOKIE['GGID']))) {
        $user_id = $this->model->getUserIdByToken(sha1($_COOKIE['GGID']));

        //check if we have to give the user a new token
        if(isset($_COOKIE['GGID_'])) {
          //user is fine
          return $user_id;
        }
        else {
          // GGID_ expired so we give the user a new token
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
