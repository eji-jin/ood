<?php

namespace app\models;

use PhpOffice\PhpWord\PhpWord;
use NCL\NCLNameCaseRu;

/**
 * Генерирует и возвращает документ
 *
 * Class Doc2Download
 * @package app\models
 */
class Protocol1Download
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
            'marginTop' => 1133.85);
        //Заголовок
        $section = $w->createSection($sectionStyle);
        
        
        
        $w->addParagraphStyle('topP', array(
        'align' => 'center',
            'spaceAfter' =>0,
        ));
        $section->addText('Справка', null, 'topP');
        //Отступ
        $section->addTextBreak(1);
        
        
         $section->addText('1. Срок дознания 10 суток. Уголовное дело возбуждено № ' . \app\models\Deal::findOne($values['deal_id'])['number'] . ' по признакам преступления, предусмотренного ' . $values['incriminate'], null, array('align' =>'both', 'spaceAfter' =>0));
         $section->addText('2. ' . $values['suspect'] . ' в соответствии со ст. 91 УПК РФ не задерживался', null, array('align' =>'both', 'spaceAfter' =>0));

        $case = new NCLNameCaseRu();
        $nameS = $case->q($values['suspect'], NCLNameCaseRu::$DATELN);

         $section->addText('3. Мера пресечения '. $nameS . ': ' . $values['mp'], null, array('align' =>'both', 'spaceAfter' =>0));
         $section->addText('4. Вещественные доказательства: ' . $values['evidence'], null, array('align' =>'both', 'spaceAfter' =>0));
         
         $section->addText('5. Гражданский иск по уголовному делу: ' . $values['claim'], null, array('align' =>'both', 'spaceAfter' =>0));
         $section->addText('6. Меры, принятые в обеспечение гражданского иска и возможной конфискации имущества: ' . $values['securofclaim'], null, array('align' =>'both', 'spaceAfter' =>0));
         $section->addText('7. Меры по обеспечению прав иждивенцев у потерпевшего и обвиняемого: ' . $values['guarantee'], null, array('align' =>'both', 'spaceAfter' =>0));
         $section->addText('8. Процессуальные издержки по уголовному делу: ' . $values['cost'], null, array('align' =>'both', 'spaceAfter' =>0));
         $section->addText('9. Обвиняемый: ' . $values['suspect'] . ', защитник' . $values['lawyer'] . ' ознакомились с материалами уголовного дела ' . $values['dateofreview'], null, array('align' =>'both', 'spaceAfter' =>0));
         $section->addText('10. Уголовное дело № ' . \app\models\Deal::findOne($values['deal_id'])['number'] . ' с обвинительным постановлением направлено в' . $values['sent'], null, array('align' =>'both', 'spaceAfter' =>0));
         $section->addTextBreak(2);
       
       
         $section->addText( \app\models\Deal::findOne($values['deal_id'])['position'] .' '. \app\models\Deal::findOne($values['deal_id'])['officer'], null, array('align' =>'both', 'spaceAfter' =>0));

        $styleTable = array('borderSize' => 0, 'borderColor' => 'ffffff');


        $case = new NCLNameCaseRu();
        $nameR = $case->q(\app\models\Deal::findOne($values['deal_id'])['name'], NCLNameCaseRu::$RODITLN);
        $cellColSpan1 = array('valign' => 'center');
        $cellColSpan2 = array('valign' => 'center');

        $w->addTableStyle('Colspan Rowspan', $styleTable);
        $table = $section->addTable('Colspan Rowspan');
        $table->addRow();
        $table->addCell(4677.16, $cellColSpan1) ->  addText(\app\models\Deal::findOne($values['deal_id'])['rank'], null, array('align' =>'left', 'spaceAfter' =>0));
        $table->addCell(4677.16, $cellColSpan2) ->  addText($nameR, null, array('align' =>'right', 'spaceAfter' =>0));
        $section->addTextBreak(1);

            
        $filename = \Yii::getAlias('@app/runtime/files/') . md5($values['id']) . '.docx';
        try {
            $w->save($filename, 'Word2007');
            return $filename;
        } catch (\Exception $e) {
            \Yii::error($e->getMessage());
        }
    }

}