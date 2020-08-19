<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> ろくまる農園</title>
</head>
<body>

<?php

try
{
  // データベース接続
  $dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
  $user= 'root';
  $password = 'root';
  $dbh = new PDO($dsn, $user, $password);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // WHERE 1 で「全部」を指定
  $sql = 'SELECT code,name FROM mst_staff WHERE 1';
  $stmt = $dbh->prepare($sql);
  // execute()でプリペアドステートメントを実行
  $stmt->execute();

  $dbh = null;

  print 'スタッフ一覧<br/><br/>';

  // formで飛び先を設定
  print '<form method="post" action="staff_edit.php">';
  while(true)
  {
    // $stmtから1レコード取り出している
    $rec = $stmt->fetch(PDO::FETCH_ASSOC);

    if($rec == false)
    {
      // もしデータがなければループから脱出
      break;
    }
    print '<input type="radio" name="staffcode" value="' . $rec['code'] . '">';
    print $rec['name'];
    print '<br/>';
  }
  print '<input type="submit" value="修正">';
  print '</form>';
}
catch (Exception $e)
{
  print 'ただいま障害により大変ご迷惑をおかけしております。';
  exit();
}

?>

</body>
</html>
