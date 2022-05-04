<?php

/**
 * @param string|null $url
 * @return void
 */
function redirect(?string $url = null): void
{
    $url = $url ?? CONF_APP_URL;
    header("Location: {$url}");
    exit();
}

/**
 * Obtém sessão
 * @return \App\Core\Session
 */
function session(): \App\Core\Session
{
    return (new \App\Core\Session());
}

/**
 * Obtém e renderiza alerta armazenada na sessão
 * @return string|null
 */
function flash_alert(): ?string
{
    $alert = session()->alert;
    if (!$alert) return null;

    /** @var \App\Core\Alert */
    $unserializedAlert = unserialize($alert);

    session()->unset("alert");

    return $unserializedAlert->render();
}

/**
 * @return \App\Models\User|null
 */
function logged(): ?\App\Models\User
{
    if ($id = session()->auth)
        return (new \App\Models\User())->findById($id);

    return null;
}
