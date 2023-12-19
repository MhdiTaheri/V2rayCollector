<?php
include 'channel.php';
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

    preg_match_all($vlessPattern, $content, $vlessMatches);
    preg_match_all($vmessPattern, $content, $vmessMatches);
    preg_match_all($ssPattern, $content, $ssMatches);
    preg_match_all($trojanPattern, $content, $trojanMatches);
    preg_match_all($H2Pattern, $content, $H2Matches);
    preg_match_all($tuicPattern, $content, $tuicMatches);

    return [
        implode(PHP_EOL, !empty($vlessMatches[0]) ? $vlessMatches[0] : []),
        implode(PHP_EOL, !empty($vmessMatches[0]) ? $vmessMatches[0] : []),
        implode(PHP_EOL, !empty($ssMatches[0]) ? $ssMatches[0] : []),
        implode(PHP_EOL, !empty($trojanMatches[0]) ? $trojanMatches[0] : []),
        implode(PHP_EOL, !empty($H2Matches[0]) ? $H2Matches[0] : []),
        implode(PHP_EOL, !empty($tuicMatches[0]) ? $tuicMatches[0] : []),
    ];
}

function generateTrojanConfig() {
    $currentDateTime = date('D-d-M-Y H:i');
    return "trojan://bcacaab-baca-baca-dbac-accaabbcbacb@127.0.0.1:1080?security=tls&type=tcp#%F0%9F%94%84%20LATEST-UPDATE%20%F0%9F%93%85%20{$currentDateTime}";
}
function Signature() {
    return "trojan://bcacaab-baca-baca-dbac-accaabbcbacb@127.0.0.1:8080?security=tls&type=tcp#%C2%A9Made%20by:%20github.com/MhdiTaheri%20%F0%9F%93%8C";
}

$allVlessConfigs = [];
$allVMessConfigs = [];
$allSSConfigs = [];
$allTrojanConfigs = [];
$allH2Configs = [];
$alltuicConfigs = [];

foreach ($telegramChannelURLs as $channelURL) {
    $channelContent = fetchContent($channelURL);

    if ($channelContent !== false) {
        [$vless, $vmess, $ss, $trojan, $H2, $tuic] = extractConfigurations($channelContent);

        if (!empty($vless)) {
            $allVlessConfigs[] = $vless;
        }

        if (!empty($vmess)) {
            $allVMessConfigs[] = $vmess;
        }

        if (!empty($ss)) {
            $allSSConfigs[] = $ss;
        }

        if (!empty($trojan)) {
            $allTrojanConfigs[] = $trojan;
        }

        if (!empty($H2)) {
            $allH2Configs[] = $H2;
        }

        if (!empty($tuic)) {
            $alltuicConfigs[] = $tuic;
        }
    }
}

file_put_contents('vless.txt', generateTrojanConfig() . PHP_EOL . implode(PHP_EOL, $allVlessConfigs) . PHP_EOL . Signature());
file_put_contents('vmess.txt', generateTrojanConfig() . PHP_EOL . implode(PHP_EOL, $allVMessConfigs) . PHP_EOL . Signature());
file_put_contents('ss.txt', generateTrojanConfig() . PHP_EOL . implode(PHP_EOL, $allSSConfigs) . PHP_EOL . Signature());
file_put_contents('trojan.txt', generateTrojanConfig() . PHP_EOL . implode(PHP_EOL, $allTrojanConfigs) . PHP_EOL . Signature());
file_put_contents('hysteria.txt', generateTrojanConfig() . PHP_EOL . implode(PHP_EOL, $allH2Configs) . PHP_EOL . Signature());
file_put_contents('tuic.txt', generateTrojanConfig() . PHP_EOL . implode(PHP_EOL, $alltuicConfigs) . PHP_EOL . Signature());
file_put_contents('mix.txt', generateTrojanConfig() . PHP_EOL . implode(PHP_EOL, $allVlessConfigs) . PHP_EOL . implode(PHP_EOL, $allVMessConfigs) . PHP_EOL . implode(PHP_EOL, $allSSConfigs) . PHP_EOL . implode(PHP_EOL, $allTrojanConfigs) . PHP_EOL . implode(PHP_EOL, $allH2Configs) . PHP_EOL . implode(PHP_EOL, $alltuicConfigs) . PHP_EOL . Signature());
// base64
file_put_contents('vlessbase64.txt', base64_encode(generateTrojanConfig() . PHP_EOL . implode(PHP_EOL, $allVlessConfigs) . PHP_EOL . Signature()));
file_put_contents('vmessbase64.txt', base64_encode(generateTrojanConfig() . PHP_EOL . implode(PHP_EOL, $allVMessConfigs) . PHP_EOL . Signature()));
file_put_contents('ssbase64.txt', base64_encode(generateTrojanConfig() . PHP_EOL . implode(PHP_EOL, $allSSConfigs) . PHP_EOL . Signature()));
file_put_contents('trojanbase64.txt', base64_encode(generateTrojanConfig() . PHP_EOL . implode(PHP_EOL, $allTrojanConfigs) . PHP_EOL . Signature()));
file_put_contents('hysteriabase64.txt', base64_encode(generateTrojanConfig() . PHP_EOL . implode(PHP_EOL, $allH2Configs) . PHP_EOL . Signature()));
file_put_contents('tuicbase64.txt', base64_encode(generateTrojanConfig() . PHP_EOL . implode(PHP_EOL, $alltuicConfigs) . PHP_EOL . Signature()));
file_put_contents('mixbase64.txt', base64_encode(generateTrojanConfig() . PHP_EOL . implode(PHP_EOL, $allVlessConfigs) . PHP_EOL . implode(PHP_EOL, $allVMessConfigs) . PHP_EOL . implode(PHP_EOL, $allSSConfigs) . PHP_EOL . implode(PHP_EOL, $allTrojanConfigs) . PHP_EOL . implode(PHP_EOL, $allH2Configs) . PHP_EOL . implode(PHP_EOL, $alltuicConfigs) . PHP_EOL . Signature()));
?>
