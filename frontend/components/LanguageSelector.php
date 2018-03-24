<?php
/**
 * Created by PhpStorm.
 * User: Kirilloid
 * Date: 24.03.2018
 * Time: 22:11
 */

namespace frontend\components;
use yii\base\BootstrapInterface;

class LanguageSelector implements BootstrapInterface
{
    public $supportedLanguages = ['en-US','ru-RU'];

    public function bootstrap($app)
    {
        $cookieLanguage = $app->request->cookies['language'];
        if (isset($cookieLanguage) and in_array($cookieLanguage, $this->supportedLanguages))
        {
            $app->language = $app->request->cookies['language'];
        }
    }
}