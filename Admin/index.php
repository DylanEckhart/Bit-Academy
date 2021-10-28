<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="Admin_style.css">
    <title>Previous Plannings</title>
    <link rel="icon" href="../Images/icon/favicon.ico" type="image/icon">
</head>
<body>
<?php
require_once "../Template/header.php";
?>

<!--select option for admin to choose student/employee-->
    <form id="formAdmin">
        <label class="labelName">Division</label>
        <select class="select">
            <option>Division 1</option>
            <option>Division 2</option>
            <option>Division 3</option>
            <option>Division 4</option>
        </select>
        <label class="labelName">Employee</label>
            <select class="select">
                <option>Employee 1</option>
                <option>Employee 2</option>
                <option>Employee 3</option>
                <option>Employee 4</option>
            </select>
        <button type="button">Submit</button>
    </form>

<!--pre-plannings of the employee-->
<div id="PrePlanning">
    <h1 id="pagetitle">Previous Plannings</h1>
    <div id="PlanningGrid">
        <div class="GridItem">
            <ul class="ticketList">
                <li><p class="ticket_title">PHP</p></li>
                <li><p class="ticket_desc">- Web - 5 hours</p></li>
            </ul>
            <p>Date</p>
            <p>26-10-2021</p>
            <p>Start time:</p>
            <p>09:30</p>
            <p>Stop time:</p>
            <p>16:30</p>
        </div>

        <div class="GridItem">
            <ul class="ticketList">
                <li><p class="ticket_title">PHP</p></li>
                <li><p class="ticket_desc">- Web - 5 hours</p></li>
            </ul>
            <p>Date</p>
            <p>26-10-2021</p>
            <p>Start time:</p>
            <p>09:30</p>
            <p>Stop time:</p>
            <p>16:30</p>
        </div>

        <div class="GridItem">
            <ul class="ticketList">
                <li><p class="ticket_title">PHP</p></li>
                <li><p class="ticket_desc">- Web - 5 hours</p></li>
            </ul>
            <p>Date</p>
            <p>26-10-2021</p>
            <p>Start time:</p>
            <p>09:30</p>
            <p>Stop time:</p>
            <p>16:30</p>
        </div>

        <div class="GridItem">
            <ul class="ticketList">
                <li><p class="ticket_title">PHP</p></li>
                <li><p class="ticket_desc">- Web - 5 hours</p></li>
            </ul>
            <p>Date</p>
            <p>26-10-2021</p>
            <p>Start time:</p>
            <p>09:30</p>
            <p>Stop time:</p>
            <p>16:30</p>
        </div>

        <div class="GridItem">
            <ul class="ticketList">
                <li><p class="ticket_title">PHP</p></li>
                <li><p class="ticket_desc">- Web - 5 hours</p></li>
            </ul>
            <p>Date</p>
            <p>26-10-2021</p>
            <p>Start time:</p>
            <p>09:30</p>
            <p>Stop time:</p>
            <p>16:30</p>
        </div>

        <div class="GridItem">
            <ul class="ticketList">
                <li><p class="ticket_title">PHP</p></li>
                <li><p class="ticket_desc">- Web - 5 hours</p></li>
            </ul>
            <p>Date</p>
            <p>26-10-2021</p>
            <p>Start time:</p>
            <p>09:30</p>
            <p>Stop time:</p>
            <p>16:30</p>
        </div>

        <div class="GridItem">
            <ul class="ticketList">
                <li><p class="ticket_title">PHP</p></li>
                <li><p class="ticket_desc">- Web - 5 hours</p></li>
            </ul>
            <p>Date</p>
            <p>26-10-2021</p>
            <p>Start time:</p>
            <p>09:30</p>
            <p>Stop time:</p>
            <p>16:30</p>
        </div>

        <div class="GridItem">
            <ul class="ticketList">
                <li><p class="ticket_title">PHP</p></li>
                <li><p class="ticket_desc">- Web - 5 hours</p></li>
            </ul>
            <p>Date</p>
            <p>26-10-2021</p>
            <p>Start time:</p>
            <p>09:30</p>
            <p>Stop time:</p>
            <p>16:30</p>
        </div>

        <div class="GridItem">
            <ul class="ticketList">
                <li><p class="ticket_title">PHP</p></li>
                <li><p class="ticket_desc">- Web - 5 hours</p></li>
            </ul>
            <p>Date</p>
            <p>26-10-2021</p>
            <p>Start time:</p>
            <p>09:30</p>
            <p>Stop time:</p>
            <p>16:30</p>
        </div>
    </div>
</div>
</body>
</html>