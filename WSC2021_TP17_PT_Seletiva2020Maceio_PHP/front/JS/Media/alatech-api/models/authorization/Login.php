<?php

namespace app\models\authorization;

class Login extends \yii\base\Model
{
    /** @var String */
    public $username;
    /** @var String */
    public $password;

    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
            [['username', 'password'], 'string', 'min' => 6],
        ];
    }
}
