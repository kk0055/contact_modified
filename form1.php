<?php
session_start();

//$errorという連想配列を定義。この段階ではキー,値はなし
$errors = array();

if(isset($_POST['submit'])){



$name = $_POST['name'];
$email = $_POST['email'];
$subject = $_POST['subject'];
$body = $_POST['body'];

//htmlspecialchars - &,<,>ｗｐ&amp;,&It,&gtに変換 セキュリティ目的
$name = htmlspecialchars($name,ENT_QUOTES);
$email = htmlspecialchars($email,ENT_QUOTES);
$subject = htmlspecialchars($subject,ENT_QUOTES);
$body = htmlspecialchars($body,ENT_QUOTES);

if($name === "") {
  //nameというキーを作り"お名前が入力されておりません。"という文字列を値に格納
  $errors['name'] = "お名前が入力されておりません。";
}

if($email === "") {
  $errors['email'] = "メールアドレスが入力されておりません。";
}

if($body === "") {
  $errors['body'] = "お問い合わせ内容が入力されておりません。";
}

if(count($errors) === 0) {

  $_SESSION['name'] = $name;
  $_SESSION['email'] = $email;
  $_SESSION['subject'] = $subject;
  $_SESSION['body'] = $body;
  header("location:form2.php");
 
  exit();
}
}


if(isset($_GET['action']) &&
$_GET['action'] === 'edit') {

  $name = $_SESSION['name'];
  $email = $_SESSION['email'];
  $subject = $_SESSION['subject'];
  $body = $_SESSION['body'];
} 




?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>お問い合わせ</title>
</head>
<body>
<h1>問い合わせフォーム</h1>
<?php echo "<ul>"; 
foreach($errors as $error) {
  echo "<li>";
  echo $error;
  echo "</li>";
}

?>

<?php echo "</ul>"; ?>

<form action="form1.php" method="post">
<table>
<tr>
<th>お名前</th>
<td><input type="text" name="name" value="<?php if(isset($name)) {echo $name; } ?>"></td>
</tr>
<tr>
<th>メールアドレス</th>
<td><input type="text" name="email"  value="<?php if(isset($email)) {echo $email; } ?>"></td>
</tr>
<tr>
<th>お問い合わせの種類</th>
<td>
<select name="subject" id="">
<option value="お仕事に関するお問い合わせ" <?php if(isset($subject) && $subject === "お仕事に関するお問い合わせ") {echo "selected";} ?>>
お仕事に関するお問い合わせ
</option>
<option value="その他のお問い合わせ" <?php if(isset($subject) && $subject === "その他のお問い合わせ") {echo "selected";} ?>>
その他のお問い合わせ
</option>
</select>
</td>
</tr>
<tr>
<th>お問い合わせ内容</th>
<td><textarea name="body" cols="30" rows="10">
<?php if(isset($body)) { echo $body ;} ?>
</textarea></td>
</tr>
<tr>
<td colspan="2">
<br>
プライバシーポリシーに同意する <input type="checkbox" id="myCheck" onclick="myFunction()">
<input type="submit" name="submit" id ="submit" value="確認画面へ" disabled></td></tr>

</table>
</form>

<script>
function myFunction() {
  // Get the checkbox
  var checkBox = document.getElementById("myCheck");
  // Get the output text
  var text = document.getElementById("text");
  var sub = document.getElementById("submit");

  // If the checkbox is checked, display the output text
  if (checkBox.checked == true){
    sub.disabled = false;
  } else {
   
    sub.disabled = true;
  }
}
 </script>
</body>
</html>