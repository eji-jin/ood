<?php
namespace app\models;
use PhpOffice\PhpWord\PhpWord;
use yii\db\Query;
use NCL\NCLNameCaseRu;


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
        $w->setDefaultFontName('Times New Roman');
        $w->setDefaultFontSize('12');
        $sectionStyle = array(
            'marginLeft' => 1700.78,
            'marginRight' => 850.39,
            'marginTop' => 1133.85,
            'align' => 'right');
        //Заголовок
        $section = $w->createSection($sectionStyle);
        $deals = Deal::findOne($id);
       // $section->addText($deals['number']);
        $prot = Protocol::findOne(['deal_id' => $id]);
        $Suspects = Protocol::find()->where(['=', 'roleInThis', 'подозреваемый'])->andWhere(['deal_id' => $id])->all();
        $indectment = Indictment::findOne(['deal_id' => $id]);

        $names = "";
        foreach ($Suspects as $Suspect) {
            $names .= " ";
            $names .= $Suspect->suspect;
        }

        $styleTable = array('borderSize' => 0, 'borderColor' => 'ffffff');

        $cellColSpan1 = array('valign' => 'center');
        $cellColSpan2 = array('valign' => 'center');

        $w->addTableStyle('Colspan Rowspan', $styleTable);
        $table = $section->addTable('Colspan Rowspan');
        $table->addRow();
        $table->addCell(4677.16, $cellColSpan1) ->  addText('', null, array('align' =>'left', 'spaceAfter' =>0));
        $table->addCell(4677.16, $cellColSpan2) ->  addText('УТВЕРЖДАЮ', null, array('align' =>'center', 'spaceAfter' =>0));
        $table->addRow();
        $table->addCell(4677.16, $cellColSpan1) ->  addText('', null, array('align' =>'left', 'spaceAfter' =>0));
        $table->addCell(4677.16, $cellColSpan2) ->  addText($indectment->area, null, array('align' =>'center', 'spaceAfter' =>0));
        $table->addRow();
        $table->addCell(4677.16, $cellColSpan1) ->  addText('', null, array('align' =>'left', 'spaceAfter' =>0));
        $table->addCell(4677.16, $cellColSpan2) ->  addText($indectment->title, null, array('align' =>'center', 'spaceAfter' =>0));
        $table->addRow();
        $table->addCell(4677.16, $cellColSpan1) ->  addText('', null, array('align' =>'left', 'spaceAfter' =>0));
        $table->addCell(4677.16, $cellColSpan2) ->  addText($indectment->prosecutor, null, array('align' =>'center', 'spaceAfter' =>80));
        $table->addRow();
        $table->addCell(4677.16, $cellColSpan1) ->  addText('', null, array('align' =>'left', 'spaceAfter' =>0));
        $table->addCell(4677.16, $cellColSpan2) ->  addText('__________________________', null, array('align' =>'center', 'spaceAfter' =>80));
        $table->addRow();
        $table->addCell(4677.16, $cellColSpan1) ->  addText('', null, array('align' =>'left', 'spaceAfter' =>0));
        $table->addCell(4677.16, $cellColSpan2) ->  addText('«_____»_______________2018г.', null, array('align' =>'center', 'spaceAfter' =>0));


        $table->addRow();
        $table->addCell(4677.16, $cellColSpan1) ->  addText('', null, array('align' =>'left', 'spaceAfter' =>0));
        $table->addCell(4677.16, $cellColSpan2) ->  addText('', null, array('align' =>'center', 'spaceAfter' =>0));
        $table->addRow();
        $table->addCell(4677.16, $cellColSpan1) ->  addText('', null, array('align' =>'left', 'spaceAfter' =>0));
        $table->addCell(4677.16, $cellColSpan2) ->  addText($indectment->chiefposition, null, array('align' =>'center', 'spaceAfter' =>0));
        $table->addRow();
        $table->addCell(4677.16, $cellColSpan1) ->  addText('', null, array('align' =>'left', 'spaceAfter' =>0));
        $table->addCell(4677.16, $cellColSpan2) ->  addText($indectment->chiefrank, null, array('align' =>'center', 'spaceAfter' =>0));
        $table->addRow();
        $table->addCell(4677.16, $cellColSpan1) ->  addText('', null, array('align' =>'left', 'spaceAfter' =>0));
        $table->addCell(4677.16, $cellColSpan2) ->  addText($indectment->chiefname, null, array('align' =>'center', 'spaceAfter' =>80));
        $table->addRow();
        $table->addCell(4677.16, $cellColSpan1) ->  addText('', null, array('align' =>'left', 'spaceAfter' =>0));
        $table->addCell(4677.16, $cellColSpan2) ->  addText('__________________________', null, array('align' =>'center', 'spaceAfter' =>80));
        $table->addRow();
        $table->addCell(4677.16, $cellColSpan1) ->  addText('', null, array('align' =>'left', 'spaceAfter' =>0));
        $table->addCell(4677.16, $cellColSpan2) ->  addText('«_____»_______________2018г.', null, array('align' =>'center', 'spaceAfter' =>0));
        $section->addTextBreak(1);


        $section->addText('ОБВИНИТЕЛЬНЫЙ АКТ',null, array('align' =>'center', 'spaceAfter' =>0));
        $section->addText('ПО УГОЛОВНОМУ ДЕЛУ № '.$deals['number'],null, array('align' =>'center', 'spaceAfter' =>0));
        $section->addText('по обвинению'. $names .' в совершении преступления предусмотренного '. $prot['incriminate'],null, array('align' =>'both', 'spaceAfter' =>0, 'hanging'=>-1));

        $suspects = (new Query())->select(['protocol_id', 'value', 'otyagch', 'smyagch', 'costs', 'mera_prin'])->from('indictment_protocol')->where(['indictment_id' => $indectment->id])->all();
/*
        foreach ($Suspects as $Suspect) {
            \Yii::warning(print_r($indectment, true));
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
        }
        */

        foreach ($suspects as $suspect) {
            $section->addText('1. Фамилия, Имя, Отчество: ' . Protocol::findOne($suspect['protocol_id'])->suspect,null, array('align' =>'both', 'spaceAfter' =>0));
            $section->addText('2. Дата рождения: ' . Protocol::findOne($suspect['protocol_id'])->birthdate,null, array('align' =>'both', 'spaceAfter' =>0));
            $section->addText('3. Место жительсва и (или) регистрации: ' . Protocol::findOne($suspect['protocol_id'])->residence,null, array('align' =>'both', 'spaceAfter' =>0));
            $section->addText('4. Место рождения: ' . Protocol::findOne($suspect['protocol_id'])->birthplace,null, array('align' =>'both', 'spaceAfter' =>0));
            $section->addText('5. Гражданство: ' . Protocol::findOne($suspect['protocol_id'])->nat,null, array('align' =>'both', 'spaceAfter' =>0));
            $section->addText('6. Образование: ' . Protocol::findOne($suspect['protocol_id'])->educat,null, array('align' =>'both', 'spaceAfter' =>0));
            $section->addText('7. Семейное положение, состав семьи: ' . Protocol::findOne($suspect['protocol_id'])->famstat,null, array('align' =>'both', 'spaceAfter' =>0));
            $section->addText('8. Место работы: ' . Protocol::findOne($suspect['protocol_id'])->workplace,null, array('align' =>'both', 'spaceAfter' =>0));
            $section->addText('9. Отношение к воинской обязанности: ' . Protocol::findOne($suspect['protocol_id'])->duty,null, array('align' =>'both', 'spaceAfter' =>0));
            $section->addText('10. Наличие судимости: ' . Protocol::findOne($suspect['protocol_id'])->crime,null, array('align' =>'both', 'spaceAfter' =>0));
            $section->addText('11. Паспорт или иной документ удостоверяющий личность подозреваемого: ' . Protocol::findOne($suspect['protocol_id'])->pasport,null, array('align' =>'both', 'spaceAfter' =>0));
            $section->addText('12. Иные данные о личности: '. Protocol::findOne($suspect['protocol_id'])->other,null, array('align' =>'both', 'spaceAfter' =>0));
            $section->addTextBreak(1);

            $section->addText($suspect['value']);
        }


        $section->addText('Доказательствами, подтверждающими обвинение являются: ',null, array('align' =>'both', 'spaceAfter' =>0));
        $textArray1 = explode("\n", $indectment->evidences); foreach( $textArray1 as $text) { $section->addText($text,null, array('align' =>'both', 'spaceAfter' =>0, 'hanging'=>-1)); }

        $section->addText('Вещественные доказательства: '.$indectment->eviden,null, array('align' =>'both', 'spaceAfter' =>0));

        $case = new NCLNameCaseRu();
        $notSuspects = Protocol::find()->where(['!=', 'roleInThis', 'подозреваемый'])->andWhere(['deal_id' => $id])->all();
        foreach ($notSuspects as $notSuspect) {
            $array11 = $case->q($notSuspect->roleInThis, NCLNameCaseRu::$RODITLN);
            $array12 = $case->q($notSuspect->suspect, NCLNameCaseRu::$RODITLN);
            $section->addText('Показания допрошенного в качестве '.$array11.' от '.$notSuspect->createdate. ' ' .$array12. ': '. $notSuspect->indications,null, array('align' =>'both', 'spaceAfter' =>0));
        }
        $iSuspects = Protocol::find()->where(['=','roleInThis', 'подозреваемый'])->andWhere(['deal_id' => $id])->all();
        foreach ($iSuspects as $iSuspect) {
            $array21 = $case->q($iSuspect->roleInThis, NCLNameCaseRu::$RODITLN);
            $array22 = $case->q($iSuspect->suspect, NCLNameCaseRu::$RODITLN);
            $section->addText('Показания допрошенного в качестве '.$array21.' от '.$iSuspect->createdate. ' ' .$array22. ': '. $iSuspect->indications,null, array('align' =>'both', 'spaceAfter' =>0));
        }


        $section->addText('Доказательства, на которые ссылаются обвиняемые, защитник: ',null, array('align' =>'both', 'spaceAfter' =>0));
        foreach ($iSuspects as $iSuspect) {
            $array21 = $case->q($iSuspect->roleInThis, NCLNameCaseRu::$RODITLN);
            $array22 = $case->q($iSuspect->suspect, NCLNameCaseRu::$RODITLN);
            $section->addText('Показания допрошенного в качестве '.$array21.' от '.$iSuspect->createdate. ' ' .$array22. ': '. $iSuspect->indications,null, array('align' =>'both', 'spaceAfter' =>0));
        }


        $section->addText('Обстоятельства, смягчающие и отягчающие наказание: '.$indectment->eviden,null, array('align' =>'both', 'spaceAfter' =>0));
        foreach ($suspects as $suspect) {
            $arrayso = $case->q(Protocol::findOne($suspect['protocol_id'])->suspect, NCLNameCaseRu::$RODITLN);
            $section->addText('Обстоятельства, отягчающие наказание обвиняемого: '.$arrayso.' '. $suspect['otyagch']);
            $section->addText('Обстоятельства, смягчающие наказание обвиняемого: '.$arrayso.' '. $suspect['smyagch']);
        }
            $array_area = $case->q($indectment->area, NCLNameCaseRu::$RODITLN);
        $section->addText('Обвинительный акт составлен в '.$deals->officer.' '.$indectment->date_indict. ' и вместе с уголовным делом №'. $deals['number'].' направляется прокурору '.$array_area,null, array('align' =>'both', 'spaceAfter' =>0));
        $section->addTextBreak(1);

        $section->addText($deals->position. $deals->officer,null, array('align' =>'both', 'spaceAfter' =>0));
        $section->addText($deals->rank.'_________________________'. $deals->name,null, array('align' =>'both', 'spaceAfter' =>0));
        $section = $w->createSection($sectionStyle);


        $section->addText('Список лиц, подлежащих вызову в суд ',null, array('align' =>'center', 'spaceAfter' =>0));
        foreach ($iSuspects as $iSuspect) {
            $section->addText($iSuspect->roleInThis.': '.$iSuspect->suspect. ', зарегистрирован и проживает по адресу: '. $iSuspect->residence,null, array('align' =>'both', 'spaceAfter' =>0));
        }
        foreach ($notSuspects as $notSuspect) {
            $section->addText($notSuspect->roleInThis.': '.$notSuspect->suspect. ', зарегистрирован и проживает по адресу: '. $notSuspect->residence,null, array('align' =>'both', 'spaceAfter' =>0));

        }
        foreach ($iSuspects as $iSuspect) {
            $section->addText($iSuspect->otherPerson,null, array('align' =>'both', 'spaceAfter' =>0));
        }

//СПРАВКА
        $section = $w->createSection($sectionStyle);
        $section->addText('Справка ',null, array('align' =>'center', 'spaceAfter' =>0));
        $section->addTextBreak(1);
        foreach ($Suspects as $Suspect) {
            \Yii::warning(print_r($indectment, true));
            $section->addText($Suspect->suspect. ' допрошен в качестве подозреваемого '.$Suspect->createdate,null, array('align' =>'both', 'spaceAfter' =>0));
        }
         $case = new NCLNameCaseRu();
        foreach ($suspects as $suspect) {
            $array = $case->q(Protocol::findOne($suspect['protocol_id'])->suspect, NCLNameCaseRu::$RODITLN);
            $section->addText('Мера процессуального принуждения в отношении '.$array.' - '. $suspect['mera_prin']);
        }
        $section->addText('Вещественные доказательства по уголовному делу: '.$indectment->eviden,null, array('align' =>'both', 'spaceAfter' =>0));
        foreach ($suspects as $suspect) {
            $section->addText('Процессуальные издержки '.' - '. $suspect['costs']);
        }
        $section->addText('Гражданский иск: '.$indectment->g_isk,null, array('align' =>'both', 'spaceAfter' =>0));
        $section->addText('Обвинительный акт составлен '.$indectment->date_indict,null, array('align' =>'both', 'spaceAfter' =>0));
        $section->addTextBreak(1);

        $section->addText($deals->position. $deals->officer,null, array('align' =>'both', 'spaceAfter' =>0));
        $section->addText($deals->rank.'_________________________'. $deals->name,null, array('align' =>'both', 'spaceAfter' =>0));


        $filename = \Yii::getAlias('@app/runtime/files/') . $id . '.docx';
        try {
            $w->save($filename, 'Word2007');
            return $filename;
        } catch (\Exception $e) {
            throw $e;
        }
    }

}