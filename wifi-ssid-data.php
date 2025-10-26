<?php
header('Content-Type: application/json; charset=utf-8');
if(isset($_GET['ssid'])==false || empty($_GET['ssid'])==true){
    http_response_code(400);
    echo json_encode(['error'=>'missing ssid']);
    exit;
}
$ssid = $_GET['ssid'];
$cmd = 'netsh wlan show profile name="'.$ssid.'" key=clear';
$r = shell_exec($cmd);
$raw = $r;
if ($raw === null) {
    http_response_code(400);
    echo json_encode(['error'=>'missing netsh_output']);
    exit;
}

function fetch_ssid_info($text) {
    $lines = preg_split("/\r\n|\n|\r/", $text);
    $fields = [
        'profile'=>null,
        'name'=>null,
        'ssid_name'=>null,
        'security_key'=>null,
        'key_content'=>null,
        'authentications'=>[],
        'ciphers'=>[],
        'raw'=>$text
    ];
    foreach ($lines as $line) {
        $line = trim($line);
        if (!$fields['profile'] && preg_match('/^Profile\s+(.+?)\s+on interface/i', $line, $m)) {
            $fields['profile'] = trim($m[1]); continue;
        }
        if (!$fields['name'] && preg_match('/^Name\s*:\s*(.+)$/i', $line, $m)) {
            $fields['name'] = trim($m[1]); continue;
        }
        if (!$fields['ssid_name'] && preg_match('/^SSID name\s*:\s*"?(.+?)"?$/i', $line, $m)) {
            $fields['ssid_name'] = trim($m[1]); continue;
        }
        if (!$fields['security_key'] && preg_match('/^Security key\s*:\s*(.+)$/i', $line, $m)) {
            $fields['security_key'] = trim($m[1]); continue;
        }
        if (!$fields['key_content'] && preg_match('/^Key Content\s*:\s*(.+)$/i', $line, $m)) {
            $fields['key_content'] = trim($m[1]); continue;
        }
        if (preg_match('/^Authentication\s*:\s*(.+)$/i', $line, $m)) {
            $fields['authentications'][] = trim($m[1]); continue;
        }
        if (preg_match('/^Cipher\s*:\s*(.+)$/i', $line, $m)) {
            $fields['ciphers'][] = trim($m[1]); continue;
        }
    }
    $fields['authentications'] = array_values(array_unique($fields['authentications']));
    $fields['ciphers'] = array_values(array_unique($fields['ciphers']));
    if (!$fields['profile']) {
        // fallback
        if ($fields['name']) $fields['profile'] = $fields['name'];
        elseif ($fields['ssid_name']) $fields['profile'] = $fields['ssid_name'];
    }
    return $fields;
}

$result = fetch_ssid_info($raw);
echo json_encode($result, JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
