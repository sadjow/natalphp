<?php
/* SVN FILE: $Id: index.php 99 2010-05-20 15:41:54Z sadjow $ */
/**
 * Configuration file.
 *
 * NatalPHP (tm) :  Sufficient and Simple Framework (http://www.trycatch.com.br)
 * Copyright 2010 Sadjow Medeiros Leão <sadjow[at]gmail.com>,
 * Waldson Patricio <waldsonpatricio[at]gmail.com
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright     Copyright 2010 Sadjow Medeiros Leão <sadjow[at]gmail.com>,
 *                Waldson Patricio <waldsonpatricio[at]gmail.com
 * @link          http://www.trycatch.com.br Natal(tm) Project
 * @package       App
 * @since         NatalPHP(tm) v 0.1
 * @version       $Rev: 98 $
 * @modifiedby    $LastChangedBy: sadjow $
 * @lastmodified  $Date: 2010-05-20 09:47:48 -0300 (qui, 20 mai 2010) $
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */

require_once __DIR__ . '/config/start.php';

require_once __DIR__ . '/layouts/admin_layout.php';

$layout = new AdminLayout('DetetiveBR : WBMMOG');

echo $layout->header();

echo $layout->footer();