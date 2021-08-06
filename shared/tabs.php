
  <div class="row" id="main_tabs">
    <div class="col-3 col-lg-3 <?php echo ($activeTab == "HOME") ? "active" : ";" ?>">
      <a href="home.php" class="text">Home</a>
    </div>
    <div class="col-3 col-lg-3 <?php echo ($activeTab == "MESSAGES") ? "active" : ";" ?>">
        <a class="text" href="messages.php?pageToGoBackTo=<?php echo $pageToGoBackTo;?>">Messages</a>
    </div>
    <div class="col-3 col-lg-3 <?php echo ($activeTab == "VIDEOS") ? "active" : ";" ?>">
      <a href="videos.php" class="text">Videos</a>
    </div>
    <div class="col-3 col-lg-3 <?php echo ($activeTab == "PROFILE") ? "active" : ";" ?>">
        <a class="text" href="profile.php">Profile</a>
    </div>
  </div>
