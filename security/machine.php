<?php

function getMachineId()
{
    $data = [
        'os' => PHP_OS_FAMILY,
        'server' => $_SERVER['SERVER_NAME'] ?? '',
        'document_root' => realpath($_SERVER['DOCUMENT_ROOT'] ?? '') ?: '',
    ];

    return hash('sha256', json_encode($data));
}