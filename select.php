<?php
//【重要】
//insert.phpを修正（関数化）してからselect.phpを開く！！
include("funcs.php");
$pdo = db_conn();

//２．データ登録SQL作成
$sql = "SELECT * FROM gs_bm_table";
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

//３．データ表示
$values = "";
if($status==false) {
  sql_error($stmt);
}

//全データ取得
$values =  $stmt->fetchAll(PDO::FETCH_ASSOC); //PDO::FETCH_ASSOC[カラム名のみで取得できるモード]
// $json = json_encode($values,JSON_UNESCAPED_UNICODE);

?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>書籍一覧表示</title>
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
      <a class="navbar-brand" href="index.php">書籍データ登録</a>
      </div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div>
    <div class="container jumbotron">

    <style>
  table {
    border-collapse: collapse; /* セルの間のスペースを統一 */
    width: 100%; /* 必要に応じて幅を指定 */
  }
  td {
    padding: 8px; /* 各セルの内側にスペースを追加 */
    border: 1px solid #ccc; /* 任意でセルの枠線を追加 */
  }
  a {
    text-decoration: none; /* リンクの下線を消す */
  }
</style>

      <table>
      <?php foreach($values as $v){ ?>
        <tr>
          <td><?=h($v["id"])?></td>
          <td><?=h($v["name"])?></td>
          <td><?=h($v["url"])?></td>
          <td><?=h($v["naiyou"])?></td>
          <td><?=h($v["indate"])?></td>
          <td><a href="detail.php?id=<?=h($v["id"])?>">更新</a></td>
          <td><a href="delete.php?id=<?=h($v["id"])?>">削除</a></td>
        </tr>
      <?php } ?>
      </table>

  </div>
</div>
<!-- Main[End] -->

<script>
  const a = '<?php echo $json; ?>';
  console.log(JSON.parse(a));
</script>
</body>
</html>
