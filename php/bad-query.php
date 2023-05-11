<html>
  <head>
    <title>Table content</title>
  </head>
  <body>
    <h1>My table contains:</h1>
<?php
  function get_city($connection, $city_id) {
    $query = "select * from city where id=$city_id";
    $stmt = $connection->prepare($query);
    $stmt->execute();
    if ($result = $stmt->fetch()) {
      return array($result["city_name"], $result["postcode"]);
    }
    return array("", "");
  }

  function get_language($connection, $language_id) {
    $query = "select * from langage where id=$language_id";
    $stmt = $connection->prepare($query);
    $stmt->execute();
    if ($result = $stmt->fetch()) {
      return array($result["language_label"], $result["language_code"]);
    }
    return array("", "");
  }

  $servername = "localhost";
  $username = "root";
  $password = "toto123";
  $mysql_port = 3306;
  $dbname = "my_db";

  try {
    $conn = new PDO("mysql:host=$servername;port=$mysql_port;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query = "select * from utilisateur";
    
    $stmt = $conn->prepare($query);
    $stmt->execute();

    echo("<table><tr>
      <td>Nom</td>
      <td>Prénom</td>
      <td>Ville</td>
      <td>Code postal</td>
      <td>Langage</td>
      <td>Code langage</td>
    </tr>");

    while ($row = $stmt->fetch()) {
      $first_name = $row["first_name"];
      $last_name = $row["last_name"];
      list($city_name, $postcode) = get_city($conn, $row["city_id"]);
      list($langage, $code_langage) = get_language($conn, $row["language_id"]);
      echo("<tr>
        <td>$last_name</td>
        <td>$first_name</td>
        <td>$city_name</td>
        <td>$postcode</td>
        <td>$langage</td>
        <td>$code_langage</td>
      </tr>");
    }

    echo("</table>");

    $conn = null;
  } catch(PDOException $e) {
    echo "<p>Connection failed: " . $e->getMessage() . "</p>";
  }
?>
  </body>
</html>
