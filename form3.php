<?php 
session_start();

if(isset($_POST['token'],
$_SESSION['token']) && ($_POST['token'] ===
$_SESSION['token'])) {
  unset($_SESSION['token']);
  
 
$name = $_SESSION['name'];
$email = $_SESSION['email'];
$subject = $_SESSION['subject'];
$body = $_SESSION['body'];

 $dsn = 'mysql:dbname=contact_form;host=localhost;charset=utf8';
 $username = 'root';
 $password= '';

//インスタンス化
 $dbh = new PDO( $dsn,$username ,$password);
 //PDOオブジェクトのqueryメソッドの呼び出し。文字化けを防ぐ
 $dbh->query('SET NAMES utf8');
 //セキュリティ対策
 $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);

 //プレースホルダ
 $sql = 'INSERT INTO inquiries(name,email,subject,body) VALUES (?,?,?,?)' ;
 //PDOオブジェクトのprepareメソッドの呼び出し。SQL文を準備するためのメソッド
 $stmt = $dbh->prepare($sql);
 //PDOstatementオブジェクトのbindvalueメソッドを呼び出し変数の値とプレースホルダを結びつける。
 $stmt->bindvalue(1,$name,PDO::PARAM_STR);
 $stmt->bindvalue(2,$email,PDO::PARAM_STR);
 $stmt->bindvalue(3,$subject,PDO::PARAM_STR);
 $stmt->bindvalue(4,$body,PDO::PARAM_STR);

 $stmt->execute();

 $dbh = null ;

 $_SESSION = array();
 if(ini_get("session.use_cookies")){
   $params = session_get_cookie_params();
   setcookie(session_name(), '',time()-4200,
   $params["path"],
   $params["domain"],
   $params["secure"],
   $params["httponly"]);

 }
session_destroy();

}else {
  header("Location:form1.php");
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>完了画面</title>
</head>
<body>
<p>お問い合わせありがとうございます。</p>  
<a  href="form1.php">
<input type="submit" value="ホームへ" >
</a>

</body>

</html>