<?php
include "HW9Assignment.html";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $values = $_POST['values'];

    // Original array
    echo "======================<br>";
    echo "<strong>Original array:</strong><br>";
    echo '<div style="margin-left: 20px;">';

    foreach($values as $v) {
        echo "$v<br>";
    }

    echo '</div>';

    // Original array with indexes
    echo "<br><strong>Original array with indexes:</strong><br>";
    echo '<div style="margin-left: 20px;">';
    echo "Array ( ";
    foreach($values as $key => $value) {
        echo "[$key] => $value ";
    }
    echo ")";
    echo '</div>';

    // Delete two elements from the array
    unset($values[0]);
    unset($values[2]);

    echo "<br>======================<br>";
    echo "<strong>Array after 2 elements deleted:</strong><br>";
    echo '<div style="margin-left: 20px;">';
    for($i=0; $i < 8; $i++) {
        echo "$values[$i] <br>";
    }
    echo '</div>';

    // Array after 2 elements deleted with indexes
    echo "<br><strong>Array after 2 elements deleted with indexes:</strong><br>";
    echo '<div style="margin-left: 20px;">';
    echo "Array ( ";
    foreach($values as $key => $value) {
        echo "[$key] => $value ";
    }
    echo ")";
    echo '</div>';

    // Remove gaps from the array
    $values = array_values($values);

    echo "<br>======================<br>";
    echo "<strong>Array after gaps removed:</strong><br>";
    echo '<div style="margin-left: 20px;">';

    foreach($values as $v) {
        echo "$v<br>";
    }

    echo '</div>';

    // Array after gaps removed with indexes
    echo "<br><strong>Array after gaps removed with indexes:</strong><br>";
    echo '<div style="margin-left: 20px;">';
    echo "Array ( ";
    foreach($values as $key => $value) {
        echo "[$key] => $value ";
    }
    echo ")";
    echo '</div>';

    // Sort the array in ascending order
    sort($values);

    echo "<br>======================<br>";
    echo "<strong>Array after sort ascending order:</strong><br>";
    echo '<div style="margin-left: 20px;">';

    foreach($values as $v) {
        echo "$v<br>";
    }

    echo '</div>';

    // Array sorted in ascending order with indexes
    echo "<br><strong>Array after sort ascending order with indexes:</strong><br>";
    echo '<div style="margin-left: 20px;">';
    echo "Array ( ";
    foreach($values as $key => $value) {
        echo "[$key] => $value ";
    }
    echo ")";
    echo '</div>';

    // Sort the array in descending order
    rsort($values);

    echo "<br>======================<br>";
    echo "<strong>Array after sort descending order:</strong><br>";
    echo '<div style="margin-left: 20px;">';

    foreach($values as $v) {
        echo "$v<br>";
    }

    echo '</div>';

    // Array sorted in descending order with indexes
    echo "<br><strong>Array after sort descending order with indexes:</strong><br>";
    echo '<div style="margin-left: 20px;">';
    echo "Array ( ";
    foreach($values as $key => $value) {
        echo "[$key] => $value ";
    }
    echo ")";
    echo '</div>';

    // Sort the array in ascending order according to values, keeping keys
    asort($values);
    $values = array_values($values);

    echo "<br>======================<br>";
    echo "<strong>Array after sort ascending order according to values while keeping keys:</strong><br>";
    echo '<div style="margin-left: 20px;">';

    foreach($values as $v) {
        echo "$v<br>";
    }

    echo '</div>';

    // Array sorted in ascending order according to values while keeping keys with indexes
    echo "<br><strong>Array after sort ascending order according to values while keeping keys with indexes:</strong><br>";
    echo '<div style="margin-left: 20px;">';
    echo "Array ( ";
    foreach($values as $key => $value) {
        echo "[$key] => $value ";
    }
    echo ")";
    echo '</div>';

    // Sort the array in ascending order according to keys
    ksort($values);

    echo "<br>======================<br>";
    echo "<strong>Array after sort ascending order according to keys:</strong><br>";
    echo '<div style="margin-left: 20px;">';

    foreach($values as $v) {
        echo "$v<br>";
    }

    echo '</div>';

    // Array sorted in ascending order according to keys with indexes
    echo "<br><strong>Array after sort ascending order according to keys with indexes:</strong><br>";
    echo '<div style="margin-left: 20px;">';
    echo "Array ( ";
    foreach($values as $key => $value) {
        echo "[$key] => $value ";
    }
    echo ")";
    echo '</div>';
}
?>