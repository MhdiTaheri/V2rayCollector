<?php
include 'channel.php';
date_default_timezone_set('Asia/Tehran');

function fetchContent($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Accept-Language: en-US,fa;q=0.9',
        'Cookie: messagesDesktopMode=0;'
    ]);
    $response = curl_exec($ch);
    if ($response === false) {
        throw new Exception('Error fetching the content: ' . curl_error($ch));
    }
    curl_close($ch);
    return $response;
}

function extractConfigurations($content) {
    $vlessPattern = '/vless:\/\/[^<>\'"]+/';
    $vmessPattern = '/vmess:\/\/[^<>\'"]+/';
    $ssPattern = '/ss:\/\/[^<>\'"]+/';
    $trojanPattern = '/trojan:\/\/[^<>\'"]+/';
    $H2Pattern = '/hy2:\/\/[^<>\'"]+/';
    $tuicPattern = '/tuic:\/\/[^<>\'"]+/';

    return [
        implode(PHP_EOL, preg_match_all($vlessPattern, $content, $vlessMatches) ? $vlessMatches[0] : []),
        implode(PHP_EOL, preg_match_all($vmessPattern, $content, $vmessMatches) ? $vmessMatches[0] : []),
        implode(PHP_EOL, preg_match_all($ssPattern, $content, $ssMatches) ? $ssMatches[0] : []),
        implode(PHP_EOL, preg_match_all($trojanPattern, $content, $trojanMatches) ? $trojanMatches[0] : []),
        implode(PHP_EOL, preg_match_all($H2Pattern, $content, $H2Matches) ? $H2Matches[0] : []),
        implode(PHP_EOL, preg_match_all($tuicPattern, $content, $tuicMatches) ? $tuicMatches[0] : []),
    ];
}

function generateTrojanConfig() {
    $currentDateTime = date('D-d-M-Y H:i');
    return "trojan://bcacaab-baca-baca-dbac-accaabbcbacb@127.0.0.1:1080?security=tls&type=tcp#%F0%9F%94%84%20LATEST-UPDATE%20%F0%9F%93%85%20{$currentDateTime}";
}

function Signature() {
    return "trojan://bcacaab-baca-baca-dbac-accaabbcbacb@127.0.0.1:8080?security=tls&type=tcp#%C2%A9Made%20by:%20github.com/MhdiTaheri%20%F0%9F%93%8C";
}

$allVlessConfigs = $allVMessConfigs = $allSSConfigs = $allTrojanConfigs = $allH2Configs = $alltuicConfigs = [];

foreach ($telegramChannelURLs as $channelURL) {
    $channelContent = fetchContent($channelURL);

    if ($channelContent !== false) {
        [
            $allVlessConfigs[],
            $allVMessConfigs[],
            $allSSConfigs[],
            $allTrojanConfigs[],
            $allH2Configs[],
            $alltuicConfigs[],
        ] = extractConfigurations($channelContent);
    }
}

$trojanConfig = generateTrojanConfig();
$signature = Signature();

$fileContents = [
    'vless' => $trojanConfig . PHP_EOL . implode(PHP_EOL, $allVlessConfigs) . PHP_EOL . $signature,
    'vmess' => $trojanConfig . PHP_EOL . implode(PHP_EOL, $allVMessConfigs) . PHP_EOL . $signature,
    'ss' => $trojanConfig . PHP_EOL . implode(PHP_EOL, $allSSConfigs) . PHP_EOL . $signature,
    'trojan' => $trojanConfig . PHP_EOL . implode(PHP_EOL, $allTrojanConfigs) . PHP_EOL . $signature,
    'hysteria' => $trojanConfig . PHP_EOL . implode(PHP_EOL, $allH2Configs) . PHP_EOL . $signature,
    'tuic' => $trojanConfig . PHP_EOL . implode(PHP_EOL, $alltuicConfigs) . PHP_EOL . $signature,
    'mix' => $trojanConfig . PHP_EOL .
        implode(PHP_EOL, $allVlessConfigs) . PHP_EOL .
        implode(PHP_EOL, $allVMessConfigs) . PHP_EOL .
        implode(PHP_EOL, $allSSConfigs) . PHP_EOL .
        implode(PHP_EOL, $allTrojanConfigs) . PHP_EOL .
        implode(PHP_EOL, $allH2Configs) . PHP_EOL .
        implode(PHP_EOL, $alltuicConfigs) . PHP_EOL .
        $signature,
];

foreach ($fileContents as $key => $content) {
    file_put_contents("sub/{$key}", $content);
    file_put_contents("sub/{$key}base64", base64_encode($content));
}
?>
