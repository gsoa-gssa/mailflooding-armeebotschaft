<?php

// Open BLOCKED
$filename = __DIR__ . '/BLOCKED';
$handle = fopen($filename, 'r');

// Read the first row
$header = fgetcsv($handle);

// Read the rest of the rows
$emails = [];
while ($row = fgetcsv($handle)) {
    // Read first column and hash with SHA-256
    $email = strtolower($row[0]);
    $hash = hash('sha256', $email);
    $emails[] = $hash;
}

// Close the file
fclose($handle);

// Append to sha_emails.csv
$filename = __DIR__ . '/sha_emails.csv';
$handle = fopen($filename, 'a');
foreach ($emails as $email) {
    fputcsv($handle, [$email]);
}

// Close the file
fclose($handle);
