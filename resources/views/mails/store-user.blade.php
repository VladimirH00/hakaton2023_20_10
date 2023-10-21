<?php
/**
 * @var string $code
 * @var string $qrCode
 */
?>

<h4>Добрый день!</h4>
<p>Вас добавили на платформу Oggetto для подтверждения вашего аккаунта, необходимо привязать google auth</p>
<p>Это можно сделать с помощью <b>кода:</b> {{ $secretKey }} </p>

Либо отсканировать Qr-code:

<div>
    {!! $qrCode !!}
</div>
