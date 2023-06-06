<?php
//0. SESSION開始！！
session_start();

//1.  DB接続します
include("funcs.php");
$pdo = db_conn();

//２．データ登録SQL作成
$sql = "SELECT * FROM gs_bm_table";
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

//３．データ表示
$view="";
if($status==false) {
  //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("SQLError:".$error[2]);
}

//全データ取得
$values =  $stmt->fetchAll(PDO::FETCH_ASSOC); //PDO::FETCH_ASSOC[カラム名のみで取得できるモード]

?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>BookMark表示</title>
<link rel="stylesheet" href="css/range.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
<style>div{padding: 10px;font-size:16px;}</style>
</head>
<body id="main">
<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
      <a class="navbar-brand" href="bm_index.php">本の登録</a>
      <a class="navbar-brand" href="bm_logout.php">LOGOUT</a>
      </div>
    </div>
  </nav>
</header>
<!-- Head[End] -->


<!-- Main[Start] -->
<div>
<div><?=$_SESSION["name"]?>さん、こんにちは</div>
  <div class="container jumbotron">
    <table border="1">
    <?php foreach($values as $v){ ?>
        <tr>
          <td><?=$v["id"]?></td>
          <td><a href="bm_update_view.php?id=<?=$v["id"]?>"><?=$v["title"]?></a></td>
          <td><?=$v["url"]?></td>
          <td><?=$v["comment"]?></td>
          <td><?=$v["indate"]?></td>
          <?php if($_SESSION["kanri_flg"]==1){ ?>
          <td><a href="bm_delete.php?id=<?=$v["id"]?>">🗑️</a></td>
          <?php } ?>
        </tr>
    <?php } ?>
    </table>

  </div>
</div>
<!-- Main[End] -->
</body>
</html>
