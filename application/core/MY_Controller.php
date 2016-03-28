<?php

class Application extends CI_Controller {
    protected $data = array();      // parameters for view components
    protected $id;                  // identifier for our content
    /**
     * Constructor.
     * Establish view parameters & load common helpers
     */
    function __construct() {
        parent::__construct();
        $this->data = array();
        $this->data['title'] = "Timetable";
        $this->errors = array();
        $this->data['pageTitle'] = 'welcome';
    }
    /**
     * Render this page
     */
    function render() {
        $this->data['content'] = $this->parser->parse($this->data['pagebody'], $this->data, true);

        $this->parser->parse('_template', $this->data);
    }
}

