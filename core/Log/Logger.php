<?php

namespace Core\Log;

use Core\Log\Psr\LoggerInterface;
use Core\Log\Psr\LogLevel;

class Logger extends LogLevel implements LoggerInterface
{
    protected string $logPath;
    protected string $time;

    public function __construct()
    {
        $this->logPath = AppRootDirectory . '/Stroage/Logs/app.log';
        $this->time = date('d/m/Y G:i:s');
    }

    public function emergency($message, array $context = array())
    {
        $this->log(Logger::EMERGENCY, $message);
    }

    public function alert($message, array $context = array())
    {
        $this->log(Logger::ALERT, $message);
    }

    public function critical($message, array $context = array())
    {
        $this->log(Logger::CRITICAL, $message);
    }

    public function error($message, array $context = array())
    {
        $this->log(Logger::ERROR, $message);
    }

    public function warning($message, array $context = array())
    {
        $this->log(Logger::WARNING, $message);
    }

    public function notice($message, array $context = array())
    {
        $this->log(Logger::NOTICE, $message);
    }

    public function info($message, array $context = array())
    {
        $this->log(Logger::INFO, $message);
    }

    public function debug($message, array $context = array())
    {
        $this->log(Logger::DEBUG, $message);
    }

    public function log($level, $message, array $context = array())
    {
        $userRole =  'Anonim';

        $userId = '';
        if (user() != null) {
            $user = user();
            $userRole = $user->getRole();
            $userId = "Kullanıcı No: $user->id -";
        }

        $data = $userRole . " " . $level . " " . $userId . " " . $this->time . " " . $message . PHP_EOL;
        file_put_contents($this->logPath, $data, FILE_APPEND);
    }
}
