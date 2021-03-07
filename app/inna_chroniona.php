<?php
require_once dirname(__FILE__).'/../config.php';
//ochrona widoku
include _ROOT_PATH.'/app/security/check.php';
?>
<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
	<meta charset="utf-8" />
	<title>Chroniony Kalkulator Kredytowy</title>
	<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/pure-min.css">
</head>
<body>

<div style="width:90%; margin: 2em auto;">
	<a href="<?php print(_APP_ROOT); ?>/app/calc.php" class="pure-button">Powrót do kalkulatora</a>
	<a href="<?php print(_APP_ROOT); ?>/app/security/logout.php" class="pure-button pure-button-active">Wyloguj</a>
</div>

<div style="width:90%; margin: 2em auto;">
	    
<?php if (!isset($oprocentowanie)) $oprocentowanie = "3%" ?>
<form action="<?php print(_APP_ROOT); ?>/app/calc_cred.php" method="post" class="pure-form pure-form-stacked">
	<legend>Kalkulator Kredytowy</legend>
	<label for="id_x">Kwota: </label>
	<input id="id_x" type="text" name="x" value="<?php if (isset($x)) print($x); ?>"/>
	<br />
	<label for="id_y">Czas spłaty (w latach)
: </label>
	<input id="id_y" type="text" name="y" value="<?php if (isset($y)) print($y); ?>"/>
	<br />
	<label for="id_op">Oprocentowanie: </label>
	<select name="op">
		<option value="3%" <?php if ($oprocentowanie == '3%')  print('selected'); ?>>3%</option>
		<option value="5%" <?php if ($oprocentowanie == '5%')  print('selected'); ?>>5%</option>
		<option value="7%" <?php if ($oprocentowanie == '7%')  print('selected'); ?>>7%</option>
		<option value="10%" <?php if ($oprocentowanie == '10%')  print('selected'); ?>>10%</option>
	</select>
	<br />
	<input type="submit" value="Oblicz" class="pure-button pure-button-primary" />
</form>	

<?php
//wyświeltenie listy błędów, jeśli istnieją
if (isset($messages)) {
		echo '<ol style="margin: 20px; padding: 10px 10px 10px 30px; border-radius: 5px; background-color: #f88; width:300px;">';
		foreach ( $messages as $msg ) {
			echo '<li>'.$msg.'</li>';
		}
		echo '</ol>';
}
?>

<?php if (isset($result)){ ?>
<div style="margin: 20px; padding: 10px; border-radius: 5px; background-color: #af0; width:300px;">
<?php echo 'Miesięczna rata (w PLN): '.round($result); ?>
</div>
<?php } ?>

</body>
</html>