<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Lab 8 - Timetable</title>
</head>
<body>

<div id="container">
    <h1>Lab 8</h1>
    <form id="dayForm" action="/welcome" method="post">   
    <select name="timeSelector" onchange='if((this.value !== undefined) && (timeForm.value !== undefined)) { this.form.submit(); }'>
              <option disabled selected>Select Day</option>
        {dayList}
            <option value={Code}>{Name}</option>
        {/dayList}
    </select> 
    </form>
    <form id="timeForm" action="/welcome" method="post">   
    <select name="daySelector" onchange='if((this.value !== undefined) && (dayForm.value !== undefined)) { this.form.submit(); }'>
              <option disabled selected>Select Time</option>
        {timeList}
            <option value={Code}>{timeValue}</option>
        {/timeList}
    </select> 
    </form>
    <h2>Time View</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Location</th>
                <th>Day</th>
                <th>Course</th>
                <th>Instructor</th>
                <th>End</th>
                <th>Start</th>
             </tr>
        </thead>
        <tbody>
            {time}
                <tr>
                    <td>{Location}</td>
                    <td>{Day}</td>
                    <td>{Course}</td>
                    <td>{Instructor}</td>
                    <td>{End}</td>
                    <td>{Start}</td>
                </tr>
            {/time}
        </tbody>
     </table>
    <h2>Day View</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Location</th>
                <th>Day</th>
                <th>Course</th>
                <th>Instructor</th>
                <th>End</th>
                <th>Start</th>
             </tr>
        </thead>
        <tbody>
            {day}
                <tr>
                    <td>{Location}</td>
                    <td>{Day}</td>
                    <td>{Course}</td>
                    <td>{Instructor}</td>
                    <td>{End}</td>
                    <td>{Start}</td>
                </tr>
            {/day}
        </tbody>
     </table>
    <h2>Course View</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Location</th>
                <th>Day</th>
                <th>Course</th>
                <th>Instructor</th>
                <th>End</th>
                <th>Start</th>
             </tr>
        </thead>
        <tbody>
            {course}
                <tr>
                    <td>{Location}</td>
                    <td>{Day}</td>
                    <td>{Course}</td>
                    <td>{Instructor}</td>
                    <td>{End}</td>
                    <td>{Start}</td>
                </tr>
            {/course}
        </tbody>
     </table>
</div>

</body>
</html>