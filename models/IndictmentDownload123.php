<?php

namespace app\models;

use phpDocumentor\Reflection\Types\ContextFactory;use PhpOffice\PhpWord\PhpWord;
use NCL\NCLNameCaseRu;

/**
 * Генерирует и возвращает документ
 *
 * Class IndictmentDownload
 * @package app\models
 */
class IndictmentDownload
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
        //Блок "УТВЕРЖДАЮ"
        $section = $w->createSection($sectionStyle);
        ob_start();
        echo "УТВЕРЖДАЮ\n";
        echo $values['title'];
        echo $values['prosecutor'];
        echo "_________________________\n";
        echo "\"_____\" ______________ 2018г.";
        $content1=ob_get_clean();
        ob_start();
        echo "УТВЕРЖДАЮ\n";
        echo $values['chiefposition'];
        echo $values['chiefrank'];
        echo $values['chiefname'];
        echo "_________________________\n";
        echo "\"_____\" ______________ 2018г.";
        $content2=ob_get_clean();
         $styleTable = array('borderSize' => 0, 'borderColor' => 'ffffff');
        $cellColSpan1 = array('valign' => 'center');
        $cellColSpan2 = array('valign' => 'center');
        $w->addTableStyle('Colspan Rowspan', $styleTable);
        $table = $section->addTable('Colspan Rowspan');
        $table->addRow();
        $table->addCell(4600.16, $cellColSpan1) ->  addText("", null, array('align' =>'left', 'spaceAfter' =>0));
        $table->addCell(4600.16, $cellColSpan2) ->  addText($content1, null, array('align' =>'center', 'spaceAfter' =>0));
        $table->addRow();
        $table->addCell(4600.16, $cellColSpan1) ->  addText("", null, array('align' =>'left', 'spaceAfter' =>0));
        $table->addCell(4600.16, $cellColSpan2) ->  addText($content2, null, array('align' =>'center', 'spaceAfter' =>0));
        //Отступ
        
        $section->addTextBreak(1);
        //Текстовка
         $section->addText('ОБВИНИТЕЛЬНЫЙ АКТ',null, array('align' =>'center', 'spaceAfter' =>0));
          $section->addText('ПО УГОЛОВНОМУ ДЕЛУ '.\app\models\Deal::findOne($values['deal_id'])['number'],null, array('align' =>'both', 'spaceAfter' =>0));
         $section->addText('по обвинению'.''.' в совершении преступления предусмотренного '.\app\models\Protocol::findOne($values['deal_id'])['incriminate'],null, array('align' =>'both', 'spaceAfter' =>0));



         //Блок данных о подозреваемом
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
        $section->addTextBreak(1);


        //Блок доказательства
        $section->addText('Доказательствами, подтверждающими обвинение являются:',null, array('align' =>'center', 'spaceAfter' =>0));
        //Вставить доказательства
        $section->addText($values['eviden'],null, array('align' =>'both', 'spaceAfter' =>0));
        //вещественное доказательство добавить везде $evidence
        $section->addText($values['$evidence'],null, array('align' =>'both', 'spaceAfter' =>0));
        //показания потерпевшего

        //показания свидетеля

        //показания подозреваемого



        $section->addText('Обстоятельства, смягчающие и отягчающие наказание:',null, array('align' =>'center', 'spaceAfter' =>0));
       // 'excircum' => 'Смягчающие обстоятельства',
         //   'aggcircum' => 'Отягчающие обстоятельства',

        $section->addText('Обвинительный акт составлен :',null, array('align' =>'center', 'spaceAfter' =>0));




        $w->addTableStyle('Colspan Rowspan', $styleTable);
        $table = $section->addTable('Colspan Rowspan');
        $table->addRow();
        $table->addCell(4677.16, $cellColSpan1) ->  addText('Подозреваемый', null, array('align' =>'left', 'spaceAfter' =>100));
        $table->addCell(4677.16, $cellColSpan2) ->  addText($values['suspect'], null, array('align' =>'right', 'spaceAfter' =>100));
        $table->addRow();
        $table->addCell(4677.16, $cellColSpan1) ->  addText('Защитник', null, array('align' =>'left', 'spaceAfter' =>100));
        $table->addCell(4677.16, $cellColSpan2) ->  addText($values['otherPerson'], null, array('align' =>'right', 'spaceAfter' =>100));
        $table->addRow();
        $table->addCell(4677.16, $cellColSpan1) ->  addText('Протокол прочитан', null, array('align' =>'left', 'spaceAfter' =>100));
        $table->addCell(4677.16, $cellColSpan2) ->  addText('', null, array('align' =>'right', 'spaceAfter' =>100));
        $table->addRow();
        $table->addCell(4677.16, $cellColSpan1) ->  addText('Замечания к протоколу', null, array('align' =>'left', 'spaceAfter' =>100));
        $table->addCell(4677.16, $cellColSpan2) ->  addText('', null, array('align' =>'right', 'spaceAfter' =>100));
        $table->addRow();
        $table->addCell(4677.16, $cellColSpan1) ->  addText('Подозреваемый', null, array('align' =>'left', 'spaceAfter' =>100));
        $table->addCell(4677.16, $cellColSpan2) ->  addText($values['suspect'], null, array('align' =>'right', 'spaceAfter' =>100));
        $table->addRow();
        $table->addCell(4677.16, $cellColSpan1) ->  addText('Защитник', null, array('align' =>'left', 'spaceAfter' =>100));
        $table->addCell(4677.16, $cellColSpan2) ->  addText($values['otherPerson'], null, array('align' =>'right', 'spaceAfter' =>100));
        $table->addRow();
        $table->addCell(4677.16, $cellColSpan1) ->  addText(\app\models\Deal::findOne($values['deal_id'])['position'], null, array('align' =>'left', 'spaceAfter' =>100));
        $table->addCell(4677.16, $cellColSpan2) ->  addText(\app\models\Deal::findOne($values['deal_id'])['name'], null, array('align' =>'right', 'spaceAfter' =>100));



                $filename = $values['createdate'].$values['suspect'] . '.docx';
        try {
            $w->save($filename, 'Word2007');
            return $filename;
        } catch (\Exception $e) {
            \Yii::error($e->getMessage());
        }
    }

}