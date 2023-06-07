<?php

namespace src\genDiff;

function genDiff($resultGood)
{
    $firstDecodeFile = $resultGood[0];
    $twoDecodeFile = $resultGood[1];
    $a = array_keys($firstDecodeFile);
    $b = array_keys($twoDecodeFile);
    $c = array_unique(array_merge($a, $b));
    asort($c);
    //var_dump($c);
    $result = "";

    foreach ($c as $key1 => $value) {
        $value1 = trim($value);
        if (array_key_exists($value1, $firstDecodeFile) && array_key_exists($value1, $twoDecodeFile)) {
            if (is_bool($firstDecodeFile[$value1])) {
                $meaning1 = var_export($firstDecodeFile[$value1], true);
                if (is_bool($twoDecodeFile[$value1])) {
                    $meaning2 = var_export($twoDecodeFile[$value1], true);
                } else {
                    $meaning2 = $twoDecodeFile[$value1];
                }
            } else {
                $meaning1 = $firstDecodeFile[$value1];
                if (is_bool($twoDecodeFile[$value1])) {
                    $meaning2 = var_export($twoDecodeFile[$value1], true);
                } else {
                    $meaning2 = $twoDecodeFile[$value1];
                }
            }

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
                //var_dump($meaning1);
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
            if (is_bool($twoDecodeFile[$value1])) {
                $meaning2 = var_export($twoDecodeFile[$value1], true);
            } else {
                $meaning2 = (string) $twoDecodeFile[$value1];
            }
            //var_dump($meaning2);
            if (strlen($result) < 1) {
                $result = "+ {$value1}: {$meaning2}";
            } else {
                $result = "{$result}\n+ {$value1}: {$meaning2}";
            }
        }
        //var_dump($result);
    }
    return $result;
}
