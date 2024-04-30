<?php
$startYear = 1967;
$endYear = 1990;

$years = [];
for ($year = $startYear; $year <= $endYear; $year++) {
    $years[$year] = $year . '年';
}
return $years;