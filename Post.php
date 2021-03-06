<?php
include 'db\func.php';
session_start();

$MAX_FILE_SIZE = 3145728;
$MAX_SIZE = 73400320;

$error = '';
$message = '';
$fileTotal = 0;
if (isset($_POST['btnPost']) && $_POST['btnPost'] == 'SendPost') {


  if (isset($_FILES) && is_array($_FILES) && count($_FILES) > 0) {
    $text = filter_input(INPUT_POST, "message", FILTER_SANITIZE_STRING);
    $last = InsertPost($text, date("Y-m-$"));
    // Raccourci d'écriture pour le tableau reçu
    $fichiers = $_FILES['img'];
    // Boucle itérant sur chacun des fichiers
    for ($i = 0; $i < count($fichiers['name']); $i++) {
      $imgType = $fichiers["type"][$i];
      $stringImgType = substr($imgType, 0, strpos($imgType, "/"));

      if ($stringImgType == "image" || $stringImgType == "video" || $stringImgType == "audio") {

        if ($fichiers["size"][$i] > $MAX_FILE_SIZE) {
          $error .= "Fichier trop volumineux";
          ShowAlert($error);
          break;
        } else {
          $fileTotal += $fichiers["size"][$i];
        }

        if ($fileTotal > $MAX_SIZE) {
          $error .= "Le total de tout vos fichier est trop volumineux";
          ShowAlert($error);
          break;
        } else {
          // Action pour avoir un nom unique et evité les personnes qui upload plusieur fois le meme nom de fichier
          $nom_fichier = $fichiers['name'][$i];
          $nomFichierExplode = explode(".", $nom_fichier);
          $nomFichierMD5 = md5(time() . $nom_fichier);
          $newNomFichier = $nomFichierMD5 . '.' . strtolower(end($nomFichierExplode));


          // Déplacement depuis le répertoire temporaire
          if (move_uploaded_file($fichiers['tmp_name'][$i], 'uploaded_files/' . $newNomFichier)) {
            InsertMedia(end($nomFichierExplode), $nomFichierMD5, date("Y-m-d"), $last);
          }
          else{
            ShowAlert("Votre fichier n'a pas pu etre upload");
          }
        }
      } else {
        $error .= "mauvaise extension de fichier";
        ShowAlert($error);
      }
    }
  } else {
    $text = filter_input(INPUT_POST, "message", FILTER_SANITIZE_STRING);
    $last = InsertPost($text, date("Y-m-d"));
  }
}

function ShowAlert($error)
{
  echo "<script type='text/javascript'>alert('$error');</script>";
}
?>
<html lang="en">

<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <meta charset="utf-8">
  <title>Facebook Theme Demo</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <link href="assets/css/bootstrap.css" rel="stylesheet">
  <!--[if lt IE 9]>
          <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
  <link href="assets/css/facebook.css" rel="stylesheet">
</head>

<body>
  <div class="wrapper">
    <div class="box">
      <div class="">
        <!-- main right col -->
        <div class="column col-sm-12 col-xs-12" id="main">
          <div class="navbar navbar-blue navbar-static-top">

            <div class="navbar-header">
              <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a href="http://usebootstrap.com/theme/facebook" class="navbar-brand logo">b</a>
            </div>
            <nav class="collapse navbar-collapse" role="navigation">
              <form class="navbar-form navbar-left">
                <div class="input-group input-group-sm" style="max-width:360px;">
                  <input class="form-control" placeholder="Search" name="srch-term" id="srch-term" type="text">
                  <div class="input-group-btn">
                    <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                  </div>
                </div>
              </form>
              <ul class="nav navbar-nav">
                <li>
                  <a href="./index.php"><i class="glyphicon glyphicon-home"></i> Home</a>
                </li>
                <li>
                  <a href="./Post.php" role="button" data-toggle="modal"><i class="glyphicon glyphicon-plus"></i> Post</a>
                </li>
              </ul>
            </nav>
          </div>
          <div class="padding">
            <div class="full col-sm-9">
              <div class="well">
                <form method="post" class="form-horizontal" enctype="multipart/form-data" style="padding-left:10px; padding-right:10px;">
                  <h2 class="text-center"></h2>
                  <div class="form-group"><small class="form-text text-danger"></small></div>
                  <div class="form-group"><textarea class="form-control" name="message" placeholder="Message"></textarea></div>
                  <div class="form-group">
                    <button class="btn btn-primary" type="submit" name="btnPost" value="SendPost">Publish</button>
                    <input type="file" accept="image/png, image/jpeg, video/mp4, ,audio/mp3" name="img[]" multiple />
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
</body>

</html>