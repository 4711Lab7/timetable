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
    <form id="dayForm" action="/" method="post">   
    <select name="timeSelector">
              <option disabled selected>Select Day</option>
        {dayList}
            <option value={Name}>{Name}</option>
        {/dayList}
    </select>  
    <select name="daySelector">
              <option disabled selected>Select Time</option>
        {timeList}
            <option value={timeValue}>{timeValue}</option>
        {/timeList}
    </select> 
    <input type="submit" value="Submit">
    </form>
    
    <h2>{searchResult}</h2>
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