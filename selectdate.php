<?php session_start(); ?>
<?php require './common.php'; ?>
<?php require('./dbconnect.php'); ?>
<?php
//inputから戻った時、msgを破棄
if(isset($_SESSION['msg1'])){
  $_SESSION['msg1'] = "";
}        
if(isset($_SESSION['msg2'])){
  $_SESSION['msg2'] = "";
}

//今月の日付　フォーマット　例）2020-10-2
if (!isset($_SESSION['rdate'])) {
  $today = date('Y-n-j');
} else if (preg_match('/input.php$/',$_SESSION['url'])) {
  $today = date('Y-n-j');
  $_SESSION['rdate'] = $today;
}else {
  $today = $_SESSION['rdate'];
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
<?php $_SESSION['url'] =  $_SERVER['REQUEST_URI']; ?>
<?php require './header.php'; ?>
  <section id="reserve">
    <h2>予約する</h2>
    <div class="reserve-section">
    <?php
      //時間選択
      $sql=$db->prepare('SELECT r.res_date, r.comp_date FROM reserve r
                          WHERE r.res_date >= ?'); //DBから予約日時と席が空く時間を取得
      $sql->bindparam(1,$today); //本日以降
      $sql->execute();
      $result = $sql->fetchALL();
      $i=0;
      if (isset($result)){
        foreach ($result as $row){
          $resdata[$i] = explode(" ",$row['res_date']);
          $hoge = explode(" ",$row['comp_date']);
          $resdata[$i][2] = $hoge[1];
          $i++;
        }
      }
      if(isset($resdata)){
        $_SESSION['yoyaku'] = $resdata; //画面遷移時のため、SESSIONに保存 
      }
      $sql=$db->prepare('SELECT m.duration FROM menu m 
                          WHERE m.menu_id = ?'); //DBから予約日時と席が空く時間を取得
      $sql->bindparam(1,$_SESSION['menu']); //本日以降
      $sql->execute();
      foreach ($sql as $row){
        $duration = explode(":",$row['duration']);
      }
      if(!isset($duration)){
        $duration[0] = 0; //画面遷移時のため、SESSIONに保存 
        $duration[1] = 0; //画面遷移時のため、SESSIONに保存 
      }

      ?>
      <div class="reserve-box">            
        <h3>時間選択</h3>
        <div class="calender day-reserve">
          <?php
          //１週間ことの情報を画面表示
          if (!isset($_SESSION['rdate']) || $_SESSION['rdate'] === date('Y-n-j')){ //本日以前は表示させない
            echo '<h3><font color="white">&lt;&nbsp;前の週</font>　次の週<a href="?menu='. $_SESSION['menu'] .'&rdate='. $next .'">&nbsp;<font color="white">&gt;</font></a></h3>';
          } else {
            echo '<h3><a href="?menu='. $_SESSION['menu'] .'&rdate='. $prev .'"><font color="white">&lt;</font>&nbsp;</a>前の週　次の週<a href="?menu='. $_SESSION['menu'] .'&rdate=' .$next .'">&nbsp;<font color="white">&gt;</font></a></h3>';
          }
          ?>
          <table class="table table-bordered">        
            <tr>
              <th></th>
              <?php
              //１週間分の日付表示
              for ($i=0; $i<=6; $i++){
                if ($dttoday->format("w") === "0") {
                  echo '<th class="calender-date sunday">'.$dttoday->format("n月j日").'('.$youbiarray[$dttoday->format("w")].')</th>';
                } else if ($dttoday->format("w") === "6"){
                  echo '<th class="calender-date saturday">'.$dttoday->format("n月j日").'('.$youbiarray[$dttoday->format("w")].')</th>';
                } else {
                  echo '<th class="calender-date">'.$dttoday->format("n月j日").'('.$youbiarray[$dttoday->format("w")].')</th>';
                }
                $dttoday->modify("+1 day");
              }
              ?>
            </tr>

            <!-- 各日付、時間帯ごとの予約状況表示 -->
            <?php
            //XX:30の時刻表示用変数
            $thirty = false;
            $i = 9;
            while ($i<=18) { //18時まで表示
              $dttoday = new DateTime($today);
              echo '<tr>';
              for ($n=0; $n<=7; $n++){ //7日分
                if ($n===0){ //n===0の時は時刻表示
                  if ($thirty && $i === 18) { //18:00で表示を止めるための処理
                    $i++;
                    break;
                  } else if ($thirty) { //XX:30の時刻表示用変数
                    $reservetime = sprintf('%02d',$i) . ':30';
                    echo '<td>'.$reservetime.'</td>';
                    $thirty = false;
                    $i++;
                  } else { //XX:00の時刻表示用変数
                    $reservetime = sprintf('%02d',$i) . ':00';
                    echo '<td>'.$reservetime.'</td>';
                    $thirty = true;
                  }
                } else { //n!==0の時はボタンを表示
                  $flag = true;
                  if (isset($_SESSION['yoyaku'])){
                    foreach ($_SESSION['yoyaku'] as $row){
                      if ($dttoday->format('Y-m-d') === $row[0]){
                        $start = new DateTime($row[0] .' ' .$row[1]);
                        $start->modify('-'.(int)$duration[0].' hour -'. (int)$duration[1].'minute');
                        if ($reservetime >= $start->format('H:i') && $reservetime <= substr($row[2],0,5)){
                          $flag = false;
                        }
                      }
                    }
                  }
                  if ($dttoday->format("w") === "3"|| (!$flag)) { //水曜時はボタンを非表示
                    echo '<td>×</td>';
                  } else { //ボタン表示してデータをPOST
                    echo '<td><form method="post" action="input.php">';
                    echo  '<input type="hidden" name="menu"value="'.$_SESSION['menu'].'">';
                    echo '<input type="hidden" name="rtime" value="'.$reservetime.'">';
                    echo '<button type="submit" name="rdate" value="'.$dttoday->format('Y-m-j').'">◎</button>';
                    echo '</form></td>';
                  }
                  $dttoday->modify('+1 day');
                }
              }
              echo '</tr>';
            }
            ?>
          </table>
        </div>   
        <form action="selectmenu.php">
          <div class="reserve-button">
            <button type="submit">戻る</button>
          </div>
        </form>
      </div>
    </div>
  </section>
<?php require './footer.php'; ?>