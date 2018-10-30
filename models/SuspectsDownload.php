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
        $w->setDefaultFontName('Times New Roman');
        $w->setDefaultFontSize('14');
        $sectionStyle = array(
            'marginLeft' => 1700.78, 
            'marginRight' => 850.39,
            'marginTop' => 1133.85);

        $section = $w->createSection($sectionStyle);

        foreach ($data['suspects'] as $suspect) {
            $w->addParagraphStyle('topP', array(
        'align' => 'center',
        ));
        $section->addText('ПРОТОКОЛ', null, 'topP');
        
        $section->addText('ФИО: ' . $suspect['name']);
        
        
            $section->addText('1. Срок дознания 10 суток. Уголовное дело возбуждено ' . $suspect['name'] . 'по признакам преступления, предусмотренного ' . \app\models\Deal::findOne($suspect['deal_id'])['number']);
            $section->addText('2. ' . $suspect['name']. ' в соответствии со ст. 91 УПК РФ не задерживался');
            
            $section->addText('3. Мера пресечения' . $suspect['mp']);
            $section->addText('4. Вещественные доказательства по уголовному делу: '. $suspect['evidence']);
            $section->addText('5. Гражданский иск по уголовному делу: '. $suspect['gi']);
            $section->addText('6. Меры, принятые в обеспечение гражданского иска и возможной конфискации имущества: '. $suspect['securofclaim']);
            $section->addText('7. Меры по обеспечению прав иждивенцев у потерпевшего и обвиняемого: '. $suspect['guarantee']);
            $section->addText('8. Процессуальные издержки по уголовному делу: '. $suspect['cost']);
            $section->addText('9. Обвиняемый '. $suspect['name'] . ' защитник' . $suspect['lawyer'] . 'ознакомились с материалами уголовного дела' . $suspect['dateofreview']);
            $section->addText('10. Уголовное дело '. \app\models\Deal::findOne($data['deal_id'])['number'] . 'с обвинительным постановлением направлено ' . $suspect['sent']);
            
            $section->addPageBreak();
        }

        foreach ($data['suspects'] as $suspect) {
            $w->addParagraphStyle('topP', array(
                'align' => 'center',
            ));
            $section->addText('ПРОТОКОЛ', null, 'topP');

            $section->addText('ФИО: ' . $suspect['name']);


            $section->addText('1. Срок дознания 10 суток. Уголовное дело возбуждено ' . $suspect['name'] . 'по признакам преступления, предусмотренного ' . \app\models\Deal::findOne($suspect['deal_id'])['number']);
            $section->addText('2. ' . $suspect['name']. ' в соответствии со ст. 91 УПК РФ не задерживался');

            $section->addText('3. Мера пресечения' . $suspect['mp']);
            $section->addText('4. Вещественные доказательства по уголовному делу: '. $suspect['evidence']);
            $section->addText('5. Гражданский иск по уголовному делу: '. $suspect['gi']);
            $section->addText('6. Меры, принятые в обеспечение гражданского иска и возможной конфискации имущества: '. $suspect['securofclaim']);
            $section->addText('7. Меры по обеспечению прав иждивенцев у потерпевшего и обвиняемого: '. $suspect['guarantee']);
            $section->addText('8. Процессуальные издержки по уголовному делу: '. $suspect['cost']);
            $section->addText('9. Обвиняемый '. $suspect['name'] . ' защитник' . $suspect['lawyer'] . 'ознакомились с материалами уголовного дела' . $suspect['dateofreview']);
            $section->addText('10. Уголовное дело '. \app\models\Deal::findOne($values['deal_id'])['number'] . 'с обвинительным постановлением направлено ' . $suspect['sent']);

            $section->addPageBreak();
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