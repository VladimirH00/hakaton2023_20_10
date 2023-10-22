### Расширение для аутентификации по google ключу

#### Зависимости

Библиотека для работы с google auth `pragmarx/google2fa-laravel`  
Библиотека для работы с  `bacon/bacon-qr-code`

### Использование

#### Для генерации Qr-code необходимо:

```php
$google = new WrapperGoogleAuth('some email');

$base64 = $google->generateQrCode();
```

Чтобы отобразить qr code необходимо `<img src="<?=$base64; ?>">`

#### Проверка кода с телефона

```php
$google = new WrapperGoogleAuth('email', 'private key');

$google->checkAuth('code the phone')
```

#### Получение private key

Этот приватный ключ будет исползоваться для дальнейшего стравнения вводимого пользователм кодас телефона

```php
$google = new WrapperGoogleAuth('email');

$google->getSecretKey();
```
