<?php

    $scoreArray = [
        1,2,4,6,2,2,
        2,4,6,6,2,1,
        2,3,2,6,4,6,
        1,2,1,1,6,4,
        1,2,6,4,6,1
    ];

    $batsman_A_score = 0;
    $batsman_B_score = 0;

    $striker = 'A';
    $nonStriker = 'B';

    foreach ($scoreArray as $index => $score) {
        $ball = $index + 1;
        ($striker == 'A')
            ? $batsman_A_score += $score
            : $batsman_B_score += $score;

        if ($score % 2 !== 0) {
            [$striker, $nonStriker] = [$nonStriker, $striker];
        }

        if (($ball) % 6 === 0) {
            [$striker, $nonStriker] = [$nonStriker, $striker];
        }
    }

    echo "Batsman A Score: $batsman_A_score";
    echo "Batsman B Score: $batsman_B_score";

?>
