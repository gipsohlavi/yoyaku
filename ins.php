<?php 
session_start();
if (preg_match('/confirm.php$/',$_SESSION['url']) === 0) {
    header('Location: index.php');
}
?>
<?php require './common.php'; ?>
<?php require('./dbconnect.php'); ?>
<?php

//予約者確認
$sql=$db->prepare('SELECT c_id FROM customer
                    WHERE name = ? AND tel = ? AND mail = ?');
$sql->bindParam(1, $_SESSION['name']);
$sql->bindParam(2, $_SESSION['tel']);
$sql->bindParam(3, $_SESSION['mail']);
$sql->execute();
$cid = $sql->fetch();

//登録がなければ登録
if(!$cid){
    $sql=$db->prepare('INSERT INTO customer 
                        (name, namefuri, tel, mail) 
                        VALUE (?, ?, ?, ?)');
    $sql->bindParam(1, $_SESSION['name']);
    $sql->bindParam(2, $_SESSION['namefuri']);
    $sql->bindParam(3, $_SESSION['tel']);
    $sql->bindParam(4, $_SESSION['mail']);
    $sql->execute();
    $hoge = $db -> lastInsertId();
    $cid['c_id'] = $hoge;
}

//メニュー時間確認
$sql=$db->prepare('SELECT duration FROM menu
                    WHERE menu_id = ?');
$sql->bindParam(1, $_SESSION['menu']);
$sql->execute();
$result = $sql->fetch();

$duration = explode(':', $result['duration']);


//予約登録
$sql=$db->prepare('INSERT INTO reserve
                (c_id, menu_id, res_date, 
                comp_date, ins_date, bikou)
                VALUES(?, ?, ?, ?, ?, ?)');
$sql->bindParam(1, $cid['c_id']);
$sql->bindParam(2, $_SESSION['menu']);
$dt = new DateTime($_SESSION['rdate'].' '. $_SESSION['rtime']);
echo $dt->format('Y-m-d H:i:s') . '<br>';
$sql->bindParam(3, $dt->format('Y-m-d H:i:s'));
$dt2 = $dt->modify('+'.$duration['0'].' hour +' . $duration[1] . 'minute');
echo $dt2->format('Y-m-d H:i:s') . '<br>';
$sql->bindParam(4, $dt2->format('Y-m-d H:i:s'));
$now = date('Y-m-d H:i:s');
$sql->bindParam(5, $now);
$sql->bindParam(6, $_SESSION['bikou']);
$sql->execute();

header('Location: result.php');
?>