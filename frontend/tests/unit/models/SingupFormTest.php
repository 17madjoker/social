<?php
namespace frontend\tests\models;

use frontend\modules\user\models\SignupForm;

class SingupFormTest extends \Codeception\Test\Unit
{
    /**
     * @var \frontend\tests\UnitTester
     */
    protected $tester;

    public function _before()
    {
        $this->tester->haveFixtures([
            'user' => [
                'class' => \frontend\tests\fixtures\UserFixture::className()
            ]
        ]);
    }

    public function testTrimUsername()
    {
        $model = new SignupForm([
            'username' => '  some_username ',
            'email' => 'test@mail.com',
            'password' => '111111'
        ]);

        $model->signup();

        expect($model->username)->equals('some_username');
    }

    public function testUsernameRequired()
    {
        $model = new SignupForm([
            'username' => '',
            'email' => 'test@mail.com',
            'password' => '111111'
        ]);

        $model->signup();

        expect($model->getFirstError('username'))
            ->equals('Username cannot be blank.');
    }

    public function testUsernameToShort()
    {
        $model = new SignupForm([
            'username' => 'q',
            'email' => 'test@mail.com',
            'password' => '111111'
        ]);

        $model->signup();

        expect($model->getFirstError('username'))
            ->equals('Username should contain at least 2 characters.');
    }

    public function testPasswordRequired()
    {
        $model = new SignupForm([
            'username' => 'qqwe',
            'email' => 'test@mail.com',
            'password' => ''
        ]);

        $model->signup();

        expect($model->getFirstError('password'))
            ->equals('Password cannot be blank.');
    }

    public function testEmailUniq()
    {
        $model = new SignupForm([
            'username' => 'qqwe',
            'email' => '1@got.com',
            'password' => '111111'
        ]);

        $model->signup();

        expect($model->getFirstError('email'))
            ->equals('This email address has already been taken.');
    }
}