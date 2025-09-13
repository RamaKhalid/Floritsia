<!-- BY Jumana -->
<?php
  // DATABASE CONFIG
  define("DB_HOST", "localhost");
  define("DB_NAME", "floritsia");
  define("DB_CHARSET", "utf8mb4");
  define("DB_USER", "root");
  define("DB_PASSWORD", "");

  // CONNECT TO DATABASE
  $pdo = new PDO(
    "mysql:host=".DB_HOST.";charset=".DB_CHARSET.";dbname=".DB_NAME,
    DB_USER, DB_PASSWORD, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
  ]);

  // SEARCH
  $stmt = $pdo->prepare("SELECT * FROM `items` WHERE `item_name` LIKE ?");
  $stmt->execute(["%".$_POST["search"]."%"]);
  $itemresults = $stmt->fetchAll();
  if (isset($_POST["ajax"])) { echo json_encode($itemresults); }
?>