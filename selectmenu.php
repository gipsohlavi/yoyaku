<?php session_start(); ?>
<?php require './common.php'; ?>
<?php require('./dbconnect.php'); ?>
<?php $_SESSION['url'] =  $_SERVER['REQUEST_URI']; ?>
<?php require './header.php'; ?>
  <section id="reserve">
    <h2>予約する</h2>
    <div class="reserve-section">
      <div class="reserve-box reserve-menu">
        <h3>メニューの選択</h3>
        <form method="post" action="selectdate.php">
        <?php
        $_SESSION['check'] = false;
        //メニュー選択
        if (isset($_SESSION['menu']) && ($_SESSION['menu'] === "")){
          echo '<p><font color=red>※メニューを選択してください※</font></p>';
        }
        ?>
          <select name="menu">
            <option value="">&nbsp;--メニューを選んでください--&nbsp;</option>
            <?php 
            $sql = $db->query('SELECT * FROM menu');
            $sql->execute();
            foreach ($sql as $row) {
              echo '<option value="'.$row['menu_id'].'">
                &nbsp;'.$row['menu_name'].' ----------------------'. 
                number_format((int)$row['kingaku']).'円</option>';
            }
            ?>
          </select>
          <div class="reserve-button">
            <button type="submit" value="next">次へ</button>
          </div>
        </form>
      </div>
    </div>
  </section>
<?php require './footer.php'; ?>