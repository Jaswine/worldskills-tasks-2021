<?php

namespace app\models\authorization;

class Logout extends \yii\base\Model
{
    /** @var String */
    public $token;

    public function rules()
    {
        return [
            [['token'], 'required'],
            [['token'], 'string', 'length' => 32],
        ];
    }
}
