<?php

namespace App\Core;

use PHPMailer\PHPMailer\Exception as PHPMailerException;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

class Mail
{
    /** @var PHPMailer */
    private $engine;

    /** @var string */
    private $errorInfo;

    /**
     * @param string $subject
     * @param string $body
     */
    public function __construct(string $subject, string $body)
    {
        $this->engine = new PHPMailer(true);
        $this->setContent($subject, $body);

        try {
            // Server settings
            if (CONF_APP_LOCAL) {
                $this->engine->SMTPOptions = CONF_MAIL_SMTP_OPTIONS;
            }
            $this->engine->SMTPDebug = SMTP::DEBUG_OFF;

            $this->engine->isSMTP(); // Send using SMTP
            $this->engine->CharSet = "utf-8";
            $this->engine->Host = CONF_MAIL_HOST; // Set the SMTP server to send through
            if (CONF_MAIL_SMTP_AUTH) {
                $this->engine->SMTPAuth = true; // Enable SMTP authentication
                $this->engine->SMTPSecure = CONF_MAIL_ENCRYPTION; // Enable implicit TLS encryption
            } else {
                $this->engine->SMTPAuth = false; // Enable SMTP authentication
            }

            $this->engine->Port = CONF_MAIL_PORT; // TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
            $this->engine->Username = CONF_MAIL_USERNAME; // SMTP username
            $this->engine->Password = CONF_MAIL_PASSWORD; // SMTP password
        } catch (PHPMailerException $e) {
            echo "Message could not be sent. Mailer Error: {$this->engine->ErrorInfo} | " . $e->getMessage();
        }
    }

    /**
     * @param string $mailAddress
     * @param string $name
     * @return Mail
     */
    public function addRecipient(string $mailAddress, string $name = ""): Mail
    {
        $this->engine->addAddress($mailAddress, $name);
        return $this;
    }

    /**
     * @param string $attachPath
     * @param string $name
     * @return Mail
     */
    public function addAttachment(string $attachPath, string $name = ""): Mail
    {
        $this->engine->addAttachment($attachPath, $name);
        return $this;
    }

    /**
     * @param string $subject
     * @param string $body
     * @param string|null $altBody
     * @param bool $isHtml
     * @return Mail
     */
    private function setContent(string $subject, string $body, ?string $altBody = null, bool $isHtml = true): Mail
    {
        $this->engine->isHTML($isHtml);
        $this->engine->Subject = $subject;
        $this->engine->Body = $body;
        $this->engine->AltBody = $altBody;
        return $this;
    }

    /**
     * @param string $replyToAddress
     * @param string|null $replyToName
     * @return Mail
     */
    public function replyTo(string $replyToAddress, string $replyToName = null): Mail
    {
        $this->engine->addReplyTo($replyToAddress, $replyToName ?? "");
        return $this;
    }

    /**
     * @param string $fromMailAddress
     * @param string $fromName
     * @return bool
     * @throws PHPMailerException
     */
    public function send(string $fromMailAddress = CONF_MAIL_FROM_ADDRESS, string $fromName = CONF_MAIL_FROM_NAME)
    {
        $this->engine->setFrom($fromMailAddress, $fromName);

        try {
            return $this->engine->send();
        } catch (PHPMailerException $e) {
            $this->errorInfo = $e->getMessage();
            return false;
        }
    }

    /**
     * @return string|null
     */
    public function error(): ?string
    {
        return empty($this->errorInfo) ? $this->errorInfo : $this->engine->ErrorInfo;
    }

    /**
     * @return Mail
     */
    public function debug(): Mail
    {
        $this->engine->SMTPDebug = SMTP::DEBUG_SERVER;
        return $this;
    }
}
