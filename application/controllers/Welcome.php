<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

    public function index()
    {
        
        $timeslot = $this->timetables->getTimeslot('830');
        
       /*
        foreach ($timeslot as $record)
        {
            echo($record->start);
            echo($record->end);
            echo($record->course);
            
        }
         */
       print_r($this->timetables->getTimeslot('930'));
       //print_r($this->timetables->allTimeslots());
        $this->load->view('welcome_message');
    }
}
