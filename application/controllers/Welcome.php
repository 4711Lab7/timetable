<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends Application {

    function __construct() {
        parent::__construct();
    }
    
    public function index()
    {
        $source = $this->timetables->getDays();
        foreach($source as $dayList) {
            $dayNames[] = array('Name' => $dayList);
        }
        $this->data['dayList'] = $dayNames;
        $source = $this->timetables->getTimeslots();
        foreach($source as $timeList) {
            $timeValues[] = array('timeValue' => $timeList);
        }
        $this->data['timeList'] = $timeValues;  
        $source = $this->timetables->allTimeSlots();
        foreach($source as $time) {
            foreach($time as $booking) {
                $times[] = array('Location' => $booking->location,
                                 'Day' => $booking->day,
                                 'Course' => $booking->course,
                                 'Instructor' => $booking->instructor,
                                 'End' => $booking->end,
                                 'Start' => $booking->start);
            }
            $this->data['time'] = $times;  
        }
        $source = $this->timetables->allDays();
        foreach($source as $day) {
            foreach($day as $booking) {
                $days[] = array('Location' => $booking->location,
                                 'Day' => $booking->day,
                                 'Course' => $booking->course,
                                 'Instructor' => $booking->instructor,
                                 'End' => $booking->end,
                                 'Start' => $booking->start);
            }
            $this->data['day'] = $days;  
        }
        $source = $this->timetables->allCourses();
        foreach($source as $course) {
            foreach($course as $booking) {
                $courses[] = array('Location' => $booking->location,
                                 'Day' => $booking->day,
                                 'Course' => $booking->course,
                                 'Instructor' => $booking->instructor,
                                 'End' => $booking->end,
                                 'Start' => $booking->start);
            }
            $this->data['course'] = $courses;  
        }
        $this->data['pagebody'] = 'welcome_message';
        $this->render();
    }
    
    public function search($day, $time) {
        
    }
}
