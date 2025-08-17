<?php require './common.php'; ?>
<?php require('./dbconnect.php'); ?>
<?php session_start(); ?>
<?php session_destroy(); ?>
<?php require './header.php'; ?>
  <header>
    <h1>atelier noir</h1>
    <p>美と癒しのプライベート空間</p>
  </header>

  <section id="concept">
    <h2>Concept</h2>
    <div class="concept-section">
      <img src="./images/4141399_s.jpg" alt="施術中">
      <div class="concept-box">
        <h3>癒しきいってプライベート空間</h3>
        <p>心地よい照明、静かな空間、細やかな技術と上質な接客。<br>すべてがあなたのためにデザインされたひととき。</p>
      </div>
    </div>
  </section>
  
  <?php
  
  ?>
  <section id="menu">
    <h2>Menu</h2>
    <div class="menu-grid">
      <div class="menu-card">
        <img src="./images/4141399_s.jpg" alt="カット">
        <div class="menu-content">
          <p>カット</p>
          <div class="price-tag">¥4,000</div>
        </div>
      </div>
      <div class="menu-card">
        <img src="./images/32373878_s.jpg" alt="カラー">
        <div class="menu-content">
          <p>カラー</p>
          <div class="price-tag">¥7,000〜</div>
        </div>
      </div>
      <div class="menu-card">
        <img src="./images/2798743_s.jpg" alt="パーマ">
        <div class="menu-content">
          <p>パーマ</p>
          <div class="price-tag">¥8,000</div>
        </div>
      </div>
    </div>
    <div class="menu-grid">
      <div class="menu-card">
        <img src="./images/23259968_s.jpg" alt="ヘッドスパ">
        <div class="menu-content">
          <p>ヘッドスパ</p>
          <div class="price-tag">¥2,500</div>
        </div>
      </div>
      <div class="menu-card">
        <img src="./images/23259986_s.jpg" alt="ヘアメイク">
        <div class="menu-content">
          <p>ヘアメイク</p>
          <div class="price-tag">¥4,000〜</div>
        </div>
      </div>
      <div class="menu-card">
        <img src="./images/4069.JPG" alt="カープ">
        <div class="menu-content">
          <p>カープ</p>
          <div class="price-tag">¥1,000</div>
        </div>
      </div>
    </div>
    <div class="centered">
      <a href="selectmenu.php" class="reservation-button">予約する</a>
    </div>
  </section>

  <section id="info" class="info-section">
    <h2>店舗情報</h2>
    <div class="info-grid">
      <div class="info-text">
        <p><strong>住所：</strong>広島県〇〇区〇〇町</p>
        <p><strong>電話番号：</strong>0120-×××-××××</p>
        <p><strong>営業時間：</strong>9:00〜17:00</p>
        <p><strong>定休日：</strong>水曜日</p>
      </div>
      <div class="info-map">
        <iframe src="https://maps.google.com/maps?q=広島県〇〇区〇〇町&t=&z=13&ie=UTF8&iwloc=&output=embed" loading="lazy" allowfullscreen></iframe>
      </div>
    </div>
  </section>

<?php require './footer.php'; ?>