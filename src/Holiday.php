<?php

namespace Maidou\Holiday;

class Holiday {

    public static $work = [];
    public static $holiday= [];

    public function __construct(){
        $data = require "data.php";
        $this->work = $data['work'];
        $this->holiday = $data['holiday'];
    }
    public static function instance(){
        return new self();
    }
    /**
     * 获取某日期是否工作日
     * @param $date
     * @return bool true 工作日  false 休息日
     */
    public function is_work_day($date){
        if($this->in_work_data($date) || (!$this->in_holiday_data($date) && !$this->is_weekend($date))) return true;
        return false;
    }
    /**
     * 获取时间范围内工作日天数
     * @param $start_date
     * @param $end_date
     * @return int 天数
     */
    public function work_days_between($start_date, $end_date){
        $i = 0;
        $days = 0;
        while (date('Y-m-d', strtotime("$start_date +$i days")) <= $end_date) {
            $is_work_day = $this->is_work_day(date('Y-m-d', strtotime("$start_date +$i days")));
            if($is_work_day) $days++;
            $i++;
        }
        return $days;
    }
    protected function in_work_data($date){
//        echo $date.PHP_EOL;
//        var_dump($this->work);
        if(in_array($date,$this->work)) return true;
        return false;
    }
    protected function in_holiday_data($date){
        if(in_array($date,$this->holiday)) return true;
        return false;
    }
    protected function is_weekend($date){
        if((date('w',strtotime($date))==6) || (date('w',strtotime($date)) == 0)) return true;
        return false;
    }
}