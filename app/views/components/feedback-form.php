<?php

echo "
<div id='feedback-form-overlay'>
    <div id='feedback-form-container'>";
    require __DIR__ . '/spinner.php';

       echo "<h1 id='feedback-form-title'>Project: Project title</h1>
        <h2 data-task-id='' id='feedback-form-task'>Task: Task title</h1>

        <form id='feedback-form'>
            <label for='feedback-notes'>Feedback</label>
            <textarea id='feedback-notes'></textarea>
            <button id='btnGiveFeedback' type='button' name='give-feedback'>Give Feedback</button>
        </form>
    </div>
</div>";
