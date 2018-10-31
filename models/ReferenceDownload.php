<?php
namespace app\models;
use PhpOffice\PhpWord\PhpWord;
use app\models\Reference;
use PhpOffice\PhpWord\Style\ListItem;
/**
 * Генерирует и возвращает документ
 *
 * Class ReferenceDownload
 * @package app\models
 * @param mixed $styleList
 *
 */
class ReferenceDownload
{
    /**
     * Извлекает значения из БД по id
     *
     * @param number $id индекс в БД
     * @return array
     */
    private function getValues($id)
    {
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
     *
     * @param array $values массив значений из БД
     * @see https://phpword.readthedocs.io/en/latest/general.html
     * @return string Абсолютный путь к файлу (включая имя)
     */
    private function generateDocument($references)
    {
        $w = new PhpWord();
        $section = $w->addSection();
        $names = "";
        foreach ($references as $reference) {
            $names .= " ";
            $names .= Protocol::findOne( $reference['protocol_id'] )['suspect'];
        }

        $section->addText('СПРАВКА',null, array('align' =>'center', 'spaceAfter' =>0));
        $section->addTextBreak(1);
        $section->addListItem('Уголовное дело №'.Deal::findOne($references[0]['deal_id'] )['number'].' возбуждено '.'в отношении '.$names. 'по признакам состава преступления предусмотренного '. Protocol::findOne( $references[0]['protocol_id'] )['incriminate'], 0, null, array('listType'=>ListItem::TYPE_NUMBER));

        foreach ($references as $reference) {
            $section->addListItem(Protocol::findOne( $reference['protocol_id'] )['suspect'].' допрошен в качестве подозреваемого '. Protocol::findOne( $reference['protocol_id'] )['createdate'], 0, null, array('listType'=>ListItem::TYPE_NUMBER));
        }

        foreach ($references as $reference) {
            $section->addListItem('Мера процессуального принуждения в отношении '.Protocol::findOne( $reference['protocol_id'] )['suspect'].'-'.$reference['securofclaim'], 0, null, array('listType'=>ListItem::TYPE_NUMBER));
        }
        foreach ($references as $reference) {
            $section->addListItem('Вещественное доказательство по уголовному делу: '.$references['evidence'], 0, null, array('listType'=>ListItem::TYPE_NUMBER));
        }
        foreach ($references as $reference) {
            $section->addListItem('Гражданский иск: '.$reference['claim'], 0, null, array('listType'=>ListItem::TYPE_NUMBER));
        }
        foreach ($references as $reference) {
            $section->addListItem('Процессуальные издержки - '.$reference['cost'], 0, null, array('listType'=>ListItem::TYPE_NUMBER));
        }
        $section->addListItem('Обвинительный акт составлен', 0, null, array('listType'=>ListItem::TYPE_NUMBER));
        $section->addTextBreak(1);
        $section->addText(Deal::findOne($references[0]['deal_id'] )['position'],null, array('align' =>'both', 'spaceAfter' =>0));
        $section->addText(Deal::findOne($references[0]['deal_id'] )['rank'].'______________________'.Deal::findOne($references[0]['deal_id'] )['name'],null, array('align' =>'both', 'spaceAfter' =>0));




        $filename = \Yii::getAlias('@app/runtime/files/') . md5($values['id']) . '.docx';
        try {
            $w->save($filename, 'Word2007');
            return $filename;
        } catch (\Exception $e) {
            \Yii::error($e->getMessage());
        }
    }
}