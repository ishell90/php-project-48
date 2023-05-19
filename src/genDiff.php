<?php

namespace src\genDiff;

//$realFilePath1 = realpath("../file1.json");
//$realFilePath2 = realpath("../file2.json");


function genDiff($realFilePath1, $realFilePath2)
{
    $firstStringFile = file_get_contents($realFilePath1);
    $twoStringFile = file_get_contents($realFilePath2);
    $firstDecodeFile = json_decode($firstStringFile, true);
    $twoDecodeFile = json_decode($twoStringFile, true);
    $a = array_keys($firstDecodeFile);
    $b = array_keys($twoDecodeFile);
    $c = array_unique(array_merge($a, $b));
    asort($c);
    //ksort($firstDecodeFile);
    //ksort($twoDecodeFile);
    //var_dump($c);
    $result = "";

    foreach ($c as $key1 => $value1) {
        if (array_key_exists($value1, $firstDecodeFile) && array_key_exists($value1, $twoDecodeFile)) {
            $meaning1 = $firstDecodeFile[$value1];
            $meaning2 = $twoDecodeFile[$value1];
            if ($meaning1 === $meaning2) {
                if (strlen($result) < 1) {
                    $result = "  {$value1}: {$meaning1}";
                } else {
                    $result = "{$result}\n  {$value1}: {$meaning1}";
                }
            } else {
                if (strlen($result) < 1) {
                    $result = "- {$value1}: {$meaning1}\n+ {$value1}: {$meaning2}";
                } else {
                    $result = "{$result}\n- {$value1}: {$meaning1}\n+ {$value1}: {$meaning2}";
                }
            }
        } elseif (array_key_exists($value1, $firstDecodeFile) && !array_key_exists($value1, $twoDecodeFile)) {
            if (is_string($firstDecodeFile[$value1]) === true) {
                $meaning1 = (string) $firstDecodeFile[$value1];
            } else {
                $meaning1 = var_export($firstDecodeFile[$value1], true);
            }
            //var_dump($meaning1);
            if (strlen($result) < 1) {
                $result = "- {$value1}: {$meaning1}";
            } else {
                $result = "{$result}\n- {$value1}: {$meaning1}";
            }
        } else {
            $meaning2 = var_export($twoDecodeFile[$value1], true);
            //var_dump($meaning2);
            if (strlen($result) < 1) {
                $result = "+ {$value1}: {$meaning2}";
            } else {
                $result = "{$result}\n+ {$value1}: {$meaning2}";
            }
        }
        //var_dump($result);
    }
}
