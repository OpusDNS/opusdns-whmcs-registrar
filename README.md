## About OpusDNS

OpusDNS is a domain registrar providing domain registration and management services.

## Installation

1. Download the latest release from the [Releases page](https://github.com/OpusDNS/opusdns-whmcs-registrar/releases)
2. Extract the zip file
3. Upload the `modules` folder to your WHMCS root directory
4. The module files should be located at: `<whmcs_root>/modules/registrars/opusdns/`

### Custom Domain Fields (required for TLDs like `.music`)

Some TLDs supported by OpusDNS require additional checkout fields — for example, `.music`
requires a registrant attestation. WHMCS loads these only from a single global path:
`<whmcs_root>/resources/domains/additionalfields.php`.

The module ships a ready-to-use shim at `resources/domains/additionalfields.php` that pulls
in the field definitions bundled with the module. To enable:

- **If you don't already have a `<whmcs_root>/resources/domains/additionalfields.php`:** copy
  the shim from the release into place.
- **If you already have one** (other registrar modules may have added entries to it): add the
  guarded include from the shim to the top of your existing file:

  ```php
  $opusdnsAdditionalFields = __DIR__ . '/../../modules/registrars/opusdns/additionalfields.php';
  if (file_exists($opusdnsAdditionalFields)) {
      include $opusdnsAdditionalFields;
  }
  ```

Without this step, customers cannot satisfy TLD-specific requirements at checkout and the
module will reject `.music` registrations with a clear error message.

## Activating the Module

To activate the OpusDNS registrar module:

1. Go to **Setup > Products/Services > Domain Registrars**
2. Locate **OpusDNS** in the list
3. Click **Activate**

## Configuration

To configure the module:

1. Enter your **Client ID**
2. Enter your **Client Secret**
3. Check **Test Mode** to use the sandbox environment
4. Click **Save Changes**

## Supported Features

- Domain Registration
- Domain Renewal
- Domain Transfer
- Nameserver Management
- Registrar Lock
- EPP Code Retrieval
- Domain Deletion
- Domain Availability Checks
- Domain Suggestions
- Domain Expiration Date Sync
- TLD & Pricing Sync
- Premium Domains

