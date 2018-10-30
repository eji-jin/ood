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
        $section->addText('СПРАВКА', null, 'topP');
        //Отступ
        $section->addTextBreak(1);
        
         $section->addText('1. Срок дознания 10 суток. Уголовное дело возбуждено  ' . $values['dealdate'] . 'по признакам преступления, предусмотренного ' . \app\models\Protocol::findOne($values['deal_id'])['incriminate']);   
         $section->addText(\app\models\Protocol::findOne($values['deal_id'])['suspect'] . 'в соответствии со ст. 91 УПК РФ не задерживался');    
         $section->addText('3. Мера пресечения' . $values['']);
         $section->addText('4. Вещественные доказательства: ' . $values['evidence']);    
         
         $section->addText('5. Гражданский иск по уголовному делу: ' . $values['claim']);    
         $section->addText('6. Меры, принятые в обеспечение гражданского иска и возможной конфискации имущества: ' . $values['securofclaim']);    
         $section->addText('7. Меры по обеспечению прав иждивенцев у потерпевшего и обвиняемого: ' . $values['guarantee']);    
         $section->addText('8. Процессуальные издержки по уголовному делу: ' . $values['cost']);    
         $section->addText('9. Обвиняемый: ' . \app\models\Protocol::findOne($values['deal_id'])['suspect'] . ', защитник' . $values['lawyer'] . 'ознакомились с материалами уголовного дела ' . $values['dateofreview']);    
         $section->addText('10. Уголовное дело № ' . \app\models\Deal::findOne($values['deal_id'])['number'] . 'с обвинительным постановлением направлено в');    
         
        $filename = \Yii::getAlias('@app/runtime/files/') . md5($values['id']) . '.docx';
        try {
            $w->save($filename, 'Word2007');
            return $filename;
        } catch (\Exception $e) {
            \Yii::error($e->getMessage());
        }
    }

}