<?php

class Timetables extends CI_Model{
    private $xml = null;
    private $timeslots = array();
    
    
    
    function __construct()
    {
        parent::__construct();
        $this->xml = simplexml_load_file('Data/timetable.xml');
        
        foreach($this->xml->timeslots->time as $time)
        {
           $classes = array();
           foreach($time->class as $class)
            {
                $record = new stdClass();
                $record->day = (string) $class['day'];
                $record->course = (string) $class['course'];
                $record->instructor = (string) $class['instructor'];
                $record->location = (string) $class['location'];
                $record->start = (string) $class['start'];
                $record->end = (string) $class['end'];
                array_push($classes, $record);
            }
            
            $this->timeslots[$record->start] = $classes;
        }    
    }
    
    public function getTimeslot($startTime)
    {
        if(isset($this->timeslots[$startTime]))
        {
            return $this->timeslots[$startTime];
        }  
        else
        {
           return null; 
        }     
    }
    public function allTimeslots()
    {
        return $this->timeslots;
    }
}