# Configuration Extractor

[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://github.com/MhdiTaheri/V2rayCollector/blob/main/LICENSE)
![PHP version](https://img.shields.io/badge/php-%3E%3D7.0-blue)
[![Contributions welcome](https://img.shields.io/badge/contributions-welcome-brightgreen.svg)](https://github.com/MhdiTaheri/V2rayCollector)
![GitHub last commit](https://img.shields.io/github/last-commit/MhdiTaheri/V2rayCollector)
![GitHub issues](https://img.shields.io/github/issues/MhdiTaheri/V2rayCollector)


This PHP script fetches content from various Telegram channels and extracts VLESS, VMess, Shadowsocks, and Trojan configurations. It then organizes and saves them into separate text files.


## Table of Contents

- [Introduction](#introduction)
- [Prerequisites](#prerequisites)
- [Usage](#usage)
- [How It Works](#how-it-works)
- [Files Generated](#files-generated)
- [Contributing](#contributing)
- [Channels](Channels-Used)
- [Sub](#Sub-Link)
- [License](#license)

## Introduction

This script is designed to retrieve configuration details for various VPN protocols (VLESS, VMess, Shadowsocks, and Trojan) from a list of Telegram channel URLs provided within the script. It uses cURL to fetch content and regular expressions to extract the configurations.

## Prerequisites

- **PHP**: Ensure PHP is installed on your system.
- **cURL**: The script uses cURL, ensure it's enabled in your PHP configuration.

## Usage

1. Clone or download the script to your local machine.
2. Ensure PHP is properly configured.
3. Run the script in your PHP environment.

```bash
php bot.php
```

## How It Works

- The script sets the timezone and defines functions for fetching content and extracting configurations.
- It contains a list of Telegram channel URLs.
- It iterates through each URL, fetching content and extracting configurations for VLESS, VMess, Shadowsocks, and Trojan.
- Extracted configurations are saved into separate text files for each protocol.

## Files Generated

- **vless.txt**: Contains VLESS configurations.
- **vmess.txt**: Contains VMess configurations.
- **ss.txt**: Contains Shadowsocks configurations.
- **trojan.txt**: Contains Trojan configurations.

## Contributing

Contributions are welcome! If you find any issues or want to enhance the script, feel free to submit a pull request.

## Channels Used

| Channel Name | Channel Link |
|--------------|--------------|
| V2rayCollectorDonate | [Link](https://t.me/s/V2rayCollectorDonate) |
| TVCminer | [Link](https://t.me/s/TVCminer) |
| MsV2ray | [Link](https://t.me/s/MsV2ray) |
| foxrayiran | [Link](https://t.me/s/foxrayiran) |
| DailyV2RY | [Link](https://t.me/s/DailyV2RY) |
| yaney_01 | [Link](https://t.me/s/yaney_01) |
| FreakConfig | [Link](https://t.me/s/FreakConfig) |
| EliV2ray | [Link](https://t.me/s/EliV2ray) |
| ServerNett | [Link](https://t.me/s/ServerNett) |
| proxystore11 | [Link](https://t.me/s/proxystore11) |
| v2rayng_fa2 | [Link](https://t.me/s/v2rayng_fa2) |
| v2rayng_org | [Link](https://t.me/s/v2rayng_org) |
| V2rayNGvpni | [Link](https://t.me/s/V2rayNGvpni) |
| custom_14 | [Link](https://t.me/s/custom_14) |
| v2rayNG_VPNN | [Link](https://t.me/s/v2rayNG_VPNN) |
| v2ray_outlineir | [Link](https://t.me/s/v2ray_outlineir) |
| v2_vmess | [Link](https://t.me/s/v2_vmess) |

## Sub Link
| Type | Link |
|--------------|--------------|
| Vless | [Link](https://raw.githubusercontent.com/MhdiTaheri/V2rayCollector/main/vless.txt) |
| Vmess | [Link](https://raw.githubusercontent.com/MhdiTaheri/V2rayCollector/main/vmess.txt) |
| SS | [Link](https://raw.githubusercontent.com/MhdiTaheri/V2rayCollector/main/ss.txt) |
| Trojan | [Link](https://raw.githubusercontent.com/MhdiTaheri/V2rayCollector/main/trojan.txt) |

## License

This script is licensed under the [MIT License](LICENSE).

