<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
echo '<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>PHP Multiplication Table</title>
</head>
<body>Multiplication table';
$list = array('min_multiplicand', 'max_multiplicand', 'min_multiplier', 'max_multiplier');
$test = true;   //boolean to store if all tests pass
$testArray = array();   //boolean array to store invidual tests passing

foreach($list as $key => $value){
    $testArray[$value] = true;
    //test if set
    if(array_key_exists($value, $_GET)) {
        //array key exists
        if ($_GET[$value] == '') {
            //array key isn't set
            echo '<p>' . 'Missing parameter ' . $value;
            $testArray[$value] = false;
        }
    } else {
        //array key does not exist
        echo '<p>' . 'Missing parameter ' . $value;
        $testArray[$value] = false;
    }
    //test if an integer (if set)
    //method used from http://stackoverflow.com/questions/3377537/checking-if-a-string-contains-an-integer
    //if wanting to exclude 1.0, used '==='
    if ($testArray[$value]) {
        if ((string)(int)$_GET[$value] == $_GET[$value]) {
            $multList[$value] = (int)$_GET[$value];
        } else {
            echo '<p>' . $value . ' must be an integer';
            $testArray[$value] = false;
        }
    }
    //test if greater than 0
    if($testArray[$value]) {
        if ($_GET[$value] < 0) {
            echo '<p>' . $value . ' must be greater than 0';
            $testArray[$value] = false;
        }
    }
    //check if all tests are true.
    if(!$testArray[$value]){
        $test = false;
    }
}

//test mins are less than max
if ($test) {
    if ($multList['min_multiplicand'] > $multList['max_multiplicand']) {
        $test = false;
        echo '<p>' . 'Minimum multiplicand is larger than maximum';
    }
    if ($multList['min_multiplier'] > $multList['max_multiplier']) {
        $test = false;
        echo '<p>' . 'Minimum multiplier is larger than maximum';
    }
}

//display the table
if($test) {
    echo '<p><h3>GET Variables</h3>
        <p>
        <table border="1">
        <thead>
        <tr><th>';
    for ($i = $multList['min_multiplier']; $i <= $multList['max_multiplier']; $i++) {
        echo '<th>' . $i;
    }

    for ($i = $multList['min_multiplicand']; $i <= $multList['max_multiplicand']; $i++) {
        echo '<tr><th>' . $i;
        for ($j = $multList['min_multiplier']; $j <= $multList['max_multiplier']; $j++) {
            echo '<td>' . $i * $j;
        }
    }
    echo '</table>';
}

echo '</body>
</html>';
?>
