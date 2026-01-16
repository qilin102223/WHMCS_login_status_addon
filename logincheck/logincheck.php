<?php
/**
 * WHMCS Addon Module: logincheck
 * Client Area page requires login and shows a simple success message.
 */

if (!defined("WHMCS")) {
    die("This file cannot be accessed directly");
}

function logincheck_config()
{
    return [
        'name'        => 'Login Check',
        'description' => 'A minimal addon module that requires client login and shows a success page.',
        'version'     => '1.0.0',
        'author'      => 'You',
        'language'    => 'english',
    ];
}

function logincheck_activate()
{
    return ['status' => 'success', 'description' => 'Login Check activated.'];
}

function logincheck_deactivate()
{
    return ['status' => 'success', 'description' => 'Login Check deactivated.'];
}

function logincheck_clientarea($vars)
{
    // require client login
    // Once WHMCS sees requirelogin=true, it will redirect unauthenticated users to login.
    $clientId = isset($_SESSION['uid']) ? (int)$_SESSION['uid'] : 0;

    $clientEmail = '';
    $clientName  = '';

    // Query client info (minimal / no localAPI needed)
    try {
        $client = \WHMCS\Database\Capsule::table('tblclients')
            ->select('firstname', 'lastname', 'email')
            ->where('id', $clientId)
            ->first();

        if ($client) {
            $clientEmail = (string)$client->email;
            $clientName  = trim((string)$client->firstname . ' ' . (string)$client->lastname);
        }
    } catch (\Throwable $e) {
        // Keep it minimal: if DB fails, just show ID and blank fields
    }

    return [
        'pagetitle'    => 'Login Check',
        'breadcrumb'   => ['index.php?m=logincheck' => 'Login Check'],
        'templatefile' => 'clientarea',
        'requirelogin' => true, // <-- force login
        'vars'         => [
            'message'     => '✅ Logged in successfully.',
            'client_id'   => $clientId,
            'client_email'=> $clientEmail,
            'client_name' => $clientName,
        ],
    ];
}

