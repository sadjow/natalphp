<?php
// $Id: parse_error_test.php 45 2010-01-10 20:05:40Z Sadjow $
require_once('../unit_tester.php');
require_once('../reporter.php');

$test = &new TestSuite('This should fail');
$test->addFile('test_with_parse_error.php');
$test->run(new HtmlReporter());
?>