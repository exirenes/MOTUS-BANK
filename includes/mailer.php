<?php
declare(strict_types=1);

/**
 * MOTUS BANK mailer — native PHP, no external packages.
 * Uses PHP's mail() by default. If MAIL_TRANSPORT=smtp, sends via raw socket.
 */
function mail_send(string $to, string $subject, string $htmlBody): bool {
    $transport = getenv('MAIL_TRANSPORT') ?: 'mail';
    $from      = getenv('MAIL_FROM_EMAIL') ?: 'no-reply@localhost';
    $fromName  = getenv('MAIL_FROM_NAME')  ?: brand('name');

    $headers  = "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
    $headers .= 'From: ' . mail_encode_name($fromName) . " <{$from}>\r\n";

    if ($transport === 'smtp') {
        return mail_send_smtp($to, $subject, $htmlBody, $headers, $from, $fromName);
    }
    return @mail($to, mail_encode_subject($subject), $htmlBody, $headers);
}

function mail_encode_name(string $name): string {
    return '=?UTF-8?B?' . base64_encode($name) . '?=';
}
function mail_encode_subject(string $s): string {
    return '=?UTF-8?B?' . base64_encode($s) . '?=';
}

/** Minimal SMTP client using PHP streams. */
function mail_send_smtp(string $to, string $subject, string $html, string $headers,
                        string $from, string $fromName): bool {
    $host  = getenv('MAIL_HOST') ?: '';
    $port  = (int)(getenv('MAIL_PORT') ?: 587);
    $user  = getenv('MAIL_USER') ?: '';
    $pass  = getenv('MAIL_PASS') ?: '';
    $enc   = strtolower(getenv('MAIL_ENCRYPTION') ?: 'tls');

    if ($host === '') { error_log('smtp: host missing'); return false; }

    $proto = ($enc === 'ssl') ? 'ssl://' : '';
    $fp = @stream_socket_client($proto . $host . ':' . $port, $errno, $errstr, 15);
    if (!$fp) { error_log("smtp connect fail: $errstr"); return false; }

    $read = function() use ($fp): string {
        $data = '';
        while (!feof($fp)) {
            $line = fgets($fp, 515);
            if ($line === false) break;
            $data .= $line;
            if (isset($line[3]) && $line[3] === ' ') break;
        }
        return $data;
    };
    $send = function(string $cmd) use ($fp, $read): string {
        fwrite($fp, $cmd . "\r\n");
        return $read();
    };

    $read(); // banner
    $send('EHLO localhost');

    if ($enc === 'tls') {
        $send('STARTTLS');
        stream_socket_enable_crypto($fp, true, STREAM_CRYPTO_METHOD_TLS_CLIENT);
        $send('EHLO localhost');
    }
    if ($user !== '') {
        $send('AUTH LOGIN');
        $send(base64_encode($user));
        $send(base64_encode($pass));
    }

    $send("MAIL FROM:<{$from}>");
    $send("RCPT TO:<{$to}>");
    $send('DATA');

    $msg  = "Subject: " . mail_encode_subject($subject) . "\r\n";
    $msg .= $headers;
    $msg .= "\r\n" . $html . "\r\n.";
    $resp = $send($msg);
    $send('QUIT');
    fclose($fp);

    return str_starts_with($resp, '250');
}