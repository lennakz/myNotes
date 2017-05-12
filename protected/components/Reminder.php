<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Reminder extends CWidget
{
    public function run()
    {
		$criteria = new CDbCriteria;
		$criteria->compare('t.user_id', Yii::app()->user->id);
		$criteria->with = array('Items');
		$criteria->order = 't.updated DESC, t.completed DESC';
		
		$p['notes'] = Note::model()->findAll($criteria);
		
		foreach ($p['notes'] as $note)
		{
			foreach ($note->Items as $item)
			{
				if ($item->reminder <= time())
					$p['returnYes'][] = $item;
				else
					$p['returnNo'][] = $item;
			}
		}
		
		//dump($p['returnYes']);exit;
		
		$this->render('reminder', $p);
    }
}