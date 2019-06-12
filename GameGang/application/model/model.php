<?php

class Model {
  /**
    * @param object $db A PDO database connection
    */
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

    // fetch() is the PDO method that get exactly one result
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

      // useful for debugging: you can see the SQL behind above construction by using:
      // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

      $query->execute($parameters);

      // fetch() is the PDO method that get exactly one result
      return $query->fetch();
  }

  public function getFirstThreeGames($game_id) {
    $sql = "SELECT id, title, description, developer FROM games WHERE id >= :game_id LIMIT 3";
    $query = $this->db->prepare($sql);
    $parameters = array(':game_id' => $game_id);
    $query->execute($parameters);

    // fetchAll() is the PDO method that gets all result rows, here in object-style because we defined this in
    // core/controller.php! If you prefer to get an associative array as the result, then do
    // $query->fetchAll(PDO::FETCH_ASSOC); or change core/controller.php's PDO options to
    // $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ...
    return $query->fetchAll();
  }

  public function getGame($game_id)
  {
      $sql = "SELECT id, title, description, release_date, developer FROM games WHERE id = :game_id";
      $query = $this->db->prepare($sql);
      $parameters = array(':game_id' => $game_id);

      // useful for debugging: you can see the SQL behind above construction by using:
      // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

      $query->execute($parameters);

      // fetch() is the PDO method that get exactly one result
      return $query->fetch();
  }

  public function addGame($title, $description, $release_date, $developer) {
      $sql = "INSERT INTO games (title, description, release_date, developer) VALUES (:title, :description, :release_date, :developer)";
      $query = $this->db->prepare($sql);
      $parameters = array(':title' => $title, ':description' => $description, ':release_date' => $release_date, ':developer' => $developer);

      // useful for debugging: you can see the SQL behind above construction by using:
      // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

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
    $sql = "SELECT title, s.description as description, duration FROM games g JOIN game_sessions s ON g.id = s.game_id WHERE s.user_id = :user_id ORDER BY created_at DESC";
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






















  /**
    * Get all songs from database
    */
    public function getAllSongs()
    {
        $sql = "SELECT id, artist, track, link FROM song";
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetchAll() is the PDO method that gets all result rows, here in object-style because we defined this in
        // core/controller.php! If you prefer to get an associative array as the result, then do
        // $query->fetchAll(PDO::FETCH_ASSOC); or change core/controller.php's PDO options to
        // $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ...
        return $query->fetchAll();
    }

    /**
     * Add a song to database
     * TODO put this explanation into readme and remove it from here
     * Please note that it's not necessary to "clean" our input in any way. With PDO all input is escaped properly
     * automatically. We also don't use strip_tags() etc. here so we keep the input 100% original (so it's possible
     * to save HTML and JS to the database, which is a valid use case). Data will only be cleaned when putting it out
     * in the views (see the views for more info).
     * @param string $artist Artist
     * @param string $track Track
     * @param string $link Link
     */
    public function addSong($artist, $track, $link)
    {
        $sql = "INSERT INTO song (artist, track, link) VALUES (:artist, :track, :link)";
        $query = $this->db->prepare($sql);
        $parameters = array(':artist' => $artist, ':track' => $track, ':link' => $link);

        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        $query->execute($parameters);
    }

    /**
     * Delete a song in the database
     * Please note: this is just an example! In a real application you would not simply let everybody
     * add/update/delete stuff!
     * @param int $song_id Id of song
     */
    public function deleteSong($song_id)
    {
        $sql = "DELETE FROM song WHERE id = :song_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':song_id' => $song_id);

        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        $query->execute($parameters);
    }

    /**
     * Get a song from database
     */
    public function getSong($song_id)
    {
        $sql = "SELECT id, artist, track, link FROM song WHERE id = :song_id LIMIT 1";
        $query = $this->db->prepare($sql);
        $parameters = array(':song_id' => $song_id);

        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        $query->execute($parameters);

        // fetch() is the PDO method that get exactly one result
        return $query->fetch();
    }

    /**
     * Update a song in database
     * // TODO put this explaination into readme and remove it from here
     * Please note that it's not necessary to "clean" our input in any way. With PDO all input is escaped properly
     * automatically. We also don't use strip_tags() etc. here so we keep the input 100% original (so it's possible
     * to save HTML and JS to the database, which is a valid use case). Data will only be cleaned when putting it out
     * in the views (see the views for more info).
     * @param string $artist Artist
     * @param string $track Track
     * @param string $link Link
     * @param int $song_id Id
     */
    public function updateSong($artist, $track, $link, $song_id)
    {
        $sql = "UPDATE song SET artist = :artist, track = :track, link = :link WHERE id = :song_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':artist' => $artist, ':track' => $track, ':link' => $link, ':song_id' => $song_id);

        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        $query->execute($parameters);
    }

    /**
     * Get simple "stats". This is just a simple demo to show
     * how to use more than one model in a controller (see application/controller/songs.php for more)
     */
    public function getAmountOfSongs()
    {
        $sql = "SELECT COUNT(id) AS amount_of_songs FROM song";
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetch() is the PDO method that get exactly one result
        return $query->fetch()->amount_of_songs;
    }
}
