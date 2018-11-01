<?php

namespace app\models;
use PhpOffice\PhpWord\PhpWord;
use app\models\Reference;
use PhpOffice\PhpWord\Style\ListItem;

/* @var $protocols array */
/* @var $deals array */
/* @var $reference array */
/**
 * Генерирует и возвращает документ
 *
 * Class Doc2Download
 * @package app\models
 * @param mixed $styleList
 */

class ReferenceDownload
{
    /**
     * Извлекает значения из БД по id
     * @param Protocol
     * @param Deal
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
     * @param $references
     * @return string Абсолютный путь к файлу (включая имя)
     * @see https://phpword.readthedocs.io/en/latest/general.html
     */
    private function generateDocument($references)
    {
        $w = new PhpWord();
        $section = $w->addSection();
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

        $names = "";
        $section->addListItem('Уголовное дело №'.Deal::findOne($references[0]['deal_id'] )['number'].' возбуждено '.'в отношении '.$names. 'по признакам состава преступления предусмотренного '. Protocol::findOne( $references[0]['protocol_id'] )['incriminate'], 0, null, array('listType'=>ListItem::TYPE_NUMBER));


                /*$section->addText('СПРАВКА', null, 'topP');
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
                $section->addText($values['suspect']);
*/



        $filename = \Yii::getAlias('@app/runtime/files/') . md5($references['id']) . '.docx';
        try {
            $w->save($filename, 'Word2007');
            return $filename;
        } catch (\Exception $e) {
            \Yii::error($e->getMessage());
        }
    }
}