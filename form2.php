<?php

session_start();

if(isset($_SESSION['name'])) {

$name = $_SESSION['name'];
$email = $_SESSION['email'];
$subject = $_SESSION['subject'];
$body = $_SESSION['body'];

}

//クロスサイトリクエストフォージェリ対策とリロード対策
$_SESSION['token'] =
base64_encode(openssl_random_pseudo_bytes(48));

$token =
htmlspecialchars($_SESSION['token'],ENT_QUOTES);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>確認画面</title>
</head>
<body>
  <form action="form3.php" method="post">
  <input type="hidden" name="token" value="<?php echo $token ;?>">
  <table>
  <tr>
  <th>お名前</th>
  <td><?php echo $name; ?></td>
  </tr>
  <tr>
  <th>メールアドレス</th>
  <td><?php echo $email; ?></td>
  </tr>
  <tr>
  <th>お問い合わせ内容</th>
  <td><?php echo nl2br($body); ?></td>
  </tr>
  <tr>
  <td colspan="2"><input type="submit" name="submit" value="送信する"></td>
  </tr>
  </table>
  </form>

  <p><a href="form1.php?action=edit">入力画面へ戻る</a></p>
</body>
</html>