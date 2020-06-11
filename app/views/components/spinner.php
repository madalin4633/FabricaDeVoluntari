<?php

/**
 * https://tobiasahlin.com/spinkit/
 * 
 * How to use:
 * 
 * ######## Add in view (.php): ########
 *      require __DIR__ . '/components/spinner.php';
 *  (as the first child of the container that is to be blured while spinning)
 * 
 * ######## Add in js: ########
 *     // start spinner
 *           if (!<taskContainer>.classList.contains("pending"))
 *           <taskContainer>.classList.add("pending");
 * 
 *     // stop spinner
 *           if (<taskContainer>.classList.contains("pending"))
 *           <taskContainer>.classList.remove("pending");
 * 
 * ######## Add in CSS: ########
 * .pending .sk-chase-container {
 *   display: flex;
 * }
 * 
 * Add other rules in CSS to block user input, if necessary:
 * .pending <whatever> {
 *      e.g. pointer-events: none;
 * }
 */

echo "<div class='sk-chase-container'><div class='sk-chase'>
                        <div class='sk-chase-dot'></div>
                        <div class='sk-chase-dot'></div>
                        <div class='sk-chase-dot'></div>
                        <div class='sk-chase-dot'></div>
                        <div class='sk-chase-dot'></div>
                        <div class='sk-chase-dot'></div>
                      </div></div>";
