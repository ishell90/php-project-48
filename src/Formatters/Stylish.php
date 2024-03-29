<?php

namespace Differ\Formatters\Stylish;

/**
 * @param array<mixed> $astTree
 * @param int $depth
 * @return string
 */
function formatStylish(array $astTree, int $depth = 0): string
{
    $indent = str_repeat('    ', $depth);

    $lines = array_map(function ($node) use ($indent, $depth) {

        ['status' => $status, 'key' => $key, 'value1' => $value, 'value2' => $value2] = $node;

        $normalizeValue1 = (is_array($value)) ? formatStylish($value, $depth + 1) : $value;

        switch ($status) {
            case 'nested':
            case 'unchanged':
                return "{$indent}    {$key}: {$normalizeValue1}";
            case 'added':
                return "{$indent}  + {$key}: {$normalizeValue1}";
            case 'deleted':
                return "{$indent}  - {$key}: {$normalizeValue1}";
            case 'changed':
                $normalizeValue2 = (is_array($value2)) ? formatStylish($value2, $depth + 1) : $value2;
                return "{$indent}  - {$key}: {$normalizeValue1}\n{$indent}  + {$key}: {$normalizeValue2}";
            default:
                throw new \Exception("Unknown node status: {$status}");
        }
    }, $astTree);
    $result = ["{", ...$lines, "{$indent}}"];
    return implode("\n", $result);
}
