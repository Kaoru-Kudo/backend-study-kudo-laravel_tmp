<?php
$months = [];
$data = range(1, 12);
foreach ($data as $month) {
    $months[$month] = $month . '月';
}
return $months;