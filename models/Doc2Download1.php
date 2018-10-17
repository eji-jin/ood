<?php

namespace app\models;

use PhpOffice\PhpWord\PhpWord;

/**
 * Генерирует и возвращает документ
 *
 * Class Doc2Download
 * @package app\models
 */
class Doc2Download1
{
    /**
     * Извлекает значения из БД по id
     *
     * @param number $id индекс в БД
     * @return array
     */
    private function getValues($id)
    {
        return Document2::find()->where(['id' => $id])->asArray()->one();
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
        $section->addText('Обвинительный акт', null, 'topP');
        $section->addText('по обвинению ' . $values['suspect'] . 'в совершении преступления, предусмотренного ', null, 'topP');
        $section->addTextBreak(1);
        $section->addText('ОБВИНЯЕТСЯ:', null, 'topP');
        
        //Отступ
        $section->addTextBreak(1);
        
        $styleTable = array('borderSize' => 0, 'borderColor' => 'ffffff');
                
        //Текстовка
        
         $section->addText('1. Фамилия, Имя, Отчество: ' . $values['suspect']);   
         $section->addText('2. Дата рождения: ' . $values['birthdate']);    
         $section->addText('4. Место рождения: ' . $values['birthplace']);    
         $section->addText('3. Место жительсва и (или) регистрации: ' . $values['residence']);
         
         $section->addText('5. Гражданство: ' . $values['nat']);    
         $section->addText('6. Образование: ' . $values['educat']);    
         $section->addText('7. Семейное положение, состав семьи: ' . $values['famstat']);    
         $section->addText('8. Место работы: ' . $values['workplace']);    
         $section->addText('9. Отношение к воинской обязанности: ' . $values['duty']);    
         $section->addText('10. Наличие судимости: ' . $values['crime']);    
         $section->addText('11. Паспорт или иной документ удостоверяющий личность подозреваемого: ' . $values['pasport']);             
         

            
         
         
            $section->addText('');
            
            
        $filename = \Yii::getAlias('@app/runtime/files/') . md5($values['id']) . '.docx';
        try {
            $w->save($filename, 'Word2007');
            return $filename;
        } catch (\Exception $e) {
            \Yii::error($e->getMessage());
        }
    }

}