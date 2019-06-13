<?php

class Model {
  function __construct($db) {
    try {
      $this->db = $db;
    } catch (PDOException $e) {
      exit('Database connection could not be established.');
    }
  }

  public function usernameExists($username) {
    $sql = "SELECT username FROM users WHERE username = :username";
    $query = $this->db->prepare($sql);
    $parameters = array(':username' => $username);

    $query->execute($parameters);

    return $query->fetch();
  }

  public function getPassword($username) {
    $sql = "SELECT password FROM users WHERE username = :username";
    $query = $this->db->prepare($sql);
    $parameters = array(':username' => $username);
    $query->execute($parameters);

    return $query->fetch()->password;
  }

  public function getUserIdByUsername($username) {
    $sql = "SELECT id AS user_id FROM users WHERE username = :username";
    $query = $this->db->prepare($sql);
    $parameters = array(':username' => $username);
    $query->execute($parameters);

    return $query->fetch()->user_id;
  }

  public function register($username, $password) {
    $sql = "INSERT INTO users VALUES (null, :username, :password, 0, null, null)";
    $query = $this->db->prepare($sql);
    $parameters = array(':username' => $username, ':password' => $password);

    $query->execute($parameters);
  }

  public function insertToken($user_id, $token) {
    $sql = "INSERT INTO login_tokens VALUES(null, :token, :user_id)";
    $query = $this->db->prepare($sql);
    $parameters = array(':user_id' => $user_id, ':token' => $token);

    $query->execute($parameters);
  }

  public function deleteToken($token) {
    $sql = "DELETE FROM login_tokens WHERE token = :token";
    $query = $this->db->prepare($sql);
    $parameters = array(':token' => $token);

    $query->execute($parameters);
  }

  public function getUserIdByToken($token) {
    $sql = "SELECT user_id FROM login_tokens WHERE token = :token";
    $query = $this->db->prepare($sql);
    $parameters = array(':token' => $token);
    $query->execute($parameters);

    return $query->fetch()->user_id;
  }

  public function getUserPrivileges($user_id) {
    $sql = "SELECT privileges FROM users WHERE id = :user_id";
    $query = $this->db->prepare($sql);
    $parameters = array(':user_id' => $user_id);
    $query->execute($parameters);

    return $query->fetch()->privileges;
  }

  public function getUser($user_id)
  {
      $sql = "SELECT id, username, firstname, lastname FROM users WHERE id = :user_id";
      $query = $this->db->prepare($sql);
      $parameters = array(':user_id' => $user_id);
      $query->execute($parameters);

      return $query->fetch();
  }

  public function getFirstThreeGames($game_id) {
    $sql = "SELECT id, title, description, developer FROM games WHERE id >= :game_id LIMIT 6";
    $query = $this->db->prepare($sql);
    $parameters = array(':game_id' => $game_id);
    $query->execute($parameters);

    return $query->fetchAll();
  }

  public function getGame($game_id)
  {
      $sql = "SELECT id, title, description, release_date, developer FROM games WHERE id = :game_id";
      $query = $this->db->prepare($sql);
      $parameters = array(':game_id' => $game_id);
      $query->execute($parameters);

      return $query->fetch();
  }

  public function addGame($title, $description, $release_date, $developer) {
      $sql = "INSERT INTO games (title, description, release_date, developer) VALUES (:title, :description, :release_date, :developer)";
      $query = $this->db->prepare($sql);
      $parameters = array(':title' => $title, ':description' => $description, ':release_date' => $release_date, ':developer' => $developer);

      $query->execute($parameters);
  }

  public function editGame($game_id, $title, $description, $release_date, $developer) {
    $sql = "UPDATE games SET title = :title, description = :description, release_date = :release_date, developer = :developer WHERE id = :game_id";
    $query = $this->db->prepare($sql);
    $parameters = array(':game_id' => $game_id, ':title' => $title, ':description' => $description, ':release_date' => $release_date, ':developer' => $developer);

    $query->execute($parameters);
  }

  public function deleteGame($game_id) {
    $sql = "DELETE FROM games WHERE id = :game_id";
    $query = $this->db->prepare($sql);
    $parameters = array(':game_id' => $game_id);

    $query->execute($parameters);
  }

  public function neverPlayed($user_id, $game_id) {
    $sql = "SELECT id FROM user_plays_game WHERE user_id = :user_id AND game_id = :game_id";
    $query = $this->db->prepare($sql);
    $parameters = array(':user_id' => $user_id, ':game_id' => $game_id);

    $query->execute($parameters);

    return $query->fetch();
  }

  public function addUserPlaysGame($user_id, $game_id) {
    $sql = "INSERT INTO user_plays_game(user_id, game_id) VALUES(:user_id, :game_id)";
    $query = $this->db->prepare($sql);
    $parameters = array(':user_id' => $user_id, ':game_id' => $game_id);

    $query->execute($parameters);
  }

  public function setFavorite($user_id, $game_id) {
    $sql = "UPDATE user_plays_game SET favorite = 1 - favorite WHERE user_id = :user_id AND game_id = :game_id";
    $query = $this->db->prepare($sql);
    $parameters = array(':user_id' => $user_id, ':game_id' => $game_id);

    $query->execute($parameters);
  }

  public function getFavorite($user_id, $game_id) {
    $sql = "SELECT favorite FROM user_plays_game WHERE user_id = :user_id AND game_id = :game_id";
    $query = $this->db->prepare($sql);
    $parameters = array(':user_id' => $user_id, ':game_id' => $game_id);

    $query->execute($parameters);

    return $query->fetch()->favorite;
  }

  public function getFavoriteGames($user_id) {
    $sql = "SELECT title FROM games JOIN user_plays_game ON user_id = :user_id AND games.id = game_id WHERE favorite = 1";
    $query = $this->db->prepare($sql);
    $parameters = array(':user_id' => $user_id);

    $query->execute($parameters);

    return $query->fetchAll();
  }

  public function getMostPopularGames() {
    $sql = "SELECT game_id, duration FROM (SELECT game_id, SUM(duration) AS duration FROM game_sessions GROUP BY game_id ORDER BY 2 DESC) AS T LIMIT 3";
    $query = $this->db->prepare($sql);

    $query->execute();

    return $query->fetchAll();
  }

  public function getSessions($user_id) {
    $sql = "SELECT title, s.description as description, duration, created_at FROM games g JOIN game_sessions s ON g.id = s.game_id WHERE s.user_id = :user_id ORDER BY created_at DESC";
    $query = $this->db->prepare($sql);
    $parameters = array(':user_id' => $user_id);

    $query->execute($parameters);

    return $query->fetchAll();
  }

  public function getRecentSessions($user_id) {
    $sql = "SELECT title, s.description as description, duration FROM games g JOIN game_sessions s ON g.id = s.game_id WHERE s.user_id = :user_id ORDER BY created_at DESC LIMIT 3";
    $query = $this->db->prepare($sql);
    $parameters = array(':user_id' => $user_id);

    $query->execute($parameters);

    return $query->fetchAll();
  }

  public function getGameIdByTitle($title) {
    $sql = "SELECT id FROM games WHERE title = :title";
    $query = $this->db->prepare($sql);
    $parameters = array(':title' => $title);

    $query->execute($parameters);

    return $query->fetch()->id;
  }

  public function getMostPlayed($game_id) {
    $sql = "SELECT user_id, duration FROM (SELECT user_id, SUM(duration) AS duration FROM game_sessions WHERE game_id = :game_id GROUP BY user_id ORDER BY 2 DESC) AS T LIMIT 3";
    $query = $this->db->prepare($sql);
    $parameters = array(':game_id' => $game_id);

    $query->execute($parameters);

    return $query->fetchAll();
  }

  public function addSession($user_id, $game_id, $description, $duration) {
    $sql = "INSERT INTO game_sessions(user_id, game_id, description, duration) VALUES (:user_id, :game_id, :description, :duration)";
    $query = $this->db->prepare($sql);
    $parameters = array(':user_id' => $user_id, ':game_id' => $game_id, ':description' => $description, ':duration' => $duration);

    $query->execute($parameters);
  }

  public function addGroup($groupname, $game_id) {
    $sql = "INSERT INTO groups(name, game_id) VALUES(:groupname, :game_id)";
    $query = $this->db->prepare($sql);
    $parameters = array(':groupname' => $groupname, ':game_id' => $game_id);

    $query->execute($parameters);
  }

  public function getGroups() {
    $sql = "SELECT id, name, game_id FROM groups";
    $query = $this->db->prepare($sql);

    $query->execute();

    return $query->fetchAll();
  }

  public function joinGroup($group_id, $user_id) {
    $sql = "INSERT INTO group_has_users(group_id, user_id) VALUES(:group_id, :user_id)";
    $query = $this->db->prepare($sql);
    $parameters = array(':group_id' => $group_id, ':user_id' => $user_id);

    $query->execute($parameters);
  }

  public function getGroupMemberCount($group_id) {
    $sql = "SELECT count(id) AS count FROM group_has_users WHERE group_id = :group_id";
    $query = $this->db->prepare($sql);
    $parameters = array(':group_id' => $group_id);

    $query->execute($parameters);

    return $query->fetch()->count;
  }

  public function getGroupSessions($group_id) {
    $sql = "SELECT gs.id AS session_id, gs.user_id AS user_id FROM groups g
            JOIN group_has_users ghu ON g.id = ghu.group_id
            JOIN game_sessions gs ON ghu.user_id = gs.user_id AND g.game_id = gs.game_id
            WHERE g.id = :group_id ORDER BY created_at DESC";
    $query = $this->db->prepare($sql);
    $parameters = array(':group_id' => $group_id);
    $query->execute($parameters);

    return $query->fetchAll();
  }

  public function getSession($session_id) {
    $sql = "SELECT description FROM game_sessions WHERE id = :session_id";
    $query = $this->db->prepare($sql);
    $parameters = array(':session_id' => $session_id);

    $query->execute($parameters);

    return $query->fetch();
  }

  public function getGroup($group_id) {
    $sql = "SELECT name, game_id FROM groups WHERE id = :group_id";
    $query = $this->db->prepare($sql);
    $parameters = array(':group_id' => $group_id);

    $query->execute($parameters);

    return $query->fetch();
  }

  public function getGroupMembers($group_id) {
    $sql = "SELECT user_id FROM groups g JOIN group_has_users ghu ON g.id = ghu.group_id WHERE group_id = :group_id";
    $query = $this->db->prepare($sql);
    $parameters = array(':group_id' => $group_id);

    $query->execute($parameters);

    return $query->fetchAll();
  }

  public function getGroupsOfUser($user_id) {
    $sql = "SELECT name, game_id FROM groups g JOIN group_has_users ghu ON g.id = ghu.group_id WHERE ghu.user_id = :user_id";
    $query = $this->db->prepare($sql);
    $parameters = array(':user_id' => $user_id);

    $query->execute($parameters);

    return $query->fetchAll();
  }
}