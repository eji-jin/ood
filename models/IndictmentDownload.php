<?php

namespace app\models;

use PhpOffice\PhpWord\PhpWord;
use yii\db\Query;

/**
 * Генерирует и возвращает документ
 *
 * Class Document1Download
 * @package app\models
 */
class IndictmentDownload
{
    /**
     * Возвращает готовый документ для скачивания
     * @param number $id индекс в БД
     * @return \yii\console\Response|\yii\web\Response
     */
    public function getDocument($id)
    {
        $filepath = $this->generateDocument($id);
        return \Yii::$app->response->sendFile($filepath);
    }

    /**
     * Генерирует документ используя функции PhpWord
     *
     * @param $id
     * @return string Абсолютный путь к файлу (включая имя)
     * @see https://phpword.readthedocs.io/en/latest/general.html
     */
    private function generateDocument($id)
    {
        $w = new PhpWord();

        $section = $w->addSection();
        $section->addText('Бла бла');

        // это хня специфичная для акта
        $indectment = Indictment::findOne(['deal_id' => $id]);

        // это текст для подозреваемых
        // в таком формате
        // [
        //    [
        //        'protocol_id' -> 1,
        //        'value' -> 'обстоятельства обвинения'
        //    ],
        //    [
        //        'protocol_id' -> 2,
        //        'value' -> 'обстоятельства обвинения'
        //    ]
        // ]
        (new Query())->select(['protocol_id', 'value'])->from('indictment_protocol')->where(['indictment_id' => $indectment->id])->all();

        // это потерпевшие и свидетели
        $notSuspects = Protocol::find()->where(['!=', 'roleInThis', 'подозреваемый'])->andWhere(['deal_id' => $id])->all();

        $filename = \Yii::getAlias('@app/runtime/files/') . $id . '.docx';
        try {
            $w->save($filename, 'Word2007');
            return $filename;
        } catch (\Exception $e) {
            throw $e;
        }
    }

}