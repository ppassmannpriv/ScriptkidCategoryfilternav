<?php

class Scriptkid_Categoryfilternav_Model_Eav_Entity_Attribute_Backend_Categoryoptions extends 
Mage_Eav_Model_Entity_Attribute_Backend_Abstract
{
	/**
	 * Validation
	 *
	 * @param Varien_Object $object
	 * @return bool
	 */
	public function validate($object)
	{
		$attributeCode = $this->getAttribute()->getName();
		$postDataConfig = $object->getData('use_post_data_config');
		if ($postDataConfig) {
			$isUseConfig = in_array($attributeCode, $postDataConfig);
		} else {
			$isUseConfig = false;
			$postDataConfig = array();
		}

		if ($this->getAttribute()->getIsRequired()) {
			$attributeValue = $object->getData($attributeCode);
			if ($this->getAttribute()->isValueEmpty($attributeValue)) {
				if (is_array($attributeValue) && count($attributeValue)>0) {
				} else {
					if(!$isUseConfig) {
						return false;
					}
				}
			}
		}

		if ($this->getAttribute()->getIsUnique()) {
			if (!$this->getAttribute()->getEntity()->checkAttributeUniqueValue($this->getAttribute(), $object)) {
				$label = $this->getAttribute()->getFrontend()->getLabel();
				Mage::throwException(Mage::helper('eav')->__('The value of attribute "%s" must be unique.', $label));
			}
		}

		return true;
	}

	/**
	 * Before attribute safe
	 *
	 * @param Varien_Object $object
	 * @return Mage_Catalog_Model_Category_Attribute_Backend_Sortby
	 */
	public function beforeSave($object) {
		$attributeCode = $this->getAttribute()->getName();

		if ($attributeCode == 'catprodattr') {
			$data = $object->getData($attributeCode);

			if (!is_array($data)) {
				$data = array();
			}

			$object->setData($attributeCode, join(',', $data));
		}

		if (is_null($object->getData($attributeCode))) {
			$object->setData($attributeCode, false);
		}

		return $this;
	}
	
	/**
	 * After load
	 *
	 * @param Varien_Object $object
	 * @return $this
	 */
	public function afterLoad($object) {
		$attributeCode = $this->getAttribute()->getName();

		if ($attributeCode == 'catprodattr') {
			$data = $object->getData($attributeCode);

			if ($data) {
				$object->setData($attributeCode, explode(',', $data));
			}

		}

		return $this;
	}
}
