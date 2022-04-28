<?php

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

    return $unserializedAlert->render();
}
