<?php

namespace app\models;
use PhpOffice\PhpWord\PhpWord;
use app\models\Reference;
use NCL\NCLNameCaseRu;
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
        //return Protocol::find()->where(['id' => $id])->asArray()->one();
        return Reference::findAll(['deal_id' => $id]);
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
        $section->addText('СПРАВКА ', null, topP);
        $case = new NCLNameCaseRu();
        $names = "";
        foreach ($references as $reference) {
            $array = $case->q(Protocol::findOne( $reference['protocol_id'] )['suspect'], NCLNameCaseRu::$RODITLN);
        $names .= " ";
        $names .= $array;
    }
        $section->addListItem('Уголовное дело №'.Deal::findOne($references[0]['deal_id'] )['number'].' возбуждено '.'в отношении '.$names. ' по признакам состава преступления предусмотренного '. Protocol::findOne( $references[0]['protocol_id'] )['incriminate'], 0, null, array('listType'=>ListItem::TYPE_NUMBER));
        foreach ($references as $reference) {
            $section->addListItem(Protocol::findOne( $reference['protocol_id'] )['suspect']. ' допрошен в качестве подозреваемого '.Protocol::findOne( $reference['protocol_id'] )['createdate'], 0,null, array('listType'=>ListItem::TYPE_NUMBER));
        }





        foreach ($references as $reference) {
            $array = $case->q(Protocol::findOne( $reference['protocol_id'] )['suspect'], NCLNameCaseRu::$RODITLN);
            if($reference['securofclaim']!="") {
                $section->addListItem('Мера процессуального принуждения в отношении  ' . $array . ': ' . $reference['securofclaim'], 0, null, array('listType' => ListItem::TYPE_NUMBER));
            }
        }

        foreach ($references as $reference) {
            if($reference['evidence']!=""){
            $section->addListItem('Вещественные доказательства по уголовному делу:  '.$reference['evidence'], 0,null, array('listType'=>ListItem::TYPE_NUMBER));
            }
        }

        foreach ($references as $reference) {
            if($reference['claim']!=""){
                $section->addListItem('Гражданский иск:  '.$reference['claim'], 0,null, array('listType'=>ListItem::TYPE_NUMBER));
            }
        }

        foreach ($references as $reference) {
            $section->addListItem( 'Процессуальные издержки:  '.$reference['cost'], 0,null, array('listType'=>ListItem::TYPE_NUMBER));
        }
        $section->addListItem( 'Обвинительный акт составлен  ', 0,null, array('listType'=>ListItem::TYPE_NUMBER));

        $filename = \Yii::getAlias('@app/runtime/files/') . md5($references['id']) . '.docx';
        try {
            $w->save($filename, 'Word2007');
            return $filename;
        } catch (\Exception $e) {
            \Yii::error($e->getMessage());
        }
    }
}