<?php

class Scriptkid_Categoryfilternav_Model_Eav_Entity_Attribute_Source_Categoryproductattributes extends
Mage_Eav_Model_Entity_Attribute_Source_Abstract
{
	/**
	*
	* Get all available options
	*
	* @return array
	*/
	public function getAllOptions()
	{
		if(is_null($this->_options))
		{
			$this->_options = array();
			$productAttributes = Mage::getResourceModel('catalog/product_attribute_collection');
			foreach($productAttributes as $productAttr)
			{
				if($productAttr->getIsFilterable())
				{
					array_push($this->_options, array(
						'value' => $productAttr->getAttributeId(),
						'label' => $productAttr->getAttributeCode()
						)
					);
				}
			}
		}
		return $this->_options;
	}

	/**
	*
	* Retrieve options
	*
	* @return array
	*/
	public function getOptionArray()
	{
		$options = array();
		foreach($this->getAllOptions as $option)
		{
			$options[$option['value']] = $option['label'];
		}

		return $options;
	}

	/**
	*
	* Text for option values
	*
	* @param string|integer $val
	* @return string
	*/
	public function getOptionText($val)
	{
		$options = $this->getAllOptions();
		foreach($options as $option)
		{
			if($option['value'] == $value)
			{
				return $option['label'];
			}
		}
		return false;
	}

	/**
	*
	* Retrieve flat cols
	*
	* @return array
	*/
	public function getFlatColumns()
	{
		$cols = array();
		$cols[$this->getAttribute()->getAttributeCode()] = array(
			'type' => 'int',
			'unsigned' => false,
			'is_null' => true,
			'default' => null,
			'extra' => null
		);

		return $cols;
	}

	/**
	*
	* Retrieve flat indexes
	*
	* @return array
	*/
	public function getFlatIndexes()
	{
		$indexes = array();

		$index = 'IDX_'.strtoupper($this->getAttribute()->getAttributeCode());
		$indexes[$index] = array(
			'type' => 'index',
			'fields' => array($this->getAttribute()->getAttributeCode())
		);

		return $indexes;
	}

	/**
	*
	* Retrieve select for flat attribute-updates
	*
	* @param int $store
	* @return Varien_Db_Select|null
	*/
	public function getFlatUpdateSelect($store)
	{
		return Mage::getResourceModel('eav/entity_attribute')
			->getFlatUpdateSelect($this->getAttribute, $store);
	}
}