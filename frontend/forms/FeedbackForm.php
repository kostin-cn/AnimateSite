<?php

namespace frontend\forms;

use Yii;
use yii\base\Model;
use yii\helpers\Html;

class FeedbackForm extends Model
{
    public $message;
    public $verifyCode;

    public function rules()
    {
        return array_filter([
            [['message'], 'required'],
            ['verifyCode', 'captcha', 'captchaAction' => 'site/captcha'],
            [['message'], 'string'],
        ]);
    }

    public function attributeLabels()
    {
        return [
            'message' => Yii::t('app', 'Message'),
            'verifyCode' => Yii::t('app', 'Verify Code')
        ];
    }

    public function sendEmail()
    {
        return Yii::$app->mailer->compose()
            ->setTo(Yii::$app->params['adminEmail'])
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name])
            ->setSubject('feedback form ERAI')
            ->setTextBody(Html::encode($this->message))
            ->send();
    }
}