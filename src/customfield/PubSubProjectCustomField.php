<?php
/**
 * @author Christopher Johnson
 * @license GPL version 3
 */

abstract class PubSubProjectCustomField extends PhabricatorProjectCustomField
    implements PhabricatorStandardCustomFieldInterface {


  /**
   * Required in order to implement PhabricatorStandardCustomFieldInterface
   */
  public function getStandardCustomFieldNamespace() {
    return 'project';
  }

  /**
   * @param string $name
   * @param string $description
   */
  public function getTextFieldProxy($textfield, $name, $description) {
    $obj = clone $textfield;
    $textproxy = id(new PhabricatorStandardCustomFieldText())
        ->setFieldKey($this->getFieldKey())
        ->setApplicationField($obj)
        ->setFieldConfig(array(
            'name' => $name,
            'description' => $description,
        ));
    $this->setProxy($textproxy);
    return $textproxy;
  }

   public function renderTextProxyPropertyViewValue($textproxy, $handles) {
      return $textproxy->renderPropertyViewValue($handles);
  }

  public function renderPropertyViewLabel() {
    if ($this->getProxy()) {
      return $this->getProxy()->renderPropertyViewLabel();
    }
    return $this->getFieldName();
  }

  public function renderPropertyViewValue(array $handles) {
    return $this->getProxy()->renderPropertyViewValue($handles);
  }

}
