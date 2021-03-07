<?php
// KONTROLER strony kalkulatora
require_once dirname(__FILE__).'/../config.php';

// W kontrolerze niczego nie wysyła się do klienta.
// Wysłaniem odpowiedzi zajmie się odpowiedni widok.
// Parametry do widoku przekazujemy przez zmienne.

// 1. pobranie parametrów

$x = $_REQUEST ['x'];
$y = $_REQUEST ['y'];
$oprocentowanie = $_REQUEST ['op'];

// 2. walidacja parametrów z przygotowaniem zmiennych dla widoku

// sprawdzenie, czy parametry zostały przekazane
if ( ! (isset($x) && isset($y) && isset($oprocentowanie))) {
	//sytuacja wystąpi kiedy np. kontroler zostanie wywołany bezpośrednio - nie z formularza
	$messages [] = 'Błędne wywołanie aplikacji. Brak jednego z parametrów.';
}

// sprawdzenie, czy potrzebne wartości zostały przekazane
if ( $x == "") {
	$messages [] = 'Nie podano kwoty';
}
if ( $y == "") {
	$messages [] = 'Nie podano czasu spłacania kredytu';
}

//nie ma sensu walidować dalej gdy brak parametrów
if (empty( $messages )) {
	
	// sprawdzenie, czy $x i $y są liczbami całkowitymi
	if (! is_numeric( $x )) {
		$messages [] = 'Proszę kwotę w PLN, używając liczby całkowitej.';
	}
	
	if (! is_numeric( $y )) {
		$messages [] = 'Proszę podać czas spłaty w latach, używając liczby całkowitej.';
	}	

}

// 3. wykonaj zadanie jeśli wszystko w porządku

if (empty ( $messages )) { // gdy brak błędów
	
	//konwersja parametrów na int
	$x = intval($x);
	$y = intval($y);
	
	//wykonanie operacji
	switch ($oprocentowanie) {
		case '5%' :
			$result = ($x / ($y * 12)) * 1.05;
			break;
		case '7%' :
			$result = ($x / ($y * 12)) * 1.07;
			break;
		case '10%' :
			$result = ($x / ($y * 12)) * 1.1;
			break;
		default :
			$result = ($x / ($y * 12)) * 1.03;
			break;
	}
}

// 4. Wywołanie widoku z przekazaniem zmiennych
// - zainicjowane zmienne ($messages,$x,$y,$oprocentowanie,$result)
//   będą dostępne w dołączonym skrypcie
include 'inna_chroniona.php';