# haystack

This provides a simple, modern theme for CiviCRM (based on the theme supplied in CiviCRM Admin Utilities for Wordpress).

![Screenshot](/images/contactsummary.png)

Based on https://github.com/christianwach/civicrm-admin-utilities/commit/5fbc85b77ff28847866eaa51acf318333bb3acf6

Go to Administer->Customize Data and Screens->Haystack theme settings to configure:
1. Dark or light menu theme.
2. Enable responsive datatables.
3. Disable CiviCRM core css.

## Requirements

* PHP v7.0+
* CiviCRM 5.12

## Licensing
The extension is licensed under [AGPL-3.0](LICENSE.txt).

Original work: License: GPLv2 or later (http://www.gnu.org/licenses/gpl-2.0.html)

## Installation (Web UI)

This extension has not yet been published for installation via the web UI.

## Installation (CLI, Zip)

Sysadmins and developers may download the `.zip` file for this extension and
install it with the command-line tool [cv](https://github.com/civicrm/cv).

```bash
cd <extension-dir>
cv dl haystack@https://github.com/mattwire/civicrm-haystacktheme/archive/master.zip
```

## Installation (CLI, Git)

Sysadmins and developers may clone the [Git](https://en.wikipedia.org/wiki/Git) repo for this extension and
install it with the command-line tool [cv](https://github.com/civicrm/cv).

```bash
git clone https://github.com/mattwire/civicrm-haystacktheme.git
cv en haystack
```

## Usage

1. Disable any other CiviCRM theme extensions.
2. Enable this extension.


## Known Issues
1. Slow to load haystack-civicrm-shared.css when in debug mode because of assetbuilder.  Maybe extract the "paths" into their own css file and just pass that one through assetbuilder?

## Nasty hacks / overrides that should be fixed in core
1. civicrm_case_dashboard_hack.js - removes the td label class.
2. civicrm_contribute_dashboard_hack.js - removes the td label class.
