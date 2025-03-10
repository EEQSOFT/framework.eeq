<?php

error_reporting(E_ALL);
ini_set('display_errors', 'off');
define('ERROR_LOG_FILE', __DIR__ . '/../../error.log');

function handleError(
    int $code,
    string $description,
    string $file = null,
    int $line = null,
    mixed $context = null
): bool {
    $displayErrors = ini_get('display_errors');
    $displayErrors = strtolower($displayErrors);

    if (error_reporting() === 0 || $displayErrors === 'on') {
        return false;
    }

    list($error, $log) = mapErrorCode($code);

    $data = [
        'level' => $log,
        'code' => $code,
        'error' => $error,
        'description' => $description,
        'file' => $file,
        'line' => $line,
        'context' => $context,
        'path' => $file,
        'message' => $error . ' (' . $code . '): ' . $description
            . ' in [' . $file . ', line ' . $line . ']'
    ];

    return fileLog($data);
}

function mapErrorCode(int $code): array {
    $error = null;
    $log = null;

    switch ($code) {
        case E_PARSE:
        case E_ERROR:
        case E_CORE_ERROR:
        case E_COMPILE_ERROR:
        case E_USER_ERROR:
            $error = 'Fatal Error';
            $log = LOG_ERR;

            break;
        case E_WARNING:
        case E_USER_WARNING:
        case E_COMPILE_WARNING:
        case E_RECOVERABLE_ERROR:
            $error = 'Warning';
            $log = LOG_WARNING;

            break;
        case E_NOTICE:
        case E_USER_NOTICE:
            $error = 'Notice';
            $log = LOG_NOTICE;

            break;
        case E_STRICT:
            $error = 'Strict';
            $log = LOG_NOTICE;

            break;
        case E_DEPRECATED:
        case E_USER_DEPRECATED:
            $error = 'Deprecated';
            $log = LOG_NOTICE;

            break;
        default:
            break;
    }

    return [$error, $log];
}

function fileLog(mixed $logData, string $fileName = ERROR_LOG_FILE): bool {
    $fh = fopen($fileName, 'a+');

    if (is_array($logData)) {
        $logData = print_r($logData, 1);
    }

    $status = fwrite($fh, $logData);

    fclose($fh);

    return ($status) ? true : false;
}

set_error_handler('handleError');
