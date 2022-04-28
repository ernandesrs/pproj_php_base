<?php

namespace App\Core;

class Alert
{
    private const DEFAULT = "default";
    private const SUCCESS = "success";
    private const INFO = "info";
    private const WARNING = "warning";
    private const DANGER = "danger";

    private const FIXED = "fixed";
    private const FLOATING = "floating";

    /** @var string */
    private $title;

    /** @var string */
    private $message;

    /** @var string */
    private $style;

    /** @var string */
    private $type;

    /** @var int */
    private $time;

    public function __construct()
    {
        $this->title = "";
        $this->message = "";
        $this->style = self::DEFAULT;
        $this->type = 'fixed';
        $this->time = 0;
    }

    /**
     * @param string $message
     * @param string|null $title
     * @return Alert
     */
    public static function success(string $message, ?string $title = null): Alert
    {
        return (new Alert())->set($message, $title, self::SUCCESS);
    }

    /**
     * @param string $message
     * @param string|null $title
     * @return Alert
     */
    public static function info(string $message, ?string $title = null): Alert
    {
        return (new Alert())->set($message, $title, self::INFO);
    }

    /**
     * @param string $message
     * @param string|null $title
     * @return Alert
     */
    public static function warning(string $message, ?string $title = null): Alert
    {
        return (new Alert())->set($message, $title, self::WARNING);
    }

    /**
     * @param string $message
     * @param string|null $title
     * @return Alert
     */
    public static function error(string $message, ?string $title = null): Alert
    {
        return (new Alert())->set($message, $title, self::DANGER);
    }

    /**
     * @param string $message
     * @param string|null $title
     * @return Alert
     */
    public static function default(string $message, ?string $title = null): Alert
    {
        return (new Alert())->set($message, $title, self::DEFAULT);
    }

    /**
     * Alerta flutuante
     * @param int $time tempo em segundos que o alerta ficará visível
     * @return Alert
     */
    public function floating(int $time = 7): Alert
    {
        $this->time = $time;
        $this->type = self::FLOATING;
        return $this;
    }

    /**
     * Alerta fixo
     * @return Alert
     */
    public function fixed(): Alert
    {
        $this->time = 0;
        $this->type = self::FIXED;
        return $this;
    }

    /**
     * Armazena mensagem na sessão
     * @return void
     */
    public function session(): void
    {
        $session = new Session();
        $session->alert = $this;
        return;
    }

    /**
     * Alerta para array
     * @return array
     */
    public function get(): array
    {
        return [
            "title" => $this->title,
            "message" => $this->message,
            "style" => $this->style,
            "type" => $this->type,
            "time" => $this->time,
        ];
    }

    /**
     * Alerta para json
     * @return string
     */
    public function json(): string
    {
        return json_encode($this->get());
    }

    /**
     * Alerta para html
     * @return string
     */
    public function render(): string
    {
        $alertHeading = empty($this->title) ? null : "<div class='alert-heading'>{$this->title}</div>";
        $time = $this->type == self::FLOATING ? " data-time='{$this->time}'" : null;
        $alert = "
            <div class='alert alert-{$this->style} alert-dismissible alert-{$this->type}'{$time}>
                {$alertHeading}
                <div class='alert-body'>{$this->message}</div>
            </div>
        ";
        return $alert;
    }

    /**
     * Verifica se existe um alerta armazenado na sessão
     * @return bool
     */
    public static function hasAlert(): bool
    {
        return (new Session())->alert ? true : false;
    }

    /**
     * @param string $message
     * @param string|null $title
     * @param string $style
     * @return Alert
     */
    private function set(string $message, ?string $title = null, string $style = self::DEFAULT): Alert
    {
        $this->title = $title;
        $this->message = $message;
        $this->style = $style;
        return $this;
    }
}
