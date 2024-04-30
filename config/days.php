<?php
$days = [];
$data = range(1, 31);
foreach ($data as $day) {
    $days[$day] = $day . '日';
}
return $days;