<?php

namespace app\models;

use PhpOffice\PhpWord\PhpWord;

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
        $w->setDefaultFontSize('14');
        $sectionStyle = array(
            'marginLeft' => 1700.78, 
            'marginRight' => 850.39,
            'marginTop' => 1133.85);
        //Заголовок
        $section = $w->createSection($sectionStyle);
        
        
        
        $w->addParagraphStyle('topP', array(
        'align' => 'center',
        ));
        $section->addText('ПРОТОКОЛ', null, 'topP');
        $section->addText('допроса' . $values['roleInThis'], null, 'topP');
        
        //Отступ
        $section->addTextBreak(1);
        
        $styleTable = array('borderSize' => 0, 'borderColor' => 'ffffff');
        
        $cellColSpan1 = array('valign' => 'center');
        $cellColSpan2 = array('valign' => 'center');
        
        $w->addTableStyle('Colspan Rowspan', $styleTable);
        $table = $section->addTable('Colspan Rowspan');
        $table->addRow();
        $table->addCell(2267.71, $cellColSpan1) ->  addText($values['city'], null, array('align' =>'left'));
        $table->addCell(7086.61, $cellColSpan2) ->  addText($values['createdate'], null, array('align' =>'right'));    
                
                
        //Текстовка
        $section->addText($values['startTime']); 
        $section->addText($values['stopTime']); 
        
        $section->addText($values['position'] . $values['rank'] . ' ' . $values['name'] . ' в помещении ' . $values['room'] . ' в соответствии с частю второй ст. 46, ст. 180 и 190 УПК РФ допросил по уголовному делу №' . $values['deal_id'] . ' в качестве ' . $values['roleInThis'] );
        
         $section->addText('1. Фамилия, Имя, Отчество: ' . $values['suspect']);   
         $section->addText('2. Дата рождения: ' . $values['birthdate']);    
         $section->addText('3. Место жительсва и (или) регистрации: ' . $values['residence']);
         $section->addText('4. Место рождения: ' . $values['birthplace']);    
         
         $section->addText('5. Гражданство: ' . $values['nat']);    
         $section->addText('6. Образование: ' . $values['educat']);    
         $section->addText('7. Семейное положение, состав семьи: ' . $values['famstat']);    
         $section->addText('8. Место работы: ' . $values['workplace']);    
         $section->addText('9. Отношение к воинской обязанности: ' . $values['duty']);    
         $section->addText('10. Наличие судимости: ' . $values['crime']);    
         $section->addText('11. Паспорт или иной документ удостоверяющий личность подозреваемого: ' . $values['pasport']);             
         

         $section->addText('Перед началом  допроса  мне  разъяснены права,  предусмотренные частью четвертой ст. 46 УПК РФ: ');
         $section->addText('1) знать, в чем я подозреваюсь, и получить копию постановления о возбуждении против меня уголовного дела,  либо  копию  протокола задержания, либо  копию  постановления  о  применении  ко мне меры пресечения в виде заключения под стражу;');   
         $section->addText('2) давать  объяснения  и  показания  по  поводу  имеющегося  в отношении меня подозрения либо отказаться  от  дачи  объяснений  и показаний;');
        $section->addText('3) пользоваться помощью защитника с момента,  предусмотренного п. 2  и  3  части  третьей ст.  49 УПК РФ,  и иметь свидание с ним наедине и конфиденциально до моего первого допроса;');
        $section->addText('4) представлять доказательства;');
        $section->addText('5) заявлять ходатайства и отводы;');
        $section->addText('6) давать  показания  и  объяснения на родном языке или языке, которым я владею;');
        $section->addText('7) пользоваться помощью переводчика бесплатно;');
        $section->addText('8) знакомиться   с    протоколами    следственных    действий, произведенных с моим участием, и подавать на них замечания;');
        $section->addText('9) участвовать с  разрешения  следователя  или  дознавателя  в следственных действиях,   производимых   по   моему   ходатайству, ходатайству моего защитника либо законного представителя;');
        $section->addText('10) приносить жалобы на действия (бездействие) и решение суда, прокурора, следователя  и дознавателя;');
        $section->addText('11) защищаться  иными средствами и способами,  не запрещенными УПК РФ.');
        $section->addText('Так же я предупрежден о том, что при согласии давать показания данные показания могут быть использованы в качестве доказательств по уголовному делу, в том числе и при моем последующем отказе от этих показаний, за исключением случая предусмотренного п. 1 ст. ч. 2 ст. 75 УПК РФ;');
        
        //Написать условие появления полей:
        $section->addText($values['roleInThis'] . '                                                    __________________________');
        $section->addText('Мне разъяснено, что в соответствии со ст. 51 Конституции РФ я не обязан свидетельствовать против самого  себя,  своего  супруга (своей  супруги)  и  других  близких  родственников,  круг которых определен п. 4 ст. 5 УПК РФ.');
        $section->addText($values['roleInThis'] . '                                                    __________________________');
        $section->addText('Подозреваемому ' . $values['suspect'] . ' объявлено, что он подозревается:');
         
         
        $section->addText('По существу могу показать следующее:' . $values['indications']);
            
            
        $filename = \Yii::getAlias('@app/runtime/files/') . md5($values['id']) . '.docx';
        try {
            $w->save($filename, 'Word2007');
            return $filename;
        } catch (\Exception $e) {
            \Yii::error($e->getMessage());
        }
    }

}