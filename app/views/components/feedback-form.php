<?php

echo "
<div id='feedback-form-overlay' onclick='hideFeedbackForm(this)'>
    <div id='feedback-form-container'>
        <h1 id='feedback-form-title'>Project: Project title</h1>
        <h2 id='feedback-form-task'>Task: Task title</h1>

        <form id='feedback-form'>
            <label for='feedback-notes'>Feedback</label>
            <textarea id='feedback-notes'></textarea>
            <button type='button' name='give-feedback'>Give Feedback</button>
        </form>
    </div>
</div>";
