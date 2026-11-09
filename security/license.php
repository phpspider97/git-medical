<?php

require_once __DIR__ . '/machine.php';

function validateLicense()
{
    $licenseFile = __DIR__ . '/license.json';

    if (!file_exists($licenseFile)) {
        die('License not found. Please activate your software.');
    }

    $license = json_decode(
        file_get_contents($licenseFile),
        true
    );

    if (!$license) {
        die('Invalid license file.');
    }

    if (($license['status'] ?? '') !== 'active') {
        die('Your license is inactive.');
    }
 
    if (($license['machine_id'] ?? '') !== getMachineId()) {
        die('This software is not licensed for this computer.');
    }

    if (strtotime($license['expires_at'] ?? '') < time()) {
        die('Your license has expired.');
    }

    return true;
}

validateLicense();