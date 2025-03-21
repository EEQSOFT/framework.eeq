<?php

declare(strict_types=1);

namespace App\Core;

class ErrorHandler
{
    public function __construct()
    {
        error_reporting(E_ALL);
        ini_set('display_errors', 'off');
        set_error_handler([$this, 'handleError']);
    }

    public function handleError(
        int $code,
        string $description,
        string $file,
        int $line
    ): bool {
        $displayErrors = ini_get('display_errors');
        $displayErrors = strtolower($displayErrors);

        if (error_reporting() === 0 || $displayErrors === 'on') {
            return false;
        }

        list($error, $log) = $this->mapErrorCode($code);

        $data = [
            'level' => $log,
            'code' => $code,
            'error' => $error,
            'description' => $description,
            'file' => $file,
            'line' => $line,
            'message' => $error . ' (' . $code . '): ' . $description
                . ' in [' . $file . ', line ' . $line . ']'
                . ' - ' . date('Y-m-d H:i:s')
        ];

        return $this->fileLog($data);
    }

    private function mapErrorCode(int $code): array
    {
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

    private function fileLog(
        mixed $logData,
        string $fileName = ERROR_LOG_FILE
    ): bool {
        $file = fopen($fileName, 'a+');

        if (is_array($logData)) {
            $logData = print_r($logData, true);
        }

        $status = fwrite($file, $logData);

        fclose($file);

        return (bool) $status;
    }
}
