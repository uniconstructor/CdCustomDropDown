<?php
/**
 * Dropdown html layout
 */
/* @var $this CdCustomDropDown */

echo CHtml::openTag('div', $this->wrapperOptions);
echo $this->mainContent; // default dropdown label
echo CHtml::openTag('ul', $this->listOptions);
foreach ( $this->items as $item )
{
    echo $this->getItemContent($item);
}
echo CHtml::closeTag('ul');
echo CHtml::closeTag('div');
?>