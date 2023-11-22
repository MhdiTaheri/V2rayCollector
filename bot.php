<?php
date_default_timezone_set('Asia/Tehran');

function fetchContent($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Accept-Language: en-US,en;q=0.9',
        'Cookie: messagesDesktopMode=0;'
    ]);
    $response = curl_exec($ch);
    if ($response === false) {
        echo 'Error fetching the content: ' . curl_error($ch);
    }
    curl_close($ch);
    return $response;
}

function extractConfigurations($content) {
    $vlessPattern = '/vless:\/\/[^<>\'"]+/';
    $vmessPattern = '/vmess:\/\/[^<>\'"]+/';

    preg_match_all($vlessPattern, $content, $vlessMatches);
    preg_match_all($vmessPattern, $content, $vmessMatches);

    $vlessConfigs = !empty($vlessMatches[0]) ? implode(PHP_EOL, $vlessMatches[0]) : '';
    $vmessConfigs = !empty($vmessMatches[0]) ? implode(PHP_EOL, $vmessMatches[0]) : '';

    return [$vlessConfigs, $vmessConfigs];
}

function generateTrojanConfig() {
    $currentDateTime = date('D-d-M-Y H:i');
    return "trojan://bcacaab-baca-baca-dbac-accaabbcbacb@127.0.0.1:1080?security=tls&type=tcp#%F0%9F%94%84%20LATEST-UPDATE%20%F0%9F%93%85%20{$currentDateTime}";
}

// Array of Telegram channel URLs
$telegramChannelURLs = [
    "https://t.me/s/V2rayCollectorDonate",
    "https://t.me/s/MsV2ray",
    "https://t.me/s/foxrayiran",
    "https://t.me/s/DailyV2RY",
    "https://t.me/s/yaney_01",
    "https://t.me/s/FreakConfig",
    "https://t.me/s/EliV2ray",
    "https://t.me/s/ServerNett",
    "https://t.me/s/proxystore11",
    
];

$allVlessConfigs = [];
$allVMessConfigs = [];

file_put_contents('vless.txt', '');
file_put_contents('vmess.txt', '');

foreach ($telegramChannelURLs as $channelURL) {
    $channelContent = fetchContent($channelURL);

    if ($channelContent !== false) {
        [$vless, $vmess] = extractConfigurations($channelContent);

        if (!empty($vless)) {
            $allVlessConfigs[] = $vless;
        }

        if (!empty($vmess)) {
            $allVMessConfigs[] = $vmess;
        }
    }
}

$trojanConfig = generateTrojanConfig();

file_put_contents('vmess.txt', $trojanConfig . PHP_EOL);

if (!empty($allVlessConfigs)) {
    $allVless = implode(PHP_EOL, $allVlessConfigs);
    file_put_contents('vless.txt', $trojanConfig . PHP_EOL . $allVless);
}

if (!empty($allVMessConfigs)) {
    $allVMess = implode(PHP_EOL, $allVMessConfigs);
    file_put_contents('vmess.txt', $allVMess, FILE_APPEND);
}

file_put_contents('debug.log', 'Script ran successfully.', FILE_APPEND);
?>
