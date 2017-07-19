<?php 
  session_start();
  $_SESSION["himitu"]="**************";

  if( isset($_COOKIE['version']) ){ // クッキーがあればその値がカウント値
  $visit = $_COOKIE['version'];
  } else{ // クッキーがなければ初回訪問としてカウント値は0
  $visit = 0;
  }
 
  $visit++; // カウント値+1
  setcookie('version', $visit); // 有効期限なしのクッキーを設定

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name=viewport content="width=device-width, initial-scale=1">
  <title>レストラン予約フォーム</title>

  <link rel="stylesheet" href="yoyak.css?v=<?= $visit ?>" />

  <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

  <link rel="stylesheet" href="bootstrap.css">
  <script src="bootstrap.js"></script>

  <script src="validator.js"></script>
  <script src="validator.min.js"></script>

  <link rel="stylesheet" href="jquery.datetimepicker.css">
  <script src="jquery.datetimepicker.js"></script>

  <script src="jquery.autoKana.js"></script>

  <script src="ajaxzip3.js"></script>

</head>
<body>

<div class="waku">
<div class="container-fluid">
 <div class="row">
 <h2>神楽坂予約フォーム</h2>
 <br>


 <div class="form-group">
 <form data-toggle="validator" role="form" method="post" action="kakunin.php">

   <ul>
   <li>★ご予約希望日</li>
   <input type="text" name="y_date" id="y_date" class="mawari" value="" 
          placeholder="カレンダーから選択してください" size="27" autocomplete="off" required>
  <br><br>       
  <li>★ご希望時間</li>
  <input type="radio" name="y_time" id="runch" value="ランチ" required>ランチ
  <input type="radio" name="y_time" id="diner" value="ディナー" required>ディナー
  
  <div class="none" id="cr">
  <select name="course" class="mawari" required>
    <option value="選択されていません"  required>下からお選びください</option>
    <option value="美食の歓びコース(ランチ)" required>美食の歓びコース</option>
    <option value="至福の午餐会コース(ランチ)" required>至福の午餐会コース</option>
  </select>
  </div>

  <div class="none" id="cl">
  <select name="course" class="mawari" required>
    <option value="選択されていません" required>下からお選びください</option>
    <option value="ムニュKAGURA～神楽～" required>ムニュKAGURA～神楽～(ディナー)</option>
    <option value="シェフ大堀スペシャルディナーコース" required>シェフ大堀スペシャルディナーコース(ディナー)</option>
   </select>
   </div>
   <br><br>

 <li>★ご予約人数</li>
 <input type="text" name="ninzu" id="ninzu" class="mawari" maxlength="2" size="1" required>名
 <br><br>

  <div class="form-group has-feedback col-md-4">          
  <li>★メールアドレス</li>
      <input type="email" name="mail" class="form-control" id="inputEmail" placeholder="Email" data-error="メールアドレスが正しく入力されておりません" data-required-error="メールアドレスの入力は必須です" required>
      <div class="help-block with-errors"></div>
  </div>

  <div class="col-md-12">
  <li>★会員登録のご希望</li>
  <input type="radio" name="kain" required>希望する
  <input type="radio" name="kain" required>希望しない<br><br></div>
  <br>

  <div class="col-md-12">
  <li>★TEL</li>
   <lavel>
     <input type="text" name="tel1" size="4" maxlength="4" required> - <input type="text" name="tel2" size="4" maxlength="4" required> - <input type="text" name="tel3" size="4" maxlength="4" required>
   </lavel><br></div> 
   <br><br>

  <div class="col-md-12">
  <br>
  <li>★ご住所</li>
   <ul>
    <li>郵便番号<br>
   <lavel>
      <input type="text" name="zip21" size="4" maxlength="3" required> － <input type="text" name="zip22" size="5" maxlength="4" onKeyUp="AjaxZip3.zip2addr('zip21','zip22','pref21','addr21','strt21');" required>
      <br>

    <li>都道府県</li>
      <input type="text" name="pref21" size="40"><br>
    <li>市町村</li>
      <input type="text" name="addr21" size="40"><br>
    <li>番地建物名</li>
      <input type="text" name="strt21" size="40" pattern="(.*[0-9一二三四五六七八九十].*)"><br>
    <br></lavel>
    </ul></div>
   
  <div class="col-md-12">
  <li>★お名前</li>
      <input type="text" name="firstname" id="firstname" placeholder="姓" required>
      <input type="text" name="lastname" id="lastname" placeholder="名" required><br>
  <li>★フリガナ</li>
      <input type="text" name="firstname-furigana" id="firstname-furigana" placeholder="セイ">
      <input type="text" name="lastname-furigana" id="lastname-furigana" placeholder="メイ">
  <br>
  <br>

  <li>★コメント</li>
    <textarea name="comment" rows="5" cols="60" placeholder="その他ご要望やアレルギー食材などございましたらご記入ください。"></textarea>
    <br><br>
  </div>

  <p><input type="submit" class="btn btn-primary" value="確認"></p>

</form>
</div>
</div>
</div>
</div>
<script>
$('#y_date').datetimepicker({
		lang:'ja',
		minDate : '-1970/01/01',
		maxDate : '+1970/01/31',
		timepicker:false,
		format: 'Y-m-d'		
	}); 

jQuery('#y_time').datetimepicker({
  datepicker:false,
  format:'H:i'
});

 $(function() {
    $.fn.autoKana('#firstname', '#firstname-furigana', {katakana:true});
    $.fn.autoKana('#lastname', '#lastname-furigana', {katakana:true});
 });

$('#runch').click(function(){
 $('#cr').show();
 $('#cl').hide();
});
$('#diner').click(function(){
 $('#cl').show();
 $('#cr').hide();
});

$('#ninzu').change(
  function(){
  var ns =$('#ninzu').val();
  if(res =ns.match(/^[0-9０-９]{1,2}$/)){
    res=true;
  }else{
    alert('ご予約人数を数字で入力してください');   
  }      
  }
  );

$('#num').change(function(){
  nStr = $('#num').val();
   if(!nStr.match(/^[0-9]{1,2}$/ ) || nStr >12 || nStr < 1 ) {
  alert("1~12までの数字で入れてください");
}
})

</script>

</body>
</html>