<?php
$output = shell_exec('netsh wlan show profiles');

$lines = explode("\n", $output);
$ssids = [];

foreach ($lines as $line) {
    if (preg_match('/All User Profile\s*:\s*(.*)/', $line, $m)) {
		$quoted = str_replace('"', '\"', trim($m[1]));
        $ssids[] = trim($m[1]);
    }
}

$current = [];
$output = shell_exec('netsh wlan show interfaces');
if (preg_match('/^\s*SSID\s*:\s*(.+)$/m', $output, $m)) {
	$currentSSID = trim($m[1]);
	$current = $currentSSID;
}

header('Content-Type: application/json');
echo json_encode(["current"=> $current, 'ssids' => $ssids], JSON_PRETTY_PRINT);
