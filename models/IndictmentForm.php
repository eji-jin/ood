<?php

namespace app\models;

use yii\base\Model;
use yii\db\IntegrityException;
use yii\db\Query;

class IndictmentForm extends Model
{
    public function save($postValues)
    {
        /*
        $postValues представляет собой массив
        [
            'meta'        => [...],
            'notsuspects' => [...],
            'indictments' => [...],
        ]
        */
        \Yii::warning(print_r($postValues, true));
        // save indictment
        $indictment = Indictment::findOne(['deal_id' => $postValues['indictment']['deal_id']]) ?: new Indictment();
        $indictment->deal_id = $postValues['indictment']['deal_id'];
        $indictment->area = $postValues['indictment']['area'];
        $indictment->title = $postValues['indictment']['title'];
        $indictment->prosecutor = $postValues['indictment']['prosecutor'];
        $indictment->chiefposition = $postValues['indictment']['chiefposition'];
        $indictment->chiefrank = $postValues['indictment']['chiefrank'];
        $indictment->chiefname = $postValues['indictment']['chiefname'];
        $indictment->handinfo = $postValues['indictment']['handinfo'];
        $indictment->resolution = $postValues['indictment']['resolution'];
        $indictment->expertise = $postValues['indictment']['expertise'];
        $indictment->eviden	 = $postValues['indictment']['eviden'];
        $indictment->excircum = $postValues['indictment']['excircum'];
        $indictment->aggcircum = $postValues['indictment']['aggcircum'];
        $indictment->save();
        // TODO: обновлять данные если уже существует

        // save suspects
        if (isset($postValues['meta'])) {
            foreach ($postValues['meta'] as $suspect) {
                \Yii::$app->db->createCommand()->upsert('indictment_protocol', [
                    'indictment_id' => $indictment->id,
                    'protocol_id' => $suspect['protocol_id'],
                    'value' => $suspect['value'],
                ], [
                    'value' => $suspect['value'],
                ])->execute();

        }

        // save notsuspects
            if (isset($postValues['notsuspects'])) {
                foreach ($postValues['notsuspects'] as $notsuspect) {
                    $protocol = Protocol::findOne($notsuspect['protocol_id']);
                    $protocol->indications = $notsuspect['value'];
                    $protocol->save();
                }
        }
    }
}