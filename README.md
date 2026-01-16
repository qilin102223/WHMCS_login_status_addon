# WHMCS Login Check Addon Module

A minimal WHMCS **Addon Module** that adds a Client Area page requiring authentication.  
When a client visits the module page, WHMCS will force login (`requirelogin => true`). After login, the page displays:

- Client ID
- Name
- Email
- A simple “Logged in successfully” message

## Features

- ✅ Client Area page (`index.php?m=logincheck`)
- 🔒 Requires client login (`requirelogin => true`)
- 👤 Shows logged-in client info (ID / name / email)

## Installation

1. Create the following directories:

```

modules/addons/logincheck/
modules/addons/logincheck/templates/

```

2. Add files:

- `modules/addons/logincheck/logincheck.php`
- `modules/addons/logincheck/templates/clientarea.tpl`

3. In WHMCS Admin, activate the module:

**Configuration → System Settings → Addon Modules → Login Check → Activate**

## Usage

Open:

```

https://your-whmcs-domain.com/index.php?m=logincheck

```

- If not logged in, WHMCS redirects to the login page.
- If logged in, it shows client details and a success message.

## Notes

- Client info is read from `tblclients` via WHMCS Capsule.
- This is intended as a simple testing/demo module.
