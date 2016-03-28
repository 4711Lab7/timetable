<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends Application {

    function __construct() {
        parent::__construct();
    }
    
    public function index()
    {
        $this->data['searchResult'] = '';
        if($this->input->post('timeSelector') != null && $this->input->post('daySelector') != null) {
            $selectedTime = $this->input->post('timeSelector');
            $selectedDay = $this->input->post('daySelector');
            $this->data['searchResult'] = $this->searchTimetable($selectedTime, $selectedDay);
        }
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
    
    public function searchTimetable($day, $time) {
        $result1 = $this->timetables->getClassByTimeslot($time, $day);
        $result2 = $this->timetables->getClassByTimeslot($time, $day);
        $result3 = $this->timetables->getClassByDay($time, $day);
        
        if($result1 == $result2 && $result2 == $result3)
        {
            if($result1 != null)
            {
                return "bingo" . " - " . $result1;
            }
            else
            {
              return "you have no classes at this time";
            }
            
        }
        else
        {
            return "timetable missmatch:" .
                    'fasset1: ' . $result1 .
                    'fasset2: ' . $result2 .
                    'fasset3: ' . $result3;
        }
            
    }
}
