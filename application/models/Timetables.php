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
    
     /* 
     * returns all class bookings using the timeslot fasset
     */
    public function allTimeslots()
    {
        return $this->timeslots;
    }
    
     /* 
     * returns all class bookings using the day fasset
     */
    public function allDays()
    {
        return $this->days;
    }
    
    /* 
     * returns all class bookings using the course fasset
     */
    public function allCourses()
    {
        return $this->courses;
    }
    
    /*
     * gets the class booking for the specified time and day of the week using
     * the timeslot fasset
     */
    public function getClassByTimeslot($startTime, $day)
    {
        if($this->timeslots[$startTime] != null)
        {
            foreach($this->timeslots[$startTime] as $class)
            {
                if($class->day == $day)
                {
                    return $class;
                }
            }  
        }
        return null;
    }
    
    /*
     * gets the class booking for the specified time and day of the week using
     * the course fasset
     */
    public function getClassByCourse($startTime, $day)
    {
         foreach($this->courses as $course)
         {
             foreach($course as $class)
            {
                if($class->day === $day && $class->start === $startTime)
                {
                    return $class;
                } 
            }
         }
         return null;
    }
    
    /*
     * gets the class booking for the specified time and day of the week using
     * the day fasset
     */
    public function getClassByDay($startTime, $day)
    {
       if($this->days[$day] != null)
        {
            foreach($this->days[$day] as $class)
            {
                if($class->start == $startTime)
                {
                    return $class;
                }
            }  
        }
        return null;
    }
    
    /*
     * returns an array of timeslots that appear in the xml
     */
    public function getTimeslots()
    {
        return array_keys($this->timeslots);
    }
    
    public function getDays() 
    {
        return array_keys($this->days);
    }
    
     /*
     * returns an array of courses that appear in the xml
     */
    public function getCourses()
    {
        return array_keys($this->courses);
    }
}

/*
 * represents a single booking in the timetable
 */
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

