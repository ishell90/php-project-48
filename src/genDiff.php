<?php

namespace src\genDiff;
$pathToFile1 = realpath($filePath);
$pathToFile2 = realpath($filePath);


function genDiff($pathToFile1, $pathToFile2)
{
    $firstStringFile = file_get_contents($pathToFile1);
    $twoStringFile = file_get_contents($pathToFile2);
    $firstDecodeFile = json_decode($firstStringFile, true);
    $twoDecodeFile = json_decode($twoStringFile, true);
    $firstSortFile = ksort($firstDecodeFile);
    $twoSortFile = ksort($twoDecodeFile);

    print_r($firstSortFile);
    
}

genDiff($pathToFile1, $pathToFile2);
