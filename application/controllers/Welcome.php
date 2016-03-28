<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends Application {

    function __construct() {
        parent::__construct();
    }
    
    public function index()
    {
        if($this->input->post('timeSelector') != NULL && $this->input->post('daySelector') != NULL) {
            $selectedTime = $this->input->post('timeSelector');
            $selectedDay = $this->input->post('daySelector');
            print(search(selectedDay, selectedTime));
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
    
    public function search($day, $time) {
        $result1 = $this->timetables->getClassByTimeslot($time, $day);
        $result2 = $this->timetables->getClassByTimeslot($time, $day);
        $result3 = $this->timetables->getClassByDay($time, $day);
        if(count(result1) != count(result2)) {
            return "difference";
        }
        if(count(result2) != count(result3)) {
            return "difference";
        }
        if(count(result1) != count(result3)) {
            return "difference";
        }
        for($i = 0; $i < count(result1); $i++) {
            if(result1[i] != result2[i]) {
                return "difference";
            }
        }
        for($i = 0; $i < count(result1); $i++) {
            if(result2[i] != result3[i]) {
                return "difference";
            }
        }
        for($i = 0; $i < count(result1); $i++) {
            if(result1[i] != result3[i]) {
                return "difference";
            }
        }
        return "bingo";
    }
}
