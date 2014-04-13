<?php

/**
 * Yii wrapper for custom dropdown list.
 * @see http://tympanus.net/codrops/?p=11112
 * @see http://tympanus.net/Tutorials/CustomDropDownListStyling/index5.html
 * 
 * Important: Font Awesome was removed from this plugin for some compatibility reasons, 
 * because it is already included in YiiBooster
 */
class CdCustomDropDown extends CWidget
{
    /**
     * @var array - menu items
     * Example:
     * array(
     *     // menu item with text only
     *     [0] => array(
     *         'url'  => 'http://example.com/section1',
     *         'text' => 'Menu Item',
     *         'linkOptions' => array('target' => '_blank'),
     *         'itemOptions' => array('style' => 'line-height:45px;'),
     *     ),
     *     // menu item with text and icon
     *     [1] => array(
     *         'url'  => 'http://example.com/section2',
     *         'text' => 'Menu Item',
     *         'icon' => '<i class="icon-gear"></i>', // you can also use any custom html here
     *         'linkOptions' => array('target' => '_blank'),
     *         'itemOptions' => array('style' => 'line-height:45px;'),
     *     ),
     *     // menu item with custom html content
     *     [2] => array(
     *         'url'  => 'http://example.com/section3',
     *         'html' => '<i class="icon-gear"></i>Menu Item',
     *         'linkOptions' => array('target' => '_blank'),
     *         'itemOptions' => array('style' => 'line-height:45px;'),
     *     ),
     * )
     */
    public $items;
    /**
     * @var bool - include modernizr library or not
     */
    public $includeModernizr = false;
    /**
     * @var string - html content, displayed when dropdown is not expanded
     */
    public $mainContent = '&nbsp;';
    /**
     * @var array
     */
    public $wrapperOptions = array(
        'class' => 'wrapper-dropdown-5',
    );
    /**
     * @var array
     */
    public $listOptions = array(
        'class' => 'dropdown dropdown-bootstrap-fix',
    );
    
    /**
     * @var string
     */
    protected $assetUrl;
    
    /**
     * @see CWidget::init()
     */
    public function init()
    {
        $this->assetUrl = Yii::app()->assetManager->publish(Yii::getPathOfAlias('ext.CdCustomDropDown.assets'));
        
        Yii::app()->clientScript->registerCssFile($this->assetUrl.'/css/style.css');
        Yii::app()->clientScript->registerCssFile($this->assetUrl.'/css/noJS.css');
        
        if ( $this->includeModernizr )
        {// modernizr library is very popular, and can be already included in your project
            Yii::app()->clientScript->registerScriptFile($this->assetUrl.'/js/modernizr.custom.js');
        }
        $this->wrapperOptions['id'] = $this->id;
    }
    
    /**
     * @see CWidget::run()
     */
    public function run()
    {
        $this->render('ext.CdCustomDropDown.views.dropdown');
    }
    
    /**
     * @param array $item 
     * @return string
     */
    protected function getItemContent($item)
    {
        $content     = '';
        $linkOptions = array();
        $itemOptions = array();
        $url         = '#';
        
        if ( isset($item['linkOptions']) AND is_array($item['linkOptions']) )
        {
            $linkOptions = $item['linkOptions'];
        }
        if ( isset($item['itemOptions']) AND is_array($item['itemOptions']) )
        {
            $itemOptions = $item['itemOptions'];
        }
        if ( isset($item['url']) AND $item['url'] )
        {
            $url = $item['url'];
        }
        
        $content .= CHtml::openTag('li', $itemOptions);
        if ( isset($item['html']) )
        {// item with custom html content
            $label = $item['html'];
        }elseif ( isset($item['text']) AND isset($item['icon']) )
        {// item with text and icon
            $label = $item['icon'].$item['text'];
        }elseif ( isset($item['text']) AND ! isset($item['icon']) )
        {// item with text only
            $label = $item['text'];
        }else
        {// incorrect function argument
            throw new CException('Error: wrong menu item content');
        }
        $content .= CHtml::link($label, $url, $linkOptions);
        $content .= CHtml::closeTag('li');
        
        return $content;
    }
}