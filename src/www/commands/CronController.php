<?php

namespace app\commands;

use Yii;
use yii\console\Controller;

class CronController extends Controller
{

    protected function begin($key)
    {
        Yii::info('Begin cron: '.$key, 'console');

        if (!Yii::$app->mutex->acquire($key, 300))
        {
            Yii::info('Lock of '.$key.' already got from someone else', 'console');
            return false;
        }

        return true;
    }

    public function actionMinutely($date = null) {
        if(!$this->begin('cron.minutely:'.date('Y-m-d H:i')))
            return;

    }

    public function actionHourly()
    {
        if(!$this->begin('cron.hourly:'.date('Y-m-d H')))
            return;
    }

    public function actionDaily()
    {
        if (!$this->begin('cron.daily:' . date('Y-m-d')))
            return;
    }

}