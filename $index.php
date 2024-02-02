<?php
$breedsPHP = array(
    "French Bulldogs",
    "Labrador Retrievers",
    "Golden Retrievers",
    "German Shepherd Dogs",
    "Poodles",
    "Bulldogs"
);
$dog = isset($_GET["dogBreed"]) ? trim($_GET["dogBreed"]) : '';
$found = "Dog Breed not found";
if ($result !== '') {
  $dog = strtolower($dog);
  $len = strlen($dog);
  foreach ($breedsPHP as $breed) {
    if (stristr(substr($breed, 0, $len), $dog)) {
      $found = $breed;
      break;
    }
  }
}
echo $found;
?>
