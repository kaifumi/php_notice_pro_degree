<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> ろくまる農園</title>
</head>
<body>
<?php

// エラートラップ
try
{
$staff_name = $_POST['name'];
$staff_pass = $_POST['pass'];

// データベースに接続
$dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
$user = 'root';
$password = 'root';
$dbh = new PDO($dsn, $user, $password);
$dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// sqlで指令を出すプログラム
$sql = 'INSERT INTO mst_staff(name,password) VALUES (?,?)';
$stmt = $dbh -> prepare($sql);
$data[] = $staff_name;
$data[] = $staff_pass;
$stmt -> execute($data);

// データベースから切断
$dbh = null;

print $staff_name;
print 'さんを追加しました。<br/>';

}
// データベースサーバーに障害があるときにはこちらを表示
catch (Exception $e) {
    var_dump($e);
    var_dump($e);
    print 'ただいま障害により大変ご迷惑をおかけしております。';
    exit();
}

?>

<a href="staff_list.php">戻る</a>

</body>
</html>