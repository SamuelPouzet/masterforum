<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 12/01/2020
 * Time: 14:18
 */

namespace Application\View\Helper;

use Zend\View\Helper\AbstractHelper;

/**
 * This view helper class displays a menu bar.
 */
class MenuHelper extends AbstractHelper
{
    /**
     * Menu items array.
     * @var array
     */
    protected $items = [];

    /**
     * Active item's ID.
     * @var string
     */
    protected $activeItemId = '';

    /**
     * Constructor.
     * @param array $items Menu items.
     */
    public function __construct($items=[])
    {
        $this->items = $items;
    }

    /**
     * Sets menu items.
     * @param array $items Menu items.
     */
    public function setItems($items)
    {
        $this->items = $items;
    }

    /**
     * Sets ID of the active items.
     * @param string $activeItemId
     */
    public function setActiveItemId($activeItemId)
    {
        $this->activeItemId = $activeItemId;
    }

    /**
     * Renders the menu.
     * @return string HTML code of the menu.
     */
    public function render()
    {
        if (count($this->items)==0){
            return ''; // Do nothing if there are no items.
        }

        $result = '<div class="collapse navbar-collapse navbar-right navbar-main-collapse">';
        $result .= '<ul class="nav navbar-nav ml-auto">';


        // Render items
        foreach ($this->items as $item) {
            if(!isset($item['float']) || $item['float']=='left')
                $result .= $this->renderItem($item);
        }

        $result .= '</ul>';
        $result .= '<ul class="nav navbar-nav navbar-right">';

        // Render items
        foreach ($this->items as $item) {
            if(isset($item['float']) && $item['float']=='right')
                $result .= $this->renderItem($item);
        }

        $result .= '</ul>';
        $result .= '</div>';

        return $result;

    }

    /**
     * Renders an item.
     * @param array $item The menu item info.
     * @return string HTML code of the item.
     */
    protected function renderItem($item)
    {
        $id = isset($item['id']) ? $item['id'] : '';
        $isActive = ($id==$this->activeItemId);
        $label = isset($item['label']) ? $item['label'] : '';

        $result = '';

        $escapeHtml = $this->getView()->plugin('escapeHtml');

        if (isset($item['dropdown'])) {

            $dropdownItems = $item['dropdown'];

            $result .= '<li class="nav-item dropdown ' . ($isActive?'active':'') . '">' . "\r\n";
            $result .= '<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" id="navbardropdown' . $id . '"  aria-haspopup="true" aria-expanded="false">';
            $result .= $escapeHtml($label) . ' <b class="caret"></b>' . "\r\n";
            $result .= '</a>';

            $result .= '<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbardropdown' . $id . '">';
            foreach ($dropdownItems as $item) {
                $link = isset($item['link']) ? $item['link'] : '#';
                $label = isset($item['label']) ? $item['label'] : '';
                $result .= '<a class="dropdown-item" href="'.$escapeHtml($link).'">'.$escapeHtml($label).'</a>'  . "\r\n";
            }
            $result .= '</div>';
            $result .= '</li>';

        } else {
            $link = isset($item['link']) ? $item['link'] : '#';

            $result .= $isActive?'<li class="nav-item active">':'<li class="nav-item">';
            $result .= '<a class="nav-link" href="'.$escapeHtml($link).'">'.$escapeHtml($label).'</a>' . "\r\n";
            $result .= '</li>';
        }

        return $result;
    }
}