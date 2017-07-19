<?php 
  session_start();
  $_SESSION["himitu"]="nininomoziretu";

  //キャッシュ対策
  if( isset($_COOKIE['version']) ){
  $visit = $_COOKIE['version'];
  } else{ 
  $visit = 0;
  }
 
  $visit++; 
  setcookie('version', $visit); 

 //セッション情報取得
 if($_SESSION["himitu"] !="nininomoziretu"){
   exit("<p>不正な処理なので<a href=''>正しいページ</a>から送信し直してください</p>");
 }else{
   include "escape.php" ;     
   $_SESSION['postk']['k_name']=h($_POST['firstname']) . " " . h($_POST['lastname']);
   $_SESSION['postk']['k_huri']=h($_POST['firstname-furigana']) . " " . h($_POST['lastname-furigana']);
   $_SESSION['postk']['mail']=h($_POST['mail'],0);
   $_SESSION['postk']['tel']=h($_POST['tel1'])."-".h($_POST['tel2'])."-".h($_POST['tel3']);
   $_SESSION['postk']['zip']=h($_POST['zip21']) ."-".h($_POST['zip22']);
   $_SESSION['postk']['addr']=h($_POST['pref21']).h($_POST['addr21']).h($_POST['strt21']);

   $_SESSION['posty']['y_date']=h($_POST['y_date']);
   $_SESSION['posty']['y_time']=h($_POST['y_time']);
   $_SESSION['posty']['course']=h($_POST['course']);
   $_SESSION['posty']['ninzu']=h($_POST['ninzu']);
   $_SESSION['posty']['comment']= isset($_POST['comment'])? h($_POST['comment'],2): "" ;
   $_SESSION['posty']['kain']= isset($_POST['kain'])? "する": "しない" ;
 }
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name=viewport content="width=device-width, initial-scale=1">
  <title>確認画面</title>

  <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

  <link rel="stylesheet" href="yoyak.css?v=<?= $visit ?>" />

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

</head>
<body>
<div class="nyuryoku">
<?php
echo "<h3>ご予約の確認</h3>
       <li>ご予約希望日:  " . $_SESSION['posty']['y_date']
    . "<li>ご希望時間:  " . $_SESSION['posty']['y_time']
    . "<li>ご希望コース:  " . $_SESSION['posty']['course']
    . "<li>ご予約人数:  " . $_SESSION['posty']['ninzu']
    . "<li>メールアドレス:  " . $_SESSION['postk']['mail']
    . "<li>会員登録:  " . $_SESSION['posty']['kain']
    . "<li>TEL:  " . $_SESSION['postk']['tel']
    . "<li>ご住所: " . $_SESSION['postk']['addr']
    . "<li>お名前:  " . $_SESSION['postk']['k_name']. "様"
    . "<li>フリガナ:  " . $_SESSION['postk']['k_huri']
    . "<li>会員希望:  " . $_SESSION['posty']['kain']
    . "<li>コメント欄:  " . $_SESSION['posty']['comment'];
?>

<p>
<br><br>
<a class="btn btn-primary"  href="torok.php" role="button">この内容で予約する</a></p>
</div>
</body>
</html>