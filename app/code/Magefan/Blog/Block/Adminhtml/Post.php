<?php
/**
 * Copyright © Magefan (support@magefan.com). All rights reserved.
 * See LICENSE.txt for license details (http://opensource.org/licenses/osl-3.0.php).
 *
 * Glory to Ukraine! Glory to the heroes!
 */

namespace Magefan\Blog\Block\Adminhtml;

/**
 * Admin blog post
 */
class Post extends \Magento\Backend\Block\Widget\Grid\Container
{
    /**
     * Constructor
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_controller = 'adminhtml_post';
        $this->_blockGroup = 'Magefan_Blog';
        $this->_headerText = __('Post');
        $this->_addButtonLabel = __('Add New Post');

        parent::_construct();
    }

    /**
     * @return $this
     */
    protected function _prepareLayout()
    {

        $onClick = "setLocation('" . $this->getUrl('*/import') . "')";

        $this->getToolbar()->addChild(
            'options_button',
            \Magento\Backend\Block\Widget\Button::class,
            ['label' => __('Import Posts'), 'onclick' => $onClick]
        );

        return parent::_prepareLayout();
    }
}