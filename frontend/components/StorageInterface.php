<?php

namespace frontend\components;

use yii\web\UploadedFile;

interface StorageInterface
{
    public function saveUploadFile(UploadedFile $file);

    public function getFile($filename);

}