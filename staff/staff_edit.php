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
  $staff_code = $_POST['staffcode'];

  // データベース接続
  $dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
  $user= 'root';
  $password = 'root';
  $dbh = new PDO($dsn, $user, $password);
  // アロー演算子でsetAttribute()メソッドを呼び出している
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // ?しておくことで、あとから$data[]に挿入する形で値を入れれる
  $sql = 'SELECT name FROM mst_staff WHERE code = ?';
  $stmt = $dbh->prepare($sql);
  $data[] = $staff_code;
  // アロー演算子でexecute()メソッドを呼び出している
  $stmt->execute($data);

  $rec = $stmt->fetch(PDO::FETCH_ASSOC);
  $staff_name = $rec['name'];

  $dbh = null;
}
catch (Exception $e)
{
  print 'ただいま障害により大変ご迷惑をおかけしております。';
  // 強制終了の命令
  exit();
}
?>

スタッフ修正<br/>
<br/>
スタッフコード<br/>
<?php print $staff_code; ?>
<br/>
<br/>
<form method="post" action="staff_edit_check.php">
  <input type="hidden" name="code" value="<?php print $staff_code; ?>">
  スタッフ名<br/>
  <input type="text" name="name" style="width:200px" value="<?php print $staff_name;?>"><br/>
  パスワードを入力してください。<br/>
  <input type="password" name="pass" style="width:100px"><br/>
  パスワードをもう一度入力してください。<br/>
  <input type="password" name="pass2" style="width:100px"><br/>
  <br/>
  <input type="button" onclick="history.back()" value="戻る">
  <input type="submit" value="OK">
</form>
</body>
</html>
