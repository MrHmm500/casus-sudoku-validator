<?php
$jsonTestCases = file_get_contents('testcases.json');
$testCases = json_decode($jsonTestCases);
foreach($testCases as $caseName => $caseData) {
    echo "-----------------------------------<br />";
    echo $caseName . ' wordt getest<br />';
    echo 'expected output: <br />';
    echo str_replace("\n", '<br />', str_replace(' ', '&nbsp;', $caseData->expectedOutput)) . '<br /><br />';

    $inputArray = [];
    $input = explode("\n", $caseData->input);
    foreach ($input as $inputLine) {
        $inputArray[] = explode(' ', $inputLine);
    }

    echo "-----------------------------------<br />";
    echo "actual output:<br />";

    extractOutputFromInput($inputArray);
}

function extractOutputFromInput($n)
{
    $arrays = [];
    $valid = 'true';

    $rowNumber = 0;
    foreach ([[0, 1, 2], [3, 4, 5], [6, 7, 8]] as $xGroup) {
        foreach ([[0, 1, 2], [3, 4, 5], [6, 7, 8]] as $yGroup) {
            $arrays[$rowNumber] = [$n[$xGroup[0]][$yGroup[0]], $n[$xGroup[0]][$yGroup[1]], $n[$xGroup[0]][$yGroup[2]], $n[$xGroup[1]][$yGroup[0]], $n[$xGroup[1]][$yGroup[1]], $n[$xGroup[1]][$yGroup[2]], $n[$xGroup[2]][$yGroup[0]], $n[$xGroup[2]][$yGroup[1]], $n[$xGroup[2]][$yGroup[2]]];
            $rowNumber++;
        }
    }

    for ($i = 0; $i < 9; $i++) {
        $arrays[] = [$n[0][$i], $n[1][$i], $n[2][$i], $n[3][$i], $n[4][$i], $n[5][$i], $n[6][$i], $n[7][$i], $n[8][$i]];
        $arrays[] = $n[$i];
    }

    foreach ($arrays as $array) {
        if (isValid($array) === false) {
            $valid = 'false';
        };
    }

    echo("$valid<br />");
}

function isValid($array) {
    return count(array_unique($array)) === 9 && array_sum($array) === 45;
}
