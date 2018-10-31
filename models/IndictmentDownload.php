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
     * @param id
     * @return string Абсолютный путь к файлу (включая имя)
     * @see https://phpword.readthedocs.io/en/latest/general.html
     */
    private function generateDocument($id)
    {
        $w = new PhpWord();
        $section = $w->addSection();
        // это хня специфичная для акта
        $indectment = Indictment::findOne(['deal_id' => $id]);
        $deals = Deal::findOne($id);
       // $section->addText($deals['number']);
        $prot = Protocol::findOne(['deal_id' => $id]);
        $Suspects = Protocol::find()->where(['=', 'roleInThis', 'подозреваемый'])->andWhere(['deal_id' => $id])->all();

        $names = "";
        foreach ($Suspects as $Suspect) {
            $names .= " ";
            $names .= $Suspect->suspect;
        }

        $section->addText('ОБВИНИТЕЛЬНЫЙ АКТ',null, array('align' =>'center', 'spaceAfter' =>0));
        $section->addText('ПО УГОЛОВНОМУ ДЕЛУ № '.$deals['number'],null, array('align' =>'center', 'spaceAfter' =>0));
        $section->addText('по обвинению'. $names .' в совершении преступления предусмотренного '. $prot['incriminate'],null, array('align' =>'both', 'spaceAfter' =>0));


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

        /*$suspects = (new Query())->select(['protocol_id', 'value'])->from('indictment_protocol')->where(['indictment_id' => $indectment->id])->all();
            $section->addText(Protocol::findOne($suspect['protocol_id'])->suspect);
            $section->addText($suspect['value']);*/


        $suspectes = (new Query())->select(['protocol_id', 'value'])->from('indictment_protocol')->where(['indictment_id' => $indectment->id])->all();
        foreach ($Suspects as $Suspect) {

            $section->addText('1. Фамилия, Имя, Отчество: ' . $Suspect->suspect,null, array('align' =>'both', 'spaceAfter' =>0));
            $section->addText('2. Дата рождения: ' . $Suspect->birthdate,null, array('align' =>'both', 'spaceAfter' =>0));
            $section->addText('3. Место жительсва и (или) регистрации: ' . $Suspect->residence,null, array('align' =>'both', 'spaceAfter' =>0));
            $section->addText('4. Место рождения: ' . $Suspect->birthplace,null, array('align' =>'both', 'spaceAfter' =>0));
            $section->addText('5. Гражданство: ' . $Suspect->nat,null, array('align' =>'both', 'spaceAfter' =>0));
            $section->addText('6. Образование: ' . $Suspect->educat,null, array('align' =>'both', 'spaceAfter' =>0));
            $section->addText('7. Семейное положение, состав семьи: ' . $Suspect->famstat,null, array('align' =>'both', 'spaceAfter' =>0));
            $section->addText('8. Место работы: ' . $Suspect->workplace,null, array('align' =>'both', 'spaceAfter' =>0));
            $section->addText('9. Отношение к воинской обязанности: ' . $Suspect->duty,null, array('align' =>'both', 'spaceAfter' =>0));
            $section->addText('10. Наличие судимости: ' . $Suspect->crime,null, array('align' =>'both', 'spaceAfter' =>0));
            $section->addText('11. Паспорт или иной документ удостоверяющий личность подозреваемого: ' . $Suspect->pasport,null, array('align' =>'both', 'spaceAfter' =>0));
            $section->addText('12. Иные данные о личности: '. $Suspect->other,null, array('align' =>'both', 'spaceAfter' =>0));
            $section->addTextBreak(1);



           ///$section->addText(Protocol::findOne($suspectes['protocol_id'])->suspect);
            //$section->addText($suspectes['value']);
           // $section->addText($indectment->);

           // $section->addText('Допрошенный в качестве '.$Suspect->roleInThis. $Suspect->suspect. ':');
            //$section->addText($Suspect->suspect);
            //$section->addText($Suspect->indications);
            //$section->addText($Suspect->roleInThis);
            //section->addText(' ');
        }

        // это потерпевшие и свидетели


        $section->addText('Доказательствами, подтверждающими обвинение являются: ',null, array('align' =>'center', 'spaceAfter' =>0));
        $section->addText('Вещественные доказательства: '.$indectment->eviden,null, array('align' =>'center', 'spaceAfter' =>0));


        $notSuspects = Protocol::find()->where(['!=', 'roleInThis', 'подозреваемый'])->andWhere(['deal_id' => $id])->all();
        foreach ($notSuspects as $notSuspect) {
            $section->addText('Показания '.$notSuspect->roleInThis. $notSuspect->suspect. ':'. $notSuspect->indications);
            //$section->addText($notSuspect->suspect);
            //$section->addText($notSuspect->indications);

            $section->addText(' ');
        }
        $suspects = (new Query())->select(['protocol_id', 'value'])->from('indictment_protocol')->where(['indictment_id' => $indectment->id])->all();

        foreach ($suspects as $suspect) {
            $section->addText(Protocol::findOne($suspect['protocol_id'])->suspect);
            $section->addText($suspect['value']);
            $section->addText(' ');
        }

        // это потерпевшие и свидетели
        $notSuspects = Protocol::find()->where(['!=', 'roleInThis', 'подозреваемый'])->andWhere(['deal_id' => $id])->all();

        foreach ($notSuspects as $notSuspect) {

            $section->addText($notSuspect->suspect);
            $section->addText($notSuspect->indications);
            $section->addText(' ');
        }

        $filename = \Yii::getAlias('@app/runtime/files/') . $id . '.docx';
        try {
            $w->save($filename, 'Word2007');
            return $filename;
        } catch (\Exception $e) {
            throw $e;
        }
    }

}