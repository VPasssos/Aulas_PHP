
<?php
/**
 * Envia e-mail com fallback para arquivo local (emails/outbox.txt)
 * Retorna true/false.
 */
function enviar_email($to, $subject, $message) {
    $headers  = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=utf-8\r\n";
    $headers .= "From: no-reply@localhost\r\n";

    // Tenta usar mail()
    $ok = @mail($to, $subject, $message, $headers);
    if ($ok) return true;

    // Fallback: grava no arquivo (útil em dev)
    $dir = __DIR__ . 'emails';
    if (!is_dir($dir)) @mkdir($dir, 0775, true);
    $file = $dir . 'outbox.txt';
    $content = "Para: $to\nAssunto: $subject\nMensagem:\n$message\n-------------------------\n";
    return (bool) file_put_contents($file, $content, FILE_APPEND);
}
