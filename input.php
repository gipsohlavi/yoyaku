<?php session_start(); ?>
<?php if(!preg_match('/confirm.php$/',$_SESSION['url'])) {
  $_SESSION['check'] = true;
}
?>
<?php require './common.php'; ?>
<?php require('./dbconnect.php'); ?>
<?php $_SESSION['url'] =  $_SERVER['REQUEST_URI']; ?>
<?php
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
      <div class="reserve-box reserve-input">
        <h3>予約情報入力</h3>
        <?php
        //個人情報入力
        if(!isset($_SESSION['msg1'])){
          $_SESSION['msg1'] = "";
        }        
        if(!isset($_SESSION['msg2'])){
          $_SESSION['msg2'] = "";
        }
        echo $_SESSION['msg1'] . $_SESSION['msg2']; 
        ?>
        <div class="reserve-form">
        <?php 
          $date = date('Y年n月j日',strtotime($_SESSION['rdate'])).'（'.$youbiarray[date('w',strtotime($_SESSION['rdate']))].'）';
          echo '<p>選択日時：　'. $date . $_SESSION['rtimes'][0].' 時 '.$_SESSION['rtimes'][1].' 分</p>'; 
        ?>
        <br>
        <form method="post" action="confirm.php">
          <table class="table table-bordered table-input">
            <tr>
              <td class="inputname">
                <div class="l-text">お名前</div>
                <div class="r-text"><font color="red">※必須</font></div>
              </td>
              <td>
                <?php echo '<input type="text" name="name" value="'.$_SESSION['name'].'" size=25>';?>
              </td>
            </tr>
            <tr>
              <td class="inputname">
                <div class="l-text">お名前（フリガナ）</div>
                <div class="r-text"><font color="red">※必須</font></div>
              </td>
              <td>
                <?php echo '<input type="text" name="namefuri" value="'.$_SESSION['namefuri'].'" size=25>';?>
              </td>
            <tr>
            <tr>
              <td class="inputname"> 
                <div class="l-text">電話番号<font color="red">　-（ハイフン）なし</font></div>
                <div class="r-text"><font color="red">※必須</div>
              </td>
              <td>
                <?php echo '<input type="text" name="tel" value="'.$_SESSION['tel'].'" size=25>';?>
              </td>
            <tr>
            <tr>
              <td class="inputname">
                <div class="l-text">メールアドレス</div>
                <div class="r-text"><font color="red">※必須</font></div>
              </td>
              <td>
                <?php echo '<input type="text" name="mail" value="'.$_SESSION['mail'].'" size=25>';?>
              </td>
            <tr>
            <tr>
              <td class="inputname">
                <div>備　　考</div>
              </td>
              <td>
                <?php echo '<textarea name="bikou" rows="5" cols="60">'.$_SESSION['bikou'].'</textarea>';?>
              </td>
            <tr>
          </table>
          <?php
            echo '<input type="hidden" name="menu"value="'.$_SESSION['menu'].'">';
            echo '<input type="hidden" name="rdate" value="'.$_SESSION['rdate'].'">';
            echo '<input type="hidden" name="rtime" value="'.$_SESSION['rtime'].'">';
          ?>
          <br>
          <div class="reserve-button">
            <button type="submit" formaction="selectdate.php">戻る</button>  
            <button type="submit">確認する</button>
          </div>
        </form>
        </div>
      </div>
    </div>
  </section>
<?php require './footer.php'; ?>