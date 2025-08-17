<?php session_start(); ?>
<?php require './common.php'; ?>
<?php require('./dbconnect.php'); ?>

<?php require './header.php'; ?>
  <section id="reserve">
    <h2>予約完了</h2>
    <div class="reserve-section">
      <?php
      $date = date('Y年n月j日',strtotime($_SESSION['rdate'])).'（'.$youbiarray[date('w',strtotime($_SESSION['rdate']))].'）';
      //予約完了画面
        echo '<div class="reserve-box reserve-check">
          <div
            <br>
            <h4>下記内容で予約しました</h4>
            <br>
            <p>日付：'.$date.'</p>
            <p>時間：'.$_SESSION['rtimes'][0].' 時 '.$_SESSION['rtimes'][1].' 分</p>
            <p>メニュー：'.$menuname.'</p>
            <p>お名前：'.$_SESSION['name'].'</p>
            <p>電話番号：'.$_SESSION['tel'].'</p>
            <p>メールアドレス：'.$_SESSION['mail'].'</p>
            <p>備考：'.$_SESSION['bikou'].'</p>
          <br>
          <br>
          <br>
            <a href="index.php" class="reservation-button">TOPに戻る</a>
          </div>';
      ?>
      </div>
    </div>
  </section>
<?php require './footer.php'; ?>