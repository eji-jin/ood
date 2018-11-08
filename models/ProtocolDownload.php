<?php

namespace app\models;

use phpDocumentor\Reflection\Types\ContextFactory;
use PhpOffice\PhpWord\PhpWord;
use NCL\NCLNameCaseRu;

/**
 * Генерирует и возвращает документ
 *
 * Class Doc2Download
 * @package app\models
 */
class ProtocolDownload
{
    /**
     * Извлекает значения из БД по id
     *
     * @param number $id индекс в БД
     * @return array
     */
    private function getValues($id)
    {
        return Protocol::find()->where(['id' => $id])->asArray()->one();
    }

    /**
     * Возвращает готовый документ для скачивания
     * @param number $id индекс в БД
     * @return \yii\console\Response|\yii\web\Response
     */
    public function getDocument($id)
    {
        $filepath = $this->generateDocument($this->getValues($id));
        return \Yii::$app->response->sendFile($filepath);
    }

    /**
     * Генерирует документ используя функции PhpWord
     *
     * @param array $values массив значений из БД
     * @see https://phpword.readthedocs.io/en/latest/general.html
     * @return string Абсолютный путь к файлу (включая имя)
     */
    private function generateDocument($values)
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
        
        
        
        $w->addParagraphStyle('topP', array(
        'align' => 'center',
        'spaceAfter' =>0,
        ));
        $section->addText('ПРОТОКОЛ', array('bold'=>true), 'topP');
        $case = new NCLNameCaseRu();
        $array = $case->q($values['roleInThis'], NCLNameCaseRu::$RODITLN);
        $section->addText('допроса ' . $array, array('bold'=>true), 'topP');

        //Отступ

        
        $styleTable = array('borderSize' => 0, 'borderColor' => 'ffffff');
        
        $cellColSpan1 = array('valign' => 'center');
        $cellColSpan2 = array('valign' => 'center');
        
        $w->addTableStyle('Colspan Rowspan', $styleTable);
        $table = $section->addTable('Colspan Rowspan');
        $table->addRow();
        $table->addCell(2267.71, $cellColSpan1) ->  addText($values['city'], null, array('align' =>'left', 'spaceAfter' =>0));
        $table->addCell(7086.61, $cellColSpan2) ->  addText($values['createdate'], null, array('align' =>'right', 'spaceAfter' =>0));
        $section->addTextBreak(1, null, array('align' =>'both', 'spaceAfter' =>0, 'hanging'=>-1));
        //Текстовка
        $section->addText('Допрос начат в: '.$values['timeStart'],null, array('align' =>'both', 'spaceAfter' =>0));
        $section->addText('Допрос окончен в: '.$values['timeStop'],null, array('align' =>'both', 'spaceAfter' =>0));

        $section->addText(\app\models\Deal::findOne($values['deal_id'])['position'].' '. \app\models\Deal::findOne($values['deal_id'])['officer'] .' '. \app\models\Deal::findOne($values['deal_id'])['rank']. ' ' . \app\models\Deal::findOne($values['deal_id'])['name'] . ', в помещении ' . $values['room'] . ' в соответствии с частю второй ст. 46, ст. 180 и 190 УПК РФ допросил по уголовному делу №' . \app\models\Deal::findOne($values['deal_id'])['number'] . ' в качестве ' . $array . ':',null, array('align' =>'both', 'spaceAfter' =>0, 'hanging'=>-1));
        
         $section->addText('1. Фамилия, Имя, Отчество: ' . $values['suspect'],null, array('align' =>'both', 'spaceAfter' =>0));
         $section->addText('2. Дата рождения: ' . $values['birthdate'],null, array('align' =>'both', 'spaceAfter' =>0));
         $section->addText('3. Место жительсва и (или) регистрации: ' . $values['residence'],null, array('align' =>'both', 'spaceAfter' =>0));
         $section->addText('4. Место рождения: ' . $values['birthplace'],null, array('align' =>'both', 'spaceAfter' =>0));
         
         $section->addText('5. Гражданство: ' . $values['nat'],null, array('align' =>'both', 'spaceAfter' =>0));
         $section->addText('6. Образование: ' . $values['educat'],null, array('align' =>'both', 'spaceAfter' =>0));
         $section->addText('7. Семейное положение, состав семьи: ' . $values['famstat'],null, array('align' =>'both', 'spaceAfter' =>0));
         $section->addText('8. Место работы: ' . $values['workplace'],null, array('align' =>'both', 'spaceAfter' =>0));
         $section->addText('9. Отношение к воинской обязанности: ' . $values['duty'],null, array('align' =>'both', 'spaceAfter' =>0));
         $section->addText('10. Наличие судимости: ' . $values['crime'],null, array('align' =>'both', 'spaceAfter' =>0));
         $section->addText('11. Паспорт или иной документ удостоверяющий личность подозреваемого: ' . $values['pasport'],null, array('align' =>'both', 'spaceAfter' =>0));
        $section->addText('12. Иные данные о личности ' . $array . ': '. $values['other'],null, array('align' =>'both', 'spaceAfter' =>0));
        $section->addTextBreak(1, null, array('align' =>'both', 'spaceAfter' =>0, 'hanging'=>-1));

        $w->addTableStyle('Colspan Rowspan', $styleTable);
        $table = $section->addTable('Colspan Rowspan');
        $table->addRow();
        $table->addCell(2267.71, $cellColSpan1) ->  addText($values['roleInThis'], null, array('align' =>'left', 'spaceAfter' =>0));
        $table->addCell(7086.61, $cellColSpan2) ->  addText('________________', null, array('align' =>'right', 'spaceAfter' =>0));

         $section->addText('Иные участвующие: ' . $values['otherPerson'],null, array('align' =>'both', 'spaceAfter' =>0));
        $section->addTextBreak(1, null, array('align' =>'both', 'spaceAfter' =>0, 'hanging'=>-1));

        $hardwareO = $case->q(\app\models\Deal::findOne($values['deal_id'])['position'].' '.\app\models\Deal::findOne($values['deal_id'])['name'], NCLNameCaseRu::$TVORITELN);
        $section->addText('Участвующим лицам объявлено о применении технических средств: ' . $values['hardware']. ' '.$hardwareO,null, array('align' =>'both', 'spaceAfter' =>0, 'hanging'=>-1));

         $section->addText('Перед началом  допроса  мне  разъяснены права,  предусмотренные частью четвертой ст. 46 УПК РФ: ',null, array('align' =>'both', 'spaceAfter' =>0, 'hanging'=>-1));
         $section->addText('1) знать, в чем я подозреваюсь, и получить копию постановления о возбуждении против меня уголовного дела,  либо  копию  протокола задержания, либо  копию  постановления  о  применении  ко мне меры пресечения в виде заключения под стражу;',null, array('align' =>'both', 'spaceAfter' =>0, 'hanging'=>-1));
         $section->addText('2) давать  объяснения  и  показания  по  поводу  имеющегося  в отношении меня подозрения либо отказаться  от  дачи  объяснений  и показаний;',null, array('align' =>'both', 'spaceAfter' =>0, 'hanging'=>-1));
        $section->addText('3) пользоваться помощью защитника с момента,  предусмотренного п. 2  и  3  части  третьей ст.  49 УПК РФ,  и иметь свидание с ним наедине и конфиденциально до моего первого допроса;',null, array('align' =>'both', 'spaceAfter' =>0, 'hanging'=>-1));
        $section->addText('4) представлять доказательства;',null, array('align' =>'both', 'spaceAfter' =>0, 'hanging'=>-1));
        $section->addText('5) заявлять ходатайства и отводы;',null, array('align' =>'both', 'spaceAfter' =>0, 'hanging'=>-1));
        $section->addText('6) давать  показания  и  объяснения на родном языке или языке, которым я владею;',null, array('align' =>'both', 'spaceAfter' =>0, 'hanging'=>-1));
        $section->addText('7) пользоваться помощью переводчика бесплатно;',null, array('align' =>'both', 'spaceAfter' =>0, 'hanging'=>-1));
        $section->addText('8) знакомиться   с    протоколами    следственных    действий, произведенных с моим участием, и подавать на них замечания;',null, array('align' =>'both', 'spaceAfter' =>0, 'hanging'=>-1));
        $section->addText('9) участвовать с  разрешения  следователя  или  дознавателя  в следственных действиях,   производимых   по   моему   ходатайству, ходатайству моего защитника либо законного представителя;',null, array('align' =>'both', 'spaceAfter' =>0, 'hanging'=>-1));
        $section->addText('10) приносить жалобы на действия (бездействие) и решение суда, прокурора, следователя  и дознавателя;',null, array('align' =>'both', 'spaceAfter' =>0));
        $section->addText('11) защищаться  иными средствами и способами,  не запрещенными УПК РФ.',null, array('align' =>'both', 'hanging'=>-1));
        $section->addTextBreak(1, null, array('align' =>'both', 'spaceAfter' =>0, 'hanging'=>-1));

        $section->addText('Так же я предупрежден о том, что при согласии давать показания данные показания могут быть использованы в качестве доказательств по уголовному делу, в том числе и при моем последующем отказе от этих показаний, за исключением случая предусмотренного п. 1 ст. ч. 2 ст. 75 УПК РФ;',null, array('align' =>'both', 'spaceAfter' =>0, 'hanging'=>-1));
        $section->addTextBreak(1, null, array('align' =>'both', 'spaceAfter' =>0, 'hanging'=>-1));

        //Написать условие появления полей:
        $w->addTableStyle('Colspan Rowspan', $styleTable);
        $table = $section->addTable('Colspan Rowspan');
        $table->addRow();
        $table->addCell(2267.71, $cellColSpan1) ->  addText($values['roleInThis'], null, array('align' =>'left', 'spaceAfter' =>0));
        $table->addCell(7086.61, $cellColSpan2) ->  addText('________________', null, array('align' =>'right', 'spaceAfter' =>0));
        $section->addTextBreak(1, null, array('align' =>'both', 'spaceAfter' =>0, 'hanging'=>-1));

        $section->addText('Мне разъяснено, что в соответствии со ст. 51 Конституции РФ я не обязан свидетельствовать против самого  себя,  своего  супруга (своей  супруги)  и  других  близких  родственников,  круг которых определен п. 4 ст. 5 УПК РФ.',null, array('align' =>'both', 'spaceAfter' =>0, 'hanging'=>-1));
        if ($values['roleInThis'] == 'подозреваемый'){
            $w->addTableStyle('Colspan Rowspan', $styleTable);
            $table = $section->addTable('Colspan Rowspan');
            $table->addRow();
            $table->addCell(2267.71, $cellColSpan1) ->  addText($values['roleInThis'], null, array('align' =>'left', 'spaceAfter' =>0));
            $table->addCell(7086.61, $cellColSpan2) ->  addText('________________', null, array('align' =>'right', 'spaceAfter' =>0));
            $section->addTextBreak(1);
            $case = new NCLNameCaseRu();
            $sus = $case->q($values['suspect'], NCLNameCaseRu::$RODITLN);
            $section->addText('Подозреваемому ' . $sus . ' объявлено, что он подозревается: '. $values['incriminate'],null, array('align' =>'both', 'spaceAfter' =>0));
        }


        $section->addTextBreak(1, null, array('align' =>'both', 'spaceAfter' =>0, 'hanging'=>-1));
        $section->addText('По существу могу показать следующее:',null, array('align' =>'both', 'spaceAfter' =>0, 'hanging'=>-1));
        $textArray1 = explode("\n", $values['indications']); foreach( $textArray1 as $text) { $section->addText($text,null, array('align' =>'both', 'spaceAfter' =>0, 'hanging'=>-1)); }





        $bodyguard = $case->q($values['otherPerson'], NCLNameCaseRu::$RODITLN);
        $suspectRoditln = $case->q(' '.$values['suspect'], NCLNameCaseRu::$RODITLN);
        $section->addTextBreak(1,null, array('align' =>'both', 'spaceAfter' =>0));
        $section->addText('Перед началом,  в ходе либо по окончании допроса подозреваемого от участвующих лиц ' . $array .', '.$bodyguard.' заявления '. $values['dopstat'],null, array('align' =>'both', 'spaceAfter' =>0));
        $section->addText('Содержание заявлений: ' . $values['dopstattext'],null, array('align' =>'both', 'spaceAfter' =>0));
        $section->addTextBreak(1,null, array('align' =>'both', 'spaceAfter' =>0));
        $w->addTableStyle('Colspan Rowspan', $styleTable);
        $table = $section->addTable('Colspan Rowspan');
        $table->addRow();
        $table->addCell(3000, $cellColSpan1) ->  addText('Подозреваемый', null, array('align' =>'left', 'spaceAfter' =>100));
        $table->addCell(6354.32, $cellColSpan2) ->  addText($values['suspect'], null, array('align' =>'right', 'spaceAfter' =>100));
        $table->addRow();
        $table->addCell(3000, $cellColSpan1) ->  addText('Защитник', null, array('align' =>'left', 'spaceAfter' =>100));
        $table->addCell(6354.32, $cellColSpan2) ->  addText($values['otherPerson'], null, array('align' =>'right', 'spaceAfter' =>100));
        $table->addRow();
        $table->addCell(3000, $cellColSpan1) ->  addText('Протокол прочитан', null, array('align' =>'left', 'spaceAfter' =>100));
        $table->addCell(6354.32, $cellColSpan2) ->  addText('', null, array('align' =>'right', 'spaceAfter' =>100));
        $table->addRow();
        $table->addCell(3000, $cellColSpan1) ->  addText('Замечания к протоколу', null, array('align' =>'left', 'spaceAfter' =>100));
        $table->addCell(6354.32, $cellColSpan2) ->  addText('', null, array('align' =>'right', 'spaceAfter' =>100));
        $table->addRow();
        $table->addCell(3000, $cellColSpan1) ->  addText('Подозреваемый', null, array('align' =>'left', 'spaceAfter' =>100));
        $table->addCell(6354.32, $cellColSpan2) ->  addText($values['suspect'], null, array('align' =>'right', 'spaceAfter' =>100));
        $table->addRow();
        $table->addCell(3000, $cellColSpan1) ->  addText('Защитник', null, array('align' =>'left', 'spaceAfter' =>100));
        $table->addCell(6354.32, $cellColSpan2) ->  addText($values['otherPerson'], null, array('align' =>'right', 'spaceAfter' =>100));
        $table->addRow();
        $table->addCell(3000, $cellColSpan1) ->  addText(\app\models\Deal::findOne($values['deal_id'])['position'], null, array('align' =>'left', 'spaceAfter' =>100));
        $table->addCell(6354.32, $cellColSpan2) ->  addText(\app\models\Deal::findOne($values['deal_id'])['name'], null, array('align' =>'right', 'spaceAfter' =>100));



                $filename = $values['createdate'].$values['suspect'] . '.docx';
        try {
            $w->save($filename, 'Word2007');
            return $filename;
        } catch (\Exception $e) {
            \Yii::error($e->getMessage());
        }
    }

}