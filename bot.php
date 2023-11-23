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
    $ssPattern = '/ss:\/\/[^<>\'"]+/';
    $trojanPattern = '/trojan:\/\/[^<>\'"]+/';

    preg_match_all($vlessPattern, $content, $vlessMatches);
    preg_match_all($vmessPattern, $content, $vmessMatches);
    preg_match_all($ssPattern, $content, $ssMatches);
    preg_match_all($trojanPattern, $content, $trojanMatches);

    $vlessConfigs = !empty($vlessMatches[0]) ? implode(PHP_EOL, $vlessMatches[0]) : '';
    $vmessConfigs = !empty($vmessMatches[0]) ? implode(PHP_EOL, $vmessMatches[0]) : '';
    $ssConfigs = !empty($ssMatches[0]) ? implode(PHP_EOL, $ssMatches[0]) : '';
    $trojanConfigs = !empty($trojanMatches[0]) ? implode(PHP_EOL, $trojanMatches[0]) : '';

    return [$vlessConfigs, $vmessConfigs, $ssConfigs, $trojanConfigs];
}

function generateTrojanConfig() {
    $currentDateTime = date('D-d-M-Y H:i');
    return "trojan://bcacaab-baca-baca-dbac-accaabbcbacb@127.0.0.1:1080?security=tls&type=tcp#%F0%9F%94%84%20LATEST-UPDATE%20%F0%9F%93%85%20{$currentDateTime}";
}

$telegramChannelURLs = [
    "https://t.me/s/V2rayCollectorDonate",
	"https://t.me/s/TVCminer",
    "https://t.me/s/MsV2ray",
    "https://t.me/s/foxrayiran",
    "https://t.me/s/DailyV2RY",
    "https://t.me/s/yaney_01",
    "https://t.me/s/FreakConfig",
    "https://t.me/s/EliV2ray",
    "https://t.me/s/ServerNett",
    "https://t.me/s/proxystore11",
    "https://t.me/s/v2rayng_fa2",
    "https://t.me/s/v2rayng_org",
    "https://t.me/s/V2rayNGvpni",
    "https://t.me/s/custom_14",
    "https://t.me/s/v2rayNG_VPNN",
    "https://t.me/s/v2ray_outlineir",
    "https://t.me/s/v2_vmess",
	"https://t.me/s/FreeVlessVpn",
	"https://t.me/s/vmess_vless_v2rayng",
	"https://t.me/s/PrivateVPNs",
	"https://t.me/s/freeland8",
	"https://t.me/s/vmessiran",
	"https://t.me/s/Outline_Vpn",
	"https://t.me/s/vmessq",
	"https://t.me/s/WeePeeN",
	"https://t.me/s/V2rayNG3",
	"https://t.me/s/ShadowsocksM",
	"https://t.me/s/shadowsocksshop",
	"https://t.me/s/v2rayan",
	"https://t.me/s/ShadowSocks_s",
	"https://t.me/s/VmessProtocol",
	"https://t.me/s/napsternetv_config",
	"https://t.me/s/Easy_Free_VPN",
	"https://t.me/s/V2Ray_FreedomIran",
	"https://t.me/s/V2RAY_VMESS_free",
	"https://t.me/s/v2ray_for_free",
	"https://t.me/s/V2rayN_Free",
	"https://t.me/s/free4allVPN",
	"https://t.me/s/vpn_ocean",
	"https://t.me/s/configV2rayForFree",
	"https://t.me/s/FreeV2rays",
	"https://t.me/s/DigiV2ray",
	"https://t.me/s/v2rayNG_VPN",
	"https://t.me/s/freev2rayssr",
	"https://t.me/s/v2rayn_server",
	"https://t.me/s/Shadowlinkserverr",
	"https://t.me/s/iranvpnet",
	"https://t.me/s/vmess_iran",
	"https://t.me/s/mahsaamoon1",
	"https://t.me/s/V2RAY_NEW",
	"https://t.me/s/v2RayChannel",
	"https://t.me/s/configV2rayNG",
	"https://t.me/s/config_v2ray",
	"https://t.me/s/vpn_proxy_custom",
	"https://t.me/s/vpnmasi",
	"https://t.me/s/v2ray_custom",
	"https://t.me/s/VPNCUSTOMIZE",
	"https://t.me/s/HTTPCustomLand",
	"https://t.me/s/vpn_proxy_custom",
	"https://t.me/s/ViPVpn_v2ray",
	"https://t.me/s/FreeNet1500",
	"https://t.me/s/v2ray_ar",
	"https://t.me/s/beta_v2ray",
	"https://t.me/s/vip_vpn_2022",
	"https://t.me/s/FOX_VPN66",
	"https://t.me/s/VorTexIRN",
	"https://t.me/s/YtTe3la",
	"https://t.me/s/V2RayOxygen",
	"https://t.me/s/Network_442",
	"https://t.me/s/VPN_443",
	"https://t.me/s/v2rayng_v",
	"https://t.me/s/ultrasurf_12",
	"https://t.me/s/iSeqaro",
	"https://t.me/s/frev2rayng",
	"https://t.me/s/frev2ray",
	"https://t.me/s/FreakConfig",
	"https://t.me/s/Awlix_ir",
	"https://t.me/s/v2rayngvpn",
	"https://t.me/s/God_CONFIG",
	"https://t.me/s/Configforvpn01",
];

$allVlessConfigs = [];
$allVMessConfigs = [];
$allSSConfigs = [];
$allTrojanConfigs = [];

foreach ($telegramChannelURLs as $channelURL) {
    $channelContent = fetchContent($channelURL);

    if ($channelContent !== false) {
        [$vless, $vmess, $ss, $trojan] = extractConfigurations($channelContent);

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
    }
}

file_put_contents('vless.txt', generateTrojanConfig() . PHP_EOL . implode(PHP_EOL, $allVlessConfigs));
file_put_contents('vmess.txt', generateTrojanConfig() . PHP_EOL . implode(PHP_EOL, $allVMessConfigs));
file_put_contents('ss.txt', generateTrojanConfig() . PHP_EOL . implode(PHP_EOL, $allSSConfigs));
file_put_contents('trojan.txt', generateTrojanConfig() . PHP_EOL . implode(PHP_EOL, $allTrojanConfigs));
?>
