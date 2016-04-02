<?php // sqltest.php
  require_once 'login.php';
  $conn = new mysqli($hn, $un, $pw, $db);
  if ($conn->connect_error) die($conn->connect_error);

  if (isset($_POST['delete']) && isset($_POST['id']))
  {
    $id   = get_post($conn, 'id');
    $query  = "DELETE FROM mymusic WHERE id='$id'";
    $result = $conn->query($query);
    if (!$result) echo "DELETE failed: $query<br>" .
      $conn->error . "<br><br>";
  }

  if (isset($_POST['artist'])   &&
      isset($_POST['album']))
  {
    $artist   = get_post($conn, 'artist');
    $album = get_post($conn, 'album');
    $query    = "INSERT INTO mymusic (artist, album)  VALUES" .
      "('$artist', '$album')";
    $result   = $conn->query($query);
    if (!$result) echo "INSERT failed: $query<br>" .
      $conn->error . "<br><br>";
  }

  echo <<<_END
  <form action="mysqltest.php" method="post"><pre>
    Artist <input type="text" name="artist">
     Album <input type="text" name="album">
           <input type="submit" value="ADD RECORD">
  </pre></form>
_END;

  $query  = "SELECT * FROM mymusic";
  $result = $conn->query($query);
  if (!$result) die ("Database access failed: " . $conn->error);

  $rows = $result->num_rows;

  for ($j = 0 ; $j < $rows ; ++$j)
  {
    $result->data_seek($j);
    $row = $result->fetch_array(MYSQLI_NUM);

    echo <<<_END
  <pre>
        id $row[0]
    Artist $row[1]
     Album $row[2]
  </pre>
  <form action="mysqltest.php" method="post">
  <input type="hidden" name="delete" value="yes">
  <input type="hidden" name="id" value="$row[0]">
  <input type="submit" value="DELETE RECORD"></form>
_END;
  }

  $result->close();
  $conn->close();

  function get_post($conn, $var)
  {
    return $conn->real_escape_string($_POST[$var]);
  }
?>
