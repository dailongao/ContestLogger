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
if(isset($_POST['teamcode']) && isset($_SESSION['login'])){
  $teamcode = (int)$_POST['teamcode'];
  $db = new SQLite3('zjp2015.db') or die("数据库炸了，找人来修");
  if(!$team_result=$db->query(sprintf('SELECT * from teams WHERE id=%d',$teamcode))->fetchArray())
    $msg = "找不到该队伍编号，请重试";
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
          <a class="navbar-brand" href="cancel.php">撤销</a>
          <a class="navbar-brand" href="registered.php">注册完成列表</a>
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
      <form action="index.php" method="POST">
        <div class="form-group">
          <label for="text">Team Code</label>
          <input type="text" name="teamcode" <?php if(isset($_POST['teamcode'])) echo "value=\"" . $_POST['teamcode'] . "\"" ; ?> <?php if(!isset($team_result) || (isset($team_result) && !$team_result)) { ?>autofocus="autofocus"<?php } ?>></input>
        <button id="btn" type="submit" class="btn">查找</button>

        </div>
      </form>

      <?php if(isset($team_result) && $team_result){ ?>
        <div class="container">
          <?php 
			showteam($team_result);
		  ?>
        </div>
        <form action="gao.php" method="POST">
        <div class="form-group">
          <label for="text">Position</label>
          <input type="text" name="teampos" autofocus="autofocus"></input>
          <input type="hidden" name="teamcode" value=<?=$_POST['teamcode']?>>
          <button id="btn" type="submit" class="btn">Submit</button>
        </div>
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
