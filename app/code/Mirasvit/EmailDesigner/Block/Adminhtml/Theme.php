<?php
/**
 * Mirasvit
 *
 * This source file is subject to the Mirasvit Software License, which is available at https://mirasvit.com/license/.
 * Do not edit or add to this file if you wish to upgrade the to newer versions in the future.
 * If you wish to customize this module for your needs.
 * Please refer to http://www.magentocommerce.com for more information.
 *
 * @category  Mirasvit
 * @package   mirasvit/module-email-designer
 * @version   1.1.26
 * @copyright Copyright (C) 2018 Mirasvit (https://mirasvit.com/)
 */



namespace Mirasvit\EmailDesigner\Block\Adminhtml;

use Magento\Backend\Block\Widget\Grid\Container;

class Theme extends Container
{
    /**
     * {@inheritdoc}
     */
    protected function _construct()
    {
        $this->_controller = 'adminhtml_theme';
        $this->_blockGroup = 'Mirasvit_EmailDesigner';
        $this->_addButtonLabel = __('Add Theme');

        parent::_construct();
    }
}
