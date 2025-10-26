# 🔐 WiFiProfile-Parser

> A lightweight PHP tool to fetch and parse **Windows Wi-Fi profiles** and their details into JSON.  
> Built for ethical, local use — view your saved SSIDs and passwords on your own system.

![PHP](https://img.shields.io/badge/PHP-7.4%2B-blue)
![Platform](https://img.shields.io/badge/Platform-Windows-blue)
![License](https://img.shields.io/badge/License-MIT-green)
![Status](https://img.shields.io/badge/Status-Stable-brightgreen)

---

## 📖 Table of Contents
- [About](#about)
- [Features](#features)
- [Requirements](#requirements)
- [Installation](#installation)
- [Usage](#usage)
  - [List All Wi-Fi Profiles](#list-all-wi-fi-profiles)
  - [Get Profile Details](#get-profile-details)
- [Project Structure](#project-structure)
- [Security & Ethics](#security--ethics)
- [License](#license)
- [Disclaimer](#disclaimer)
- [Contributing](#contributing)
- [Author](#author)

---

## 💡About

**WiFiProfile-Parser** is a PHP utility for Windows that:
- Lists all saved Wi-Fi profiles (SSIDs)
- Retrieves detailed profile information including authentication methods, ciphers, and passwords (`Key Content`)  
- Returns data in clean JSON format for integration, analysis, or migration

> ⚠️ This tool runs **locally** and requires the user to execute commands on their own machine.

---

## ⚙️Features

✅ List saved Wi-Fi networks on Windows  
✅ Show currently connected Wi-Fi  
✅ Parse each profile’s authentication, cipher, and password details  
✅ Returns JSON suitable for automation or dashboards  
✅ Minimal setup — just PHP and Windows  

---

## 🧾Requirements

- Windows OS  
- PHP 7.4+  
- Access to `netsh` command (default on Windows)  

---

## 🛠️Installation

1. Clone the repository:
```bash
git clone https://github.com/mayankdhyani97/WiFiProfile-Parser.git
cd WiFiProfile-Parser
````

2. Start a PHP local server:

```bash
php -S localhost:8000
```

3. Open the endpoints in your browser or use `curl` to fetch JSON.

---

## 🚀Usage

### List All Wi-Fi Profiles

**Endpoint:** `wifi_profiles.php`
**Example Request:**

```bash
curl http://localhost:8000/wifi_profiles.php
```

**Example JSON Response:**

```json
{
  "current": "MyHomeWiFi",
  "ssids": [
    "MyHomeWiFi",
    "OfficeNet",
    "CafeHotspot"
  ]
}
```

* `"current"`: currently connected Wi-Fi (if any)
* `"ssids"`: all saved profiles

---

### Get Profile Details

**Endpoint:** `wifi-ssid-data.php`
**Query Parameter:** `ssid` (required)

**Example Request:**

```bash
curl "http://localhost:8000/wifi-ssid-data.php?ssid=MyHomeWiFi"
```

**Example JSON Response:**

```json
{
  "profile": "MyHomeWiFi",
  "name": "MyHomeWiFi",
  "ssid_name": "MyHomeWiFi",
  "security_key": "Present",
  "key_content": "mypassword123",
  "authentications": [
    "WPA2-Personal"
  ],
  "ciphers": [
    "CCMP"
  ],
  "raw": "Full netsh output here..."
}
```

* `authentications`: all authentication methods used
* `ciphers`: all ciphers used
* `key_content`: saved Wi-Fi password (if present)
* `raw`: full original `netsh` output

---

## 📁Project Structure

```
WiFiProfile-Parser/
│
├── wifi_profiles.php        # Lists SSIDs and current network
├── wifi-ssid-data.php       # Parses details of a given SSID
├── index.php
├── README.md
└── LICENSE
```

---

## 🔒Security & Ethics

* Runs locally and requires the user to have access to the system
* Intended **only for personal or educational use**
* Never use this tool to extract credentials from devices or networks you do not own or have explicit permission to access

---

## 📜License

MIT License. See [LICENSE](./LICENSE).

---

## ⚠️Disclaimer

> This project is for **educational purposes only**.
> The authors are not responsible for misuse or legal issues caused by unauthorized access to networks.

---

## 🤝Contributing

Contributions are welcome! You can:

* Improve JSON formatting
* Add batch processing of multiple profiles
* Add a GUI or web dashboard

Steps:

1. Fork the repository
2. Create a feature branch
3. Commit your changes
4. Open a pull request

---

## 👨‍💻Author

**Mayank Dhyani**
Full Stack Developer | Security & PHP Enthusiast
📧 [mayankdhyani1997@gmail.com](mailto:mayankdhyani1997@gmail.com)

🌐 [GitHub Profile](https://github.com/mayankdhyani97)
