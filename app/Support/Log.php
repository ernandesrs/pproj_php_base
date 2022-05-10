<?php

namespace App\Support;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class Log
{
    /** @var Logger */
    private $engine;

    /** @var string */
    public $logsDir;

    /**
     * @param string $name
     * @param string $log
     */
    public function __construct(string $name = "default", string $log = "logs")
    {
        $this->engine = new Logger($name);
        $this->logsDir = CONF_BASE_PATH . DIRECTORY_SEPARATOR . CONF_LOGS_DIR;
        $this->engine->pushHandler(new StreamHandler(CONF_BASE_PATH . "/storage/logs/{$log}.log"));
    }

    /**
     * @param string $message
     * @param array $context
     * @return Log
     */
    public function debug(string $message, array $context = []): Log
    {
        $this->engine->debug($message, $context);
        return $this;
    }

    /**
     * @param string $message
     * @param array $context
     * @return Log
     */
    public function info(string $message, array $context = []): Log
    {
        $this->engine->info($message, $context);
        return $this;
    }

    /**
     * @param string $message
     * @param array $context
     * @return Log
     */
    public function notice(string $message, array $context = []): Log
    {
        $this->engine->notice($message, $context);
        return $this;
    }

    /**
     * @param string $message
     * @param array $context
     * @return Log
     */
    public function warning(string $message, array $context = []): Log
    {
        $this->engine->warning($message, $context);
        return $this;
    }

    /**
     * @param string $message
     * @param array $context
     * @return Log
     */
    public function error(string $message, array $context = []): Log
    {
        $this->engine->error($message, $context);
        return $this;
    }

    /**
     * @param string $message
     * @param array $context
     * @return Log
     */
    public function critical(string $message, array $context = []): Log
    {
        $this->engine->critical($message, $context);
        return $this;
    }

    /**
     * @param string $message
     * @param array $context
     * @return Log
     */
    public function alert(string $message, array $context = []): Log
    {
        $this->engine->alert($message, $context);
        return $this;
    }

    /**
     * @param string $message
     * @param array $context
     * @return Log
     */
    public function emergency(string $message, array $context = []): Log
    {
        $this->engine->emergency($message, $context);
        return $this;
    }
}
