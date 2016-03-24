<?php

class Timetables extends CI_Model{
    private $xml = null;
    private $timeslots = array();
    private $days = array();
    private $courses = array();
    
    function __construct()
    {
        parent::__construct();
        //parse xml
        $this->xml = simplexml_load_file('Data/timetable.xml');
        
        //populate timeslots array
        foreach($this->xml->timeslots->time as $time)
        {
           $classes = array();
           foreach($time->class as $class)
            {
                $record = new Booking($class);
                array_push($classes, $record);
                
            } 
            $this->timeslots[$record->start] = $classes;
        }    
        //populate courses array 
        foreach($this->xml->courses->course as $course)
        {
           $classes = array();
           foreach($course->class as $class)
            {
                $record = new Booking($class);
                array_push($classes, $record);
            }
            $this->courses[$record->course] = $classes;
        }
        
        //populate days array 
        foreach($this->xml->daysofweek->weekday as $weekday)
        {
           $classes = array();
           foreach($weekday->class as $class)
            {
                $record = new Booking($class);
                array_push($classes, $record);
            }
            $this->days[$record->day] = $classes;
        }
    }
    
    public function allTimeslots()
    {
        return $this->timeslots;
    }
    
     public function allDays()
    {
        return $this->days;
    }
    
     public function allCourses()
    {
        return $this->courses;
    }
    
    public function getClassByTimeslot($startTime, $day)
    {
        foreach($this->timeslots as $slots)
        {
            //foreach($slots->)
        }
    }
    
    public function getClassByCourse($courseName)
    {
        if(isset($this->courses[$courseName]))
        {
            return $this->courses[$courseName];
        }  
        else
        {
           return null; 
        }     
    }
    
       public function getClassByDay($day)
    {
        if(isset($this->days[$day]))
        {
            return $this->days[$day];
        }  
        else
        {
           return null; 
        }     
    } 
}

class Booking extends CI_Model
{
    public $day = null;
    public $course = null;
    public $instructor = null;
    public $location = null;
    public $start = null;
    public $end = null;
    
    function __construct($class)
    {
        $this->day = (string) $class['day'];
        $this->course = (string) $class['course'];
        $this->instructor = (string) $class['instructor'];
        $this->location = (string) $class['location'];
        $this->start = (string) $class['start'];
        $this->end = (string) $class['end'];
    }
}

