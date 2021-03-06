<?php
/**
 * BootstrapDateTimePicker class file.
 * Made for DateTime Picker
 * https://github.com/xdan/datetimepicker
 *
 * @author Mykola Kotok <mykola.kotok@gmail.com>
 */

Yii::import('zii.widgets.jui.CJuiDatePicker');
class DateTimePicker extends CJuiDatePicker
{
	const ASSETS_NAME='/jquery.datetimepicker';
	
	public function run()
	{
		list($name,$id)=$this->resolveNameID();

		if(isset($this->htmlOptions['id']))
			$id=$this->htmlOptions['id'];
		else
			$this->htmlOptions['id']=$id;
		if(isset($this->htmlOptions['name']))
			$name=$this->htmlOptions['name'];
		else
			$this->htmlOptions['name']=$name;

		if($this->hasModel())
			echo CHtml::activeTextField($this->model,$this->attribute,$this->htmlOptions);
		else
			echo CHtml::textField($name,$this->value,$this->htmlOptions);


		$options=CJavaScript::encode($this->options);

		$js = "jQuery('#{$id}').datetimepicker($options);";

		$cs = Yii::app()->getClientScript();
		
		$baseUrl = Yii::app()->request->baseUrl;
		
		$cs->registerCssFile($baseUrl.'/css'.self::ASSETS_NAME.'.min.css');
		$cs->registerScriptFile($baseUrl.'/js'.self::ASSETS_NAME.'.full.js',CClientScript::POS_HEAD);
		
		$cs->registerScript(__CLASS__.'#'.$id, $js);

	}
}