<!DOCTYPE html>
<head>
  <title>HomePage</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <style>li {list-style: none;}</style>
</head>
<body>
  <h2>Supply bookid and enter</h2>
  <ul>
    <form name="display" action="index.php" method="POST" >
      <li>Book ID:</li>
      <li><input type="text" name="bookid" /></li>
      <li><input type="submit" name="submit" /></li>
    </form>
  </ul>
  <?php
    // Connect to the database.
    $results = DB::select( DB::raw("SELECT * FROM book WHERE title = :title"), array(
      'title' => $title,
    ));
    print_r($results);
    ?>
</body>
</html>
