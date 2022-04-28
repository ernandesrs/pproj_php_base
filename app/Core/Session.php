<?php

namespace App\Core;

use stdClass;

class Session
{
    /** @var string */
    private $appName;

    /** @var stdClass */
    private $session;

    public function __construct()
    {
        $this->appName = md5(CONF_APP_NAME);

        if (!isset($_SESSION[$this->appName])) {
            $_SESSION[$this->appName] = [];
        }

        $this->session = (object) $_SESSION[$this->appName];
    }

    /**
     * @return stdClass
     */
    public function all(): stdClass
    {
        return $this->session;
    }

    /**
     * @return void
     */
    public function clearAll(): void
    {
        $this->session = (object) [];
        $this->update();
        return;
    }

    /**
     * @param string $name
     * @return void
     */
    public function unset(string $name): void
    {
        if ($this->session->$name ?? false) {
            unset($this->session->$name);
            $this->update();
            return;
        }
        return;
    }

    /**
     * @param string $name
     * @param mixed $value
     * @return void
     */
    public function __set(string $name, $value): void
    {
        if (is_object($value))
            $value = serialize($value);

        $this->session->$name = $value;
        $this->update();
        return;
    }

    /**
     * @param string $name
     * @return mixed|null
     */
    public function __get(string $name)
    {
        return $this->session->$name ?? null;
    }

    /**
     * @param string $string
     * @return mixed
     */
    public function unserialize(string $string)
    {
        return unserialize($string);
    }

    /**
     * @return bool
     */
    private function update(): bool
    {
        $_SESSION[$this->appName] = (array) $this->session;
        return true;
    }
}
