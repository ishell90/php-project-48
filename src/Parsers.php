<?php

namespace src\Parsers;

//require_once __DIR__ . '/../vendor/autoload.php';
use Symfony\Component\Yaml\Yaml;

//$firstPath = realpath("file1.json");
//$secondPath = realpath("file2.json");

function parsers($firstPath, $secondPath)
{
    $extension1 = substr($firstPath, strrpos($firstPath, '.') + 1);
    $extension2 = substr($secondPath, strrpos($secondPath, '.') + 1);

    if ($extension1 === "json") {
        $firstStringFile = file_get_contents($firstPath);
        $result1 = json_decode($firstStringFile, true);
    } else {
        if (filesize($firstPath) < 6) {
            $result1 = [];
        } else {
            $firstDecodeFile = explode(",", Yaml::parseFile($firstPath));
            $result1 = [];
            foreach ($firstDecodeFile as $key1 => $value1) {
                $trim = trim($value1);
                $ag = explode(":", $trim);
                $result1[$ag[0]] = $ag[1];
            }
        }
        //var_dump($result1);
    }

    if ($extension2 === "yml" || $extension2 === "yaml") {
        if (filesize($secondPath) < 6) {
            $result2 = [];
        } else {
            $twoDecodeFile = explode(",", Yaml::parseFile($secondPath));
            $result2 = [];
            foreach ($twoDecodeFile as $key2 => $value2) {
                $trim = trim($value2);
                $ag = explode(":", $trim);
                $result2[$ag[0]] = $ag[1];
            }
        }
        //var_dump($result2);
    } else {
        $twoStringFile = file_get_contents($secondPath);
        $result2 = json_decode($twoStringFile, true);
        //var_dump($result2);
    }
    $resultGood = [$result1, $result2];
    //var_dump($resultGood);
    return $resultGood;
}
//Parsers($firstPath, $secondPath);
