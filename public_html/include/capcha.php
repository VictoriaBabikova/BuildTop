<?php
$array = array('slon','kot','krokodile','mish','petuh','kon');
$array_rand = array_rand($array, 1);

if ($array[$array_rand] == 'slon') {
    $word = 'слон';
} elseif ($array[$array_rand] == 'kot') {
    $word = 'кот';
} elseif ($array[$array_rand] == 'krokodile') {
    $word = 'крокодил';
} elseif ($array[$array_rand] == 'mish') {
    $word = 'мышь';
} elseif ($array[$array_rand] == 'petuh') {
    $word = 'петух';
} elseif ($array[$array_rand] == 'kon') {
    $word = 'конь';
}
