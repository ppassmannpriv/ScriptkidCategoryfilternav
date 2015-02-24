<?php
$installer = $this;
$installer->startSetup();

$installer->addAttribute('catalog_category', 'catprodattrshownav',  array(
	'type'     => 'int',
	'backend'  => '',
	'frontend' => '',
	'label'    => 'Filter Select Mode',
	'input'    => 'select',
	'class'    => '',
	'source'   => 'categoryfilternav/eav_entity_attribute_source_categoryproductattributesshownav',
	'global'   => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
	'visible'  => true,
	'required' => false,
	'user_defined'  => false,
	'default' => '1',
	'searchable' => false,
	'filterable' => false,
	'comparable' => false,

	'visible_on_front'  => false,
	'unique'     => false,
	'note'       => ''

	)
);
	
	
$installer->addAttribute('catalog_category', 'catprodattr',  array(
	'type'     => 'text',
	'backend'  => 'categoryfilternav/eav_entity_attribute_backend_categoryoptions',
	'frontend' => '',
	'label'    => 'Selected Filter',
	'input'    => 'multiselect',
	'class'    => '',
	'source'   => 'categoryfilternav/eav_entity_attribute_source_categoryproductattributes',
	'global'   => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
	'visible'  => true,
	'required' => false,
	'user_defined'  => false,
	'default' => '',
	'searchable' => false,
	'filterable' => false,
	'comparable' => false,

	'visible_on_front'  => false,
	'unique'     => false,
	'note'       => 'select which filters you would like to disable/enable for this category'

	)
);
	
	

	
$installer->endSetup();