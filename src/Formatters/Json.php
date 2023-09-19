<?php

namespace Differ\Formatters\Json;


function formatJson(array $astTree)
{
    return json_encode($astTree);
}