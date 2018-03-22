<?php

namespace frontend\components;

use frontend\components\StorageInterface;
use yii\base\Component;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;
use Yii;

class Storage extends Component implements StorageInterface
{

    private $filename;

    public function saveUploadFile(UploadedFile $file)
    {
        $path = $this->preparePath($file);

        if ($path and $file->saveAs($path))
        {
            return $this->filename;
        }

    }

    public function getFile($filename)
    {
        return Yii::$app->params['storageUri'].$filename;
    }

    public function preparePath(UploadedFile $file)
    {
        $this->filename = $this->getFilename($file);

        $path = $this->getStoragePath().$this->filename;

        $path = FileHelper::normalizePath($path);
        if (FileHelper::createDirectory(dirname($path)))
        {
            return $path;
        }
    }

    protected function getFilename(UploadedFile $file)
    {
        $hash = sha1_file($file->tempName);

        $name = substr_replace($hash, '/', 2, 0);
        $name = substr_replace($name, '/', 5, 0);
        return $name.'.'.$file->extension;
    }

    protected function getStoragePath()
    {
        return Yii::getAlias(Yii::$app->params['storagePath']);
    }

    public function deleteFile($filename)
    {
        $file = $this->getStoragePath().$filename;

        if(file_exists($file))
        {
            return unlink($file);
        }
        return true;
    }
}