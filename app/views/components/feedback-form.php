<?php

echo "
<div id='feedback-form-overlay'>
    <div id='feedback-form-container'>";
    require __DIR__ . '/spinner.php';

        echo "<div class='feedback-assoc-icon'
        style=' 
        background-size: cover; background-position: center; background-repeat: no-repeat;'
        ></div>";

       echo "<h1 id='feedback-form-title'>Project: Project title</h1>
        <h2 data-task-id='' id='feedback-form-task'>Task: Task title</h1>

        <form id='feedback-form'>
        <div class='feedback-metric'>
            <div class='metric-name'>harnic</div>
            <span class='feedback-star' data-star='5' onclick='updateFeedbackStar(this)'>☆</span>
            <span class='feedback-star' data-star='4' onclick='updateFeedbackStar(this)'>☆</span>
            <span class='feedback-star' data-star='3' onclick='updateFeedbackStar(this)'>☆</span>
            <span class='feedback-star' data-star='2' onclick='updateFeedbackStar(this)'>☆</span>
            <span class='feedback-star' data-star='1' onclick='updateFeedbackStar(this)'>☆</span>
        </div>
        <div class='feedback-metric'>
            <div class='metric-name'>comunicativ</div>
            <span class='feedback-star' data-star='5' onclick='updateFeedbackStar(this)'>☆</span>
            <span class='feedback-star' data-star='4' onclick='updateFeedbackStar(this)'>☆</span>
            <span class='feedback-star' data-star='3' onclick='updateFeedbackStar(this)'>☆</span>
            <span class='feedback-star' data-star='2' onclick='updateFeedbackStar(this)'>☆</span>
            <span class='feedback-star' data-star='1' onclick='updateFeedbackStar(this)'>☆</span>
        </div>
        <div class='feedback-metric'>
            <div class='metric-name'>disponibil</div>
            <span class='feedback-star' data-star='5' onclick='updateFeedbackStar(this)'>☆</span>
            <span class='feedback-star' data-star='4' onclick='updateFeedbackStar(this)'>☆</span>
            <span class='feedback-star' data-star='3' onclick='updateFeedbackStar(this)'>☆</span>
            <span class='feedback-star' data-star='2' onclick='updateFeedbackStar(this)'>☆</span>
            <span class='feedback-star' data-star='1' onclick='updateFeedbackStar(this)'>☆</span>
        </div>
        <div class='feedback-metric'>
            <div class='metric-name'>punctual</div>
            <span class='feedback-star' data-star='5' onclick='updateFeedbackStar(this)'>☆</span>
            <span class='feedback-star' data-star='4' onclick='updateFeedbackStar(this)'>☆</span>
            <span class='feedback-star' data-star='3' onclick='updateFeedbackStar(this)'>☆</span>
            <span class='feedback-star' data-star='2' onclick='updateFeedbackStar(this)'>☆</span>
            <span class='feedback-star' data-star='1' onclick='updateFeedbackStar(this)'>☆</span>
        </div>
        <div class='feedback-metric'>
            <div class='metric-name'>serios</div>
            <span class='feedback-star' data-star='5' onclick='updateFeedbackStar(this)'>☆</span>
            <span class='feedback-star' data-star='4' onclick='updateFeedbackStar(this)'>☆</span>
            <span class='feedback-star' data-star='3' onclick='updateFeedbackStar(this)'>☆</span>
            <span class='feedback-star' data-star='2' onclick='updateFeedbackStar(this)'>☆</span>
            <span class='feedback-star' data-star='1' onclick='updateFeedbackStar(this)'>☆</span>
        </div>
        <label for='feedback-notes'>Feedback</label>
            <textarea id='feedback-notes'></textarea>
            <button id='btnGiveFeedback' type='button' name='give-feedback'>Give Feedback</button>
        </form>
    </div>
</div>";
