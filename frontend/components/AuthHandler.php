<?php

namespace frontend\components;

use Yii;
use frontend\models\Auth;
use frontend\models\User;
use yii\helpers\ArrayHelper;
use yii\authclient\ClientInterface;

class AuthHandler
{
    private $client;

    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    public function handle()
    {
        if (!Yii::$app->user->isGuest){
            return;
        }

        $attributes = $this->client->getUserAttributes();

        $auth = $this->findAuth($attributes);
        if ($auth)
        {
            /** @var $user User hasOne */
            $user = $auth->user;
            return Yii::$app->user->login($user);
        }
        if($user = $this->createAccount($attributes))
        {
            return Yii::$app->user->login($user);
        }
    }

    private function findAuth($attributes)
    {
        $id = ArrayHelper::getValue($attributes, 'id');
        $params = [
            'source_id' => $id,
            'source' => $this->client->getId(),
        ];
        return Auth::find()->where($params)->one();
    }

    private function createAccount($attributes)
    {
        $id = ArrayHelper::getValue($attributes, 'id');
        $name = ArrayHelper::getValue($attributes, 'first_name');

        if($name !== null and User::find()->where(['username' => $name])->exists())
        {
            return;
        }

        $user = $this->createUser($name);

        $transaction = User::getDb()->beginTransaction();
        if ($user->save())
        {
            $auth = $this->createAuth($user->id, $id);
            if ($auth->save())
            {
                $transaction->commit();
                return $user;
            }
        }
        $transaction->rollBack();
    }

    private function createUser($name)
    {
        return new User([
            'username' => $name,
            'auth_key' => Yii::$app->security->generateRandomString(),
            'password_hash' => Yii::$app->security->generatePasswordHash(Yii::$app->security->generateRandomString()),
            'created_at' => $time = time(),
            'status' => User::STATUS_ACTIVE,
            'updated_at' => $time,
        ]);
    }

    private function createAuth($userId, $sourceId)
    {
        return new Auth([
            'user_id' => $userId,
            'source' => $this->client->getId(),
            'source_id' => $sourceId,
        ]);
    }
}