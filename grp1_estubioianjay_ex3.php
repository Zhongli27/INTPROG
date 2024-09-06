<?php
// Define the log file name
$logFile = 'logfile.txt';

// Check if the log file exists
if (file_exists($logFile)) {
    // Log file exists, read the contents
    $logContents = file_get_contents($logFile);
    echo "Log file exists. Contents before appending:\n";
    echo $logContents;
} else {
    // Log file does not exist, create it with a header line
    $headerLine = "Log File Created on " . date('Y-m-d H:i:s') . "\n";
    file_put_contents($logFile, $headerLine);
    echo "Log file did not exist. Created the log file with a header line.\n";
}

// Append some log entries to the log file
$logEntry = "Log entry at " . date('Y-m-d H:i:s') . "\n";
file_put_contents($logFile, $logEntry, FILE_APPEND);

// Read and display the log file contents
$updatedLogContents = file_get_contents($logFile);
echo "Contents after appending:\n";
echo $updatedLogContents;

// Optionally, read the log file into an array
$logArray = file($logFile);
echo "Log file contents as an array:\n";
print_r($logArray);
?>
