<?php

namespace App\Extensions\GoogleAuth;

use BaconQrCode\Renderer\Image\ImagickImageBackEnd;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;

class WrapperGoogleAuth
{
    private $email = null;
    private $secretKey = null;
    private $google = null;

    public function __construct($email, $secretKey=null)
    {
        $this->email = $email;
        $this->secretKey = $secretKey;
        $this->google = app('pragmarx.google2fa');
    }

    /**
     * @return string
     */
    public function generateQrCode()
    {

        if (!$this->secretKey) {
            $this->generateSecretKey();
        }

        $g2faUrl = $this->google->getQRCodeUrl(
            config('app.name'),
            $this->email,
            $this->secretKey
        );

        $writer = new Writer(
            new ImageRenderer(
                new RendererStyle(400),
                new ImagickImageBackEnd()
            )
        );

        return base64_encode($writer->writeString($g2faUrl));
    }

    /**
     * Возвращает секретный ключ
     *
     * @return mixed|null
     */
    public function getSecretKey()
    {
        if (!$this->secretKey) {
            $this->generateSecretKey();
        }

        return $this->secretKey;
    }

    /**
     * Проверяет аутентификацию пользователя
     *
     * @return bool
     */
    public function checkAuth($code, $window=8)
    {
        return $this->google->verifyKey(
            $this->secretKey,
            $code,
            $window
        );
    }

    /**
     * Генерация секретного ключа
     *
     * @return void
     */
    private function generateSecretKey()
    {
        $this->secretKey = $this->google->generateSecretKey();
    }
}
