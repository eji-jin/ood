<?php

namespace app\models;

use PhpOffice\PhpWord\PhpWord;
use yii\web\Response;

class SuspectsDownload
{
    /**
     * @param $data
     * @return Response
     */
    public function getDocument($data)
    {
        $filepath = $this->generateDocument($data);
        return \Yii::$app->response->sendFile($filepath);
    }

    /**
     * @param $data
     * @return string
     * @throws \Exception
     */
    public function generateDocument($data)
    {
        $w = new PhpWord();

        $section = $w->addSection();
        $section->addText('Подозреваемые');

        foreach ($data['suspects'] as $suspect) {
            $section->addText('ФИО: ' . $suspect['name']);
            $section->addText('Что-то еще: ' . $suspect['smth']);
            $section->addText(' ');
        }

        $filename = \Yii::getAlias('@app/runtime/files/') . uniqid('', false)  . '.docx';
        try {
            $w->save($filename, 'Word2007');
            return $filename;
        } catch (\Exception $e) {
            throw $e;
        }
    }
}