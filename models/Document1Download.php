<?php

namespace app\models;

use PhpOffice\PhpWord\PhpWord;

/**
 * Генерирует и возвращает документ
 *
 * Class Document1Download
 * @package app\models
 */
class Document1Download
{
    /**
     * Извлекает значения из БД по id
     *
     * @param number $id индекс в БД
     * @return array
     */
    private function getValues($id)
    {
        return Document1::find()->where(['id' => $id])->asArray()->one();
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

        $section = $w->addSection();
        $section->addText('Наименование организации');
        $section->addText('СПРАВКА');
        $section->addText('№ ' . $values['number']);

        $section->addTextBreak(5);

        $section->addText('Дана ' . $values['name'] . ' в том, что он (она) действительно работает в ' .
            $values['workplace'] . ' на должности ' . $values['post']);
        $section->addText('Справка дана для представления в ' . $values['for']);

        $filename = \Yii::getAlias('@app/runtime/files/') . md5($values['id']) . '.docx';
        try {
            $w->save($filename, 'Word2007');
            return $filename;
        } catch (\Exception $e) {
            \Yii::error($e->getMessage());
        }
    }

}