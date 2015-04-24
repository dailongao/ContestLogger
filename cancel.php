<?php
session_start();
require_once "util.php";
?>
<!DOCTYPE html>
<?php
if(isset($_POST['username'])){
  if($_POST['username'] == "zjp2015" && $_POST['password'] == "happy2015"){
    $_SESSION["login"] = 1;
  } else {
    $msg = "密码错误！";
  }
}
?>
<?php
if(isset($_POST['teampos']) && isset($_SESSION['login'])){
  $teampos = (int)$_POST['teampos'];
  $db = new SQLite3('zjp2015.db') or die("数据库炸了，找人来修");
  if(!$team_result=$db->query(sprintf('SELECT * from teams WHERE pid=%d',$teampos))->fetchArray())
    $msg = "该信封尚似乎未发出，请先要回信封并确认或重试";
}
?>
<html lang="zh-CN">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/all.css">
  </head>
  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand" href="index.php">2015 省赛登记</a>
          <a class="navbar-brand" href="cancel.php">收回信封</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <?php if(!isset($_SESSION["login"])) {?>
          <form class="navbar-form navbar-right" role="form" action="index.php" method="POST">
            <div class="form-group">
              <input type="text" name="username" placeholder="Username" class="form-control">
            </div>
            <div class="form-group">
              <input type="password" name="password" placeholder="Password" class="form-control">
            </div>
            <button type="submit" class="btn btn-success">Sign in</button>
          </form>
          <?php } else { ?>
            <div class="navbar-brand navbar-right">
              Working
            </div>
          <?php } ?>
        </div><!--/.navbar-collapse -->
      </div>
    </nav>

    <div class="container" style="max-width: 800px; padding-top: 100px;">
      <div class="flash-container">
        <div class="flash-alert">
        </div>
      </div>
      <?php if(isset($_SESSION["login"])) {  ?>
      <form action="cancel.php" method="POST">
		<div class="form-group">


	<h4><a href="index.php">返回登记页面</a></h4>
<!-- 未加美化 -->
	<p class="note">请务必完整的收回信封后再取消队伍与信封的关联</p>

          <label for="text">信封编号</label>
          <input type="text" name="teampos" size="5" <?php if(isset($_POST['teampos'])) echo "value=\"" . $_POST['teampos'] . "\"" ; ?> <?php if(!isset($team_result) || (isset($team_result) && !$team_result)) { ?>autofocus="autofocus"<?php } ?>></input>
        <button id="btn" type="submit" class="btn">查找</button></center>

        </div>
      </form>

      <?php if(isset($team_result) && $team_result){ ?>
        <div class="container-fluid">
          <?php 
			showteam($team_result);
		  ?>
        </div>
		<form action="ungao.php" method="POST">
	    <center>
        <div class="form-group">
          <label for="text">解除关联前请务必先完整地要回信封</label>
          <input type="hidden" name="teampos" value=<?=$_POST['teampos']?>>
        </div>
          <button id="btn" type="submit" class="btn">解除关联</button></center>
      </form>
      <?php } ?>

      <?php } else { ?>
        <center>
          <img src="img/logo.png">
          <h2 class="sub-header">Please login first</h2>
        </center>
      <?php } ?>
    </div>
  </body>
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/all.js"></script>
  <?php if(isset($_GET['msg'])) $msg = $_GET['msg']; ?>
  <?php if(isset($msg)) {?>
  <script>
      showmsg("<?=$msg?>");
  </script>
  <?php } ?>
</html>
