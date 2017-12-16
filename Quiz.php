<?PHP
session_start();
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <link rel="stylesheet" href="style.css" type="text/css">
  <title>Quiz</title>
</head>
<body>

<?PHP

$zeilen = file("fragen.csv");

if(!isset($_SESSION['cnt']) OR (isset($_GET['init'])))
{
  $_SESSION['richtig'] = 0;
  $_SESSION['falsch'] = 0;
  $_SESSION['cnt'] = 0;
}

if(isset($_POST['auswahl']) && $_POST['auswahl'] == "Abschicken")
{
     if(isset($_POST['val']) && $_POST['val'] == $_SESSION['korrekt'])
     {
         echo "Diese Antwort ist richtig.";
         $_SESSION['cnt']++;
         $_SESSION['richtig']++;
     }

     elseif(isset($_POST['val']))
     {
         echo "Diese Antwort ist leider falsch.";
         $_SESSION['cnt']++;
         $_SESSION['falsch']++;
     }

     else
     {
        echo "Bitte eine Antwort geben";
         // wenn man ohne Antwort weiter kommen solle die REMS unten rausnehmen
         // $_SESSION['cnt']++;
         // $_SESSION['falsch']++;
     }
}


if($_SESSION['cnt'] < count($zeilen))
{
  $fragen = explode("\t",$zeilen[$_SESSION['cnt']]);
  $_SESSION['korrekt'] = $fragen[1];

  ?>
   <p><?PHP echo $fragen[0]; ?></p>
   <form action="<?PHP echo $_SERVER['SCRIPT_NAME']; ?>" method="post">
   <input type="radio" name="val" value="<?PHP echo $fragen[2]; ?>"> <?PHP echo $fragen[2]; ?><br>
   <input type="radio" name="val" value="<?PHP echo $fragen[3]; ?>"> <?PHP echo $fragen[3]; ?><br>
   <input type="radio" name="val" value="<?PHP echo $fragen[4]; ?>"> <?PHP echo $fragen[4]; ?><br>
   <input type="submit" name="auswahl" value="Abschicken">
  </form>
  <?PHP
}
else
{
  echo "<br><pre>";
  echo "Richtige Antworten: ".$_SESSION['richtig']."<br>";
  echo "Falsche Antworten : ".$_SESSION['falsch'];
  echo "</pre>";
}
?>
</body>
</html>
