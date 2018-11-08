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
        $indictment->deal_id = $postValues['indictment']['date_indict'];
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
        $indictment->evidences = $postValues['indictment']['evidences'];
        $indictment->date_indict = $postValues['indictment']['date_indict'];

        $indictment->save();
        // TODO: обновлять данные если уже существует

        // save suspects
        if (isset($postValues['meta'])) {
            foreach ($postValues['meta'] as $suspect) {
//            try {
//                (new Query())->createCommand()->insert('indictment_protocol', [
//                    'indictment_id' => $indictment->id,
//                    'protocol_id' => $suspect['protocol_id'],
//                    'value' => $suspect['value'],
//                ])->execute();
//            } catch (IntegrityException $e) {
//                (new Query())->createCommand()->update('indictment_protocol', [
//                    'value' => $suspect['value'],
//                ],[
//                    'indictment_id' => $indictment->id,
//                    'protocol_id' => $suspect['protocol_id'],
//                ])->execute();
//            }
                \Yii::$app->db->createCommand()->upsert('indictment_protocol', [
                    'indictment_id' => $indictment->id,
                    'protocol_id' => $suspect['protocol_id'],
                    'value' => $suspect['value'],
                    'otyagch' => $suspect['otyagch'],
                    'smyagch' => $suspect['smyagch'],
                    'costs'=> $suspect['costs'],
                    'mera_prin'=> $suspect['mera_prin'],
                ], [
                    'value' => $suspect['value'],
                    'otyagch' => $suspect['otyagch'],
                    'smyagch' => $suspect['smyagch'],
                    'costs'=> $suspect['costs'],
                    'mera_prin'=> $suspect['mera_prin'],
                ])->execute();

            }
        }

        // save notsuspects
        if (isset($postValues['notsuspects'])) {
            foreach ($postValues['notsuspects'] as $notsuspect) {
                $protocol = Protocol::findOne($notsuspect['protocol_id']);
                $protocol->indications = $notsuspect['value'];
                $protocol->indications = $notsuspect['otyagch'];
                $protocol->indications = $notsuspect['smyagch'];

                $protocol->indications = $notsuspect['costs'];
                $protocol->indications = $notsuspect['mera_prin'];
                $protocol->save();
            }
        }
    }
}