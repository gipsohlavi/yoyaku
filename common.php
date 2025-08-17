<?php
//タイムゾーンを設定
date_default_timezone_set('Asia/Tokyo');

// バリデーション
function validateInput($input, $pattern) {
    return preg_match($pattern, $input) === 1;
}
// バリデーションに使う正規表現
$pattern1= "/^\A([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+\z$/";
$pattern2= "/^[0-9]{2,4}[0-9]{2,4}[0-9]{3,4}$/";

//ページ遷移用のフラグ
$gosign = false;

$menunames = [
  'カット', //0
  'カラー', //1
  'パーマ', //2
  'ヘッドスパ', //3
  'ヘアメイク', //4
  'カープ', //5
];

//POSTされた情報を整形して変数に格納
if(isset($_REQUEST['menu'])){
  $_SESSION['menu'] = $_REQUEST['menu'];
} else if (!isset($_SESSION['menu'])) {
  $_SESSION['menu'] = null;
}
if(isset($_SESSION['menu']) && $_SESSION['menu'] !== ""){
  $menuname = $menunames[$_SESSION['menu']]; 
}

$youbiarray = [
  '日', //0
  '月', //1
  '火', //2
  '水', //3
  '木', //4
  '金', //5
  '土', //6
];

//POSTされた情報を整形して変数に格納
if(isset($_REQUEST['rdate'])){
  $_SESSION['rdate'] = $_REQUEST['rdate'];
} else if (!isset($_SESSION['rdate'])) {
  $_SESSION['rdate'] = null;
}

//POSTされた情報を整形して変数に格納
if(isset($_REQUEST['rtime'])){
  $_SESSION['rtime'] = $_REQUEST['rtime'];
  $_SESSION['rtimes'] = explode(":",$_REQUEST['rtime']);
} else if (!isset($_SESSION['rtime'])) {
  $_SESSION['rtime'] = null;
}

//POSTされた情報を整形して変数に格納
if(isset($_REQUEST['name']) && $_REQUEST['name'] !== ""){
  $_SESSION['name'] = htmlspecialchars($_REQUEST['name']);
} else if (!isset($_SESSION['name'])) {
  $_SESSION['name'] = null;
}

//POSTされた情報を整形して変数に格納
if(isset($_REQUEST['namefuri']) && $_REQUEST['namefuri'] !== ""){
  $_SESSION['namefuri'] = htmlspecialchars($_REQUEST['namefuri']);
} else if (!isset($_SESSION['namefuri'])) {
  $_SESSION['namefuri'] = null;
}

//POSTされた情報を整形して変数に格納
if(isset($_REQUEST['tel']) && $_REQUEST['tel'] !== ""){
  $_SESSION['tel'] = htmlspecialchars($_REQUEST['tel']);
} else if (!isset($_SESSION['tel'])) {
  $_SESSION['tel'] = null;
}
//POSTされた情報を整形して変数に格納
if(isset($_REQUEST['mail']) && $_REQUEST['mail'] !== ""){
  $_SESSION['mail'] = htmlspecialchars($_REQUEST['mail']);
} else if (!isset($_SESSION['mail'])) {
  $_SESSION['mail'] = null;
}
//POSTされた情報を整形して変数に格納
if(isset($_REQUEST['bikou'])){
  $_SESSION['bikou'] = htmlspecialchars($_REQUEST['bikou']);
} else if (!isset($_SESSION['bikou'])) {
  $_SESSION['bikou'] = null;
}
?>