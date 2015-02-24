<?php
/*
* Ugly as hell, I know, but it does work and will get you the selected filter with the right values, which can be applied 
* to the category. So we could put this stuff into a Block and run it somewhere nicely, but I'm too busy right nao >_>
*
*
*/

$layer = Mage::getModel('catalog/layer');
$category = Mage::getModel('catalog/category')->load(Mage::registry('current_category')->getId());
$layer->setCurrentCategory($category);
$attributes = $layer->getFilterableAttributes();
$_category  = $this->getCurrentCategory();


foreach($attributes as $attr):
	if(in_array($attr->getAttributeId(), $_category->getCatprodattr())):
		if ($attr->getAttributeCode() == 'price') {
			$filterBlockName = 'catalog/layer_filter_price';
		} elseif ($attr->getBackendType() == 'decimal') {
			$filterBlockName = 'catalog/layer_filter_decimal';
		} else {
			$filterBlockName = 'catalog/layer_filter_attribute';
		}

		$result = $this->getLayout()->createBlock($filterBlockName)->setLayer($layer)->setAttributeModel($attr)->init();
		
		foreach($result->getItems() as $option):
			var_dump($option->getValue());
		endforeach;
	endif;
endforeach;
