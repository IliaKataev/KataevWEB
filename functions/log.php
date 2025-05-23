<?php

function logRequest()
{
    $logFile = __DIR__ . '/../log.txt';
    $maxRecords = 10;

    $entry = date('Y-m-d H:i:s') . " - " . $_SERVER['REMOTE_ADDR'] . " - " . $_SERVER['REQUEST_URI'] . PHP_EOL;
    file_put_contents($logFile, $entry, FILE_APPEND);

    $lines = file($logFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    if (count($lines) >= $maxRecords) {
        archiveLog($logFile);
    }
}

function archiveLog($logFile)
{
    $pattern = __DIR__ . '/../log*.txt';
    $logs = glob($pattern);

    $nums = [];
    foreach ($logs as $file) {
        if (preg_match('/log(\d+)\.txt$/', $file, $m)) {
            $nums[] = (int) $m[1];
        }
    }

    $nextNum = empty($nums) ? 0 : max($nums) + 1;
    rename($logFile, __DIR__ . "/../log{$nextNum}.txt");
}
