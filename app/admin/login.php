<?php

require_once dirname(__DIR__) . '/config/start.php';

require_once LAYOUT . 'admin_layout.php';

$layout = new AdminLayout('DetetiveBR : WBMMOG');

$layout->bodyElement()->id('login-bg');

echo $layout->header();


$loginHolder = new View\HTML\Div('', 'login-holder');

echo $loginHolder;

echo $layout->footer();