<?php

namespace src\genDiff;
$realFilePath1 = realpath("file1.json");
$realFilePath2 = realpath("file2.json");


function genDiff($realFilePath1, $realFilePath2)
{
    $firstStringFile = file_get_contents($realFilePath1);
    $twoStringFile = file_get_contents($realFilePath2);
    $firstDecodeFile = json_decode($firstStringFile, true);
    $twoDecodeFile = json_decode($twoStringFile, true);
    $firstSortFile = ksort($firstDecodeFile);
    $twoSortFile = ksort($twoDecodeFile);

    print_r($firstSortFile);
    
}

genDiff($realFilePath1, $realFilePath2);
