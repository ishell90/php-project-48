<?php

namespace src\Parsers;

use Symfony\Component\Yaml\Yaml;

$firstPath = realpath("../filepath1.yml");
$secondPath = realpath("../filepath2.yml");

function Parsers($firstPath, $secondPath){
    $extension1 = substr($firstPath, strrpos($firstPath, '.') + 1);
    $extension2 = substr($secondPath, strrpos($secondPath, '.') + 1);
    var_dump($extension1);

    if ($extension1 === "json") {
        $firstStringFile = file_get_contents($firstPath);
        $firstDecodeFile = json_decode($firstStringFile, true);
    } else {
        $firstDecodeFile = Yaml::parseFile($firstPath);
        $var_dump($firstDecodeFile);
    }

    if ($extension2 === "yml" || $extension2 === "yaml") {
        $twoDecodeFile = Yaml::parseFile($secondPath);
    } else {
        $twoStringFile = file_get_contents($secondPath);
        $twoDecodeFile = json_decode($twoStringFile, true);
    }

    $a = array_keys($firstDecodeFile);
    $b = array_keys($twoDecodeFile);
    $c = array_unique(array_merge($a, $b));
    asort($c);
    return $c;
}

Parsers($firstPath, $secondPath);