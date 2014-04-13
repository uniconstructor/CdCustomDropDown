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
<script type="text/javascript">
	function DropDown(el) {
		this.dd = el;
		this.initEvents();
	}
	
	DropDown.prototype = {
		initEvents : function() {
			var obj = this;
			obj.dd.on('click', function(event){
				$(this).toggleClass('active');
				event.stopPropagation();
			});	
		}
	}
	
	$(function() {
		var dd = new DropDown( $('#<?= $this->id; ?>') );
		$(document).click(function() {
			// all dropdowns
			$('.wrapper-dropdown-5').removeClass('active');
		});
	});
</script>