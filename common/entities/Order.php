<?php

namespace common\entities;

use yii\db\ActiveRecord;
use Yii;
use yii\helpers\HtmlPurifier;

/**
 * This is the model class for table "{{%order}}".
 *
 * @property string $id
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property integer $date
 * @property string $time
 * @property string $notes
 * @property string $language
 * @property integer $qty
 * @property integer $dispatch
 * @property integer $status
 *
 */
class Order extends ActiveRecord
{

    public static function tableName()
    {
        return '{{%order}}';
    }

    public function rules()
    {
        return [
            [['name', 'date_form', 'qty', 'phone', 'time_from'], 'required'],
            [['qty', 'dispatch', 'status'], 'integer'],
            [['email'], 'email'],
            [['name'], 'string', 'max' => 255],
            [['date'], 'string', 'max' => 50],
            [['time',], 'string', 'max' => 11],
            [['phone', 'date_form'], 'string', 'max' => 20],
            [['time_from', 'time_till'], 'date', 'format' => 'php:H:i'],
            [['language'], 'string', 'max' => 2],
            [['notes'], 'string'],
            [['dispatch'], 'default', 'value' => '0'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'Номер',
            'name' => Yii::t('app', 'Имя'),
            'email' => 'Email',
            'phone' => Yii::t('app', 'Телефон'),
            'date' => Yii::t('app', 'Дата'),
            'date_form' => Yii::t('app', 'Дата'),
            'time' => Yii::t('app', 'Время'),
            'time_from' => Yii::t('app', 'Время от'),
            'time_till' => Yii::t('app', 'Время до'),
            'qty' => Yii::t('app', 'Персон'),
            'dispatch' => Yii::t('app', 'Рассылка'),
            'status' => 'Статус',
            'notes' => Yii::t('app', 'Пожелания'),
            'language' => Yii::t('app', 'Язык'),
            'verifyCode' => Yii::t('app', 'Проверочный код'),
        ];
    }

    private $html;
    public $verifyCode;
    public $time_from;
    public $time_till;
    public $date_form;

    public function sendEmail()
    {
        $email_date = Yii::$app->formatter->asDatetime($this->date, 'dd.MM.yyyy');
        $this->html .= "<style>";
        $this->html .= ".h2{ font-size:2em; font-weight:lighter; text-transform:uppercase;}";
        $this->html .= "</style>";
        $this->html .= "<table>";
        $this->html .= "<tr><td colspan='2' class='form-heading' ><h2>Резерв</h2></td><td></td></tr>";
        $this->html .= "<tr><td>Имя</td><td>: {$this->name}</td></tr>";
        $this->html .= "<tr><td>Телефон</td><td>: {$this->phone}</td></tr>";
        $this->html .= "<tr><td>Email</td><td>: {$this->email}</td></tr>";
        $this->html .= "<tr><td>Дата</td><td>: {$email_date}</td></tr>";
        $this->html .= "<tr><td>Время</td><td>: {$this->time}</td></tr>";
        $this->html .= "<tr><td>Персон</td><td>: {$this->qty}</td></tr>";
        $this->html .= "<tr><td>Комментарий</td><td>: {$this->notes}</td></tr>";
        $this->html .= "</table>";

        $message = Yii::$app->mailer->compose()
            ->setTo(Yii::$app->params['adminEmail'])
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name])
            ->setSubject('Сообщение от ' . $this->name)
            ->setHtmlBody($this->html);

        return Yii::$app->mailer->send($message);
    }
}
