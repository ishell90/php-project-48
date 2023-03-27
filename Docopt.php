<?php

namespace Project48\Docopt;

function run(){

$doc = <<<DOC
Generate diff

Usage:
    gendiff (-h|--help)
    gendiff (-v|--version)

Options:
    -h --help                     Show this screen
    -v --version                  Show version

DOC;

require('path/to/src/docopt.php');
$args = Docopt::handle($doc, array('help'=>true, 'version'=>null));
foreach ($args as $k=>$v)
    echo $k.': '.json_encode($v).PHP_EOL;
}
