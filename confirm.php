<?php session_start(); ?>
<?php require './common.php'; ?>
<?php require('./dbconnect.php'); ?>
<?php $_SESSION['url'] =  $_SERVER['REQUEST_URI']; ?>
<?php
$_SESSION['msg1'] = "";
$_SESSION['msg2'] = "";
if (!isset($_SESSION['name'])){
  $_SESSION['msg1'] .= "氏名 ";
}
if (!isset($_SESSION['tel'])){
  $_SESSION['msg1'] .= "電話番号 ";
} else if (!validateInput($_SESSION['tel'], $pattern2)){
  $_SESSION['msg2'] .= "<p><font color='red'>不正な形式の電話番号です<br>電話番号は -（ハイフン）なしで、数字を入力してください</font></p><br>";
}
if (!isset($_SESSION['mail'])){
  $_SESSION['msg1'] .= "メールアドレス ";
} else if (!validateInput($_SESSION['mail'], $pattern1)){
  $_SESSION['msg2'] .= "<p><font color='red'>不正な形式のメールアドレスです</font></p><br>";
}
if ($_SESSION['msg1'] !== "") {
  $_SESSION['msg1'] = '<p><font color="red">'.$_SESSION['msg1'] . "を入力してください</font></p><br>";
}
if ($_SESSION['msg1'] !== "" || $_SESSION['msg2'] !== ""){
  echo 'name= '.$_SESSION['name'];
  header('Location:input.php');
}

//今月の日付　フォーマット　例）2020-10-2
if (!isset($rdate)){
  $today = date('Y-n-j');
} else {
  $today = $rdate;
}
$dttoday = new DateTime($today);
$dttoday2 = new DateTime($today);
//前週・次週の月日を取得
//1週間前
$sprev = $dttoday2->modify('-1 week');
$prev = $sprev->format('Y-n-j');
//1週間後（直前のmodifyで-1week しているので、+2weekする）
$snext = $dttoday2->modify('+2 week');
$next = $snext->format('Y-n-j');
?>

<?php require './header.php'; ?>
  <section id="reserve">
    <h2>予約する</h2>
    <div class="reserve-section">
      <?php
      $date = date('Y年n月j日',strtotime($_SESSION['rdate'])).'（'.$youbiarray[date('w',strtotime($_SESSION['rdate']))].'）';
      echo '<div class="reserve-box reserve-check">
              <div>
                <h3>予約情報確認</h3>
                <p>日付：'.$date.'</p>
                <p>時間：'.$_SESSION['rtimes'][0].' 時 '.$_SESSION['rtimes'][1].' 分</p>
                <p>メニュー：'.$menuname.'</p>
                <p>お名前：'.$_SESSION['name'].'</p>
                <p>お名前（フリガナ）：'.$_SESSION['namefuri'].'</p>
                <p>電話番号：'.$_SESSION['tel'].'</p>
                <p>メールアドレス：'.$_SESSION['mail'].'</p>
                <p>備考：'.$_SESSION['bikou'].'</p>
                <div class="reservecheck-button">
                  <form method="post" action="reserve.php">
                    <input type="hidden" name="menu"value="'.$_SESSION['menu'].'">
                    <input type="hidden" name="rdate" value="'.$_SESSION['rdate'].'">
                    <input type="hidden" name="rtime" value="'.$_SESSION['rtime'].'">
                    <input type="hidden" name="name"value="'.$_SESSION['name'].'">
                    <input type="hidden" name="namefuri"value="'.$_SESSION['namefuri'].'">
                    <input type="hidden" name="tel" value="'. $_SESSION['tel'].'">
                    <input type="hidden" name="mail" value="'.$_SESSION['mail'].'">
                    <input type="hidden" name="bikou" value="'.$_SESSION['bikou'].'">
                    <div class="reserve-button">
                      <button type="submit" formaction="input.php">戻る</button> 
                      <button type="submit" name="yok" value="1" formaction="ins.php">予約する</button> 
                    </div>
                  </form>
                </div>
              </div>
            </div>'
      ?>

    </div>
  </section>
<?php require './footer.php'; ?>