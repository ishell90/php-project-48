<?php

namespace tests\genDiffTest;

use PHPUnit\Framework\TestCase;
use function src\genDiff\genDiff;

class genDiffTest extends TestCase
{
    public function testGoodScenarioJson(): void
    {
        $actual1 = "- follow: false\n  host: hexlet.io\n- proxy: 123.234.53.22\n- timeout: 50\n+ timeout: 20\n+ verbose: true";
        $actual2 = "- follow: false\n- host: hexlet.io\n- proxy: 123.234.53.22\n- timeout: 50";
        $actual3 = "";
        $actual4 = "  follow: false\n  host: hexlet.io\n  proxy: 123.234.53.22\n  timeout: 50";
        $actual5 = "- follow: false\n+ hockey: Iloveyou\n- host: hexlet.io\n+ keks: 247\n+ number: 8.930.717.25.90\n- proxy: 123.234.53.22\n+ ref: true\n- timeout: 50";
        $path1 = "file1.json";
        $path2 = "file2.json";
        $path3 = "tests/fixtures/file1Empty.json";
        $path4 = "tests/fixtures/file2Empty.json";
        $path5 = "tests/fixtures/file2Copy.json";
        $path6 = "tests/fixtures/file1Improvisation.json";
        $this->assertEquals($actual1, genDiff($path1, $path2));
        $this->assertEquals($actual2, genDiff($path1, $path3));
        $this->assertEquals($actual3, genDiff($path3, $path4));
        $this->assertEquals($actual4, genDiff($path1, $path5));
        $this->assertEquals($actual5, genDiff($path1, $path6));
        print_r("\nТесты прошли успешно!");
    }
}