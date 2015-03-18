<?php require_once '../includes/connection.php' ?>
<?php
  $ques=0;
  $uq = 0;
  if(isset($_GET['update_question'])) {
    $uq = 1;
  }
?>

<?php
  if(isset($_GET['uq']) && $_GET['uq'] == 1) {
    $id = $_POST['id'];
    $content = addslashes(trim($_POST['content']));
    $query = "UPDATE questions SET content = '{$content}' ";
    $query .= "WHERE id = {$id}";
    mysqli_query($connection, $query);
    if(mysqli_affected_rows($connection)) {
      $success = "Question Updates Successfully";
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <title>Admin | Ilm</title>

    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/dashboard.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">ILM</a>
        </div>
      </div>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li <?php if((isset($_GET['ques']) && $_GET['ques'] == 1) || !isset($_GET['player'])) {echo 'class="active"'; $ques=1;}?> ><a href="<?php echo $_SERVER['PHP_SELF'] . '?ques=1' ?>">Quetions <span class="sr-only">(current)</span></a></li>
          </ul>
          <ul class="nav nav-sidebar">
            <li <?php if((isset($_GET['player']) && $_GET['player'] == 1)) echo 'class="active"';?>><a href="<?php echo $_SERVER['PHP_SELF'] . '?player=1' ?>">Players</a></li>
          </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <?php if(isset($success)) {
              echo "<p>{$success}</p>";
            }
          ?>
          <h2 class="sub-header">
            <?php if($ques && !$uq) echo "Questions";
                  elseif(!$ques) echo "Players";
                  elseif($uq) echo 'Update Question';
            ?>
          </h2>
          <div class="table-responsive">
            <table class="table table-striped">
              <?php if($ques && !$uq) { ?>
                <?php
                  $query = "SELECT * FROM questions";
                  $result = mysqli_query($connection, $query);
                  $num =  mysqli_num_rows($result);
                ?>
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Content</th>
                  </tr>
                </thead>
                <tbody>
                  <?php for($i=1; $i<=$num; $i++) { ?>
                      <tr>
                        <form action="<?php echo $_SERVER['PHP_SELF']. '?update_question=1' ?>" method="post">
                          <?php $q = mysqli_fetch_array($result, MYSQLI_ASSOC); ?>
                          <td><?php echo $q["id"] ?></td>
                          <td><?php echo stripslashes($q["content"]) ?></td>
                          <input type="hidden" name="id" value="<?php echo $q['id'] ?>">
                          <td><button type="submit" class="btn btn-success">EDIT</button></td>
                        </form>
                      </tr>
                  <?php } mysqli_free_result($result); ?>
                </tbody>
              <?php } elseif(!$ques && !$uq) { ?>
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>1</td>
                    <td>Zishan</td>
                  </tr>
                </tbody>
              <?php } ?>
            </table>
            <?php if($uq) { ?>
              <?php
                $id = $_POST['id'];
                $query = "SELECT * FROM questions WHERE id = {$id}";
                $result = mysqli_query($connection, $query);
                $question = mysqli_fetch_array($result, MYSQLI_ASSOC);
                mysqli_free_result($result);
              ?>
                <form method="post" action="<?php echo $_SERVER['PHP_SELF'] . '?uq=1' ?>">
                  <textarea rows="4" cols="100" name="content"><?php echo $question['content']; ?></textarea>
                  <input type="hidden" name="id" value="<?php echo $id ?>">
                  <br><br>
                  <button type="submit" name="uq" class="btn btn-success">Update</button>&nbsp;&nbsp;
                  <a href="<?php echo $_SERVER['PHP_SELF'] ?>"><button class="btn btn-danger">Cancel</button></a>
                </form>
            <?php } ?>
          </div>

        </div>
      </div>
    </div>

  </body>
</html>
