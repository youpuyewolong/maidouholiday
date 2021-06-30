<?php
require "vendor/autoload.php";
use Maidou\Holiday\Holiday;

//某一天是否工作日
$is_work = Holiday::instance()->is_work_day("2021-05-10");
//日期段内工作日天数
$days = Holiday::instance()->work_days_between("2021-10-01","2021-10-10");
