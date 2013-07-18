<?php

/**
* Widget Page
*/
class WidgetPage extends Page {

	private static $has_many = array(
		'Widgets' => 'Widget.WidgetPage'
	);

	function getCMSFields(){
		$fields = parent::getCMSFields();

		$adder = new GridFieldAddNewMultiClass();

		if(is_array($this->config()->get("allowed_widgets"))){
			$adder->setClasses($this->config()->get("allowed_widgets"));
		}

		$config = GridFieldConfig_RecordEditor::create()
			->removeComponentsByType("GridFieldAddNewButton")
			->addComponent($adder)
			->addComponent(new GridFieldOrderableRows());

		$fields->addFieldToTab("Root.Main",
			GridField::create('Widgets','Widgets',$this->Widgets())
				->setConfig($config)
			,"Content"
		);
		$fields->removeByName("Content");
		return $fields;
	}

}

/**
* WidgetPage_Controller
*/
class WidgetPage_Controller extends Page_Controller{

}

class WidgetPageWidget extends DataExtension{

	static $has_one = array(
		'WidgetPage' =>  'WidgetPage'
	);

}