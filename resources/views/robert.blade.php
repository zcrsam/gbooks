<?php
// robert_frost.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Robert Frost Interactive Notebook</title>

<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@300;400&display=swap" rel="stylesheet">

<style>
body {
    margin: 0;
    padding: 0;
    font-family: 'Cormorant Garamond', serif;
    background: #f2e9e1;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    overflow: hidden;
}

.notebook {
    width: 900px;
    height: 600px;
    display: flex;
    perspective: 2000px;
    position: relative;
    box-shadow: 0 15px 30px rgba(0,0,0,0.3);
}

.page {
    width: 50%;
    height: 100%;
    position: relative;
    transform-style: preserve-3d;
    cursor: pointer;
    transform-origin: bottom center;
    transition: transform 1s cubic-bezier(0.68, -0.55, 0.27, 1.55);
}

.page.flipped {
    transform: rotateX(-180deg); /* flip upward */
}

.front, .back {
    position: absolute;
    width: 100%;
    height: 100%;
    background: #fff8e7;
    border: 1px solid #d4b483;
    box-shadow: inset 0 0 10px rgba(0,0,0,0.1);
    display: flex;
    flex-direction: column;
    justify-content: flex-start;
    padding: 30px 20px;
    backface-visibility: hidden;
    background-image: repeating-linear-gradient(
        to bottom,
        transparent,
        transparent 24px,
        rgba(0,0,0,0.05) 25px
    ); /* horizontal notebook lines */
}

.back {
    transform: rotateX(180deg); /* back upright after flip */
}

.mini-game {
    margin-top: 20px;
    padding: 15px;
    background-color: #fff1d6;
    border-radius: 5px;
    box-shadow: inset 0 0 5px rgba(0,0,0,0.1);
}

.mini-game input[type="text"] {
    padding: 5px;
    font-size: 16px;
    width: 80%;
    margin-right: 10px;
}

.mini-game button {
    padding: 5px 10px;
    font-size: 16px;
    cursor: pointer;
    background-color: #d4b483;
    border: none;
    border-radius: 5px;
    transition: all 0.3s ease;
}

.mini-game button:hover {
    background-color: #c19968;
}

.feedback {
    margin-top: 10px;
    font-weight: bold;
}

.spine {
    width: 10px;
    background: #b08b57;
    position: absolute;
    left: 50%;
    top: 0;
    height: 100%;
    z-index: 10;
}

.back-btn {
    position: fixed;
    top: 10px;
    left: 10px;
    padding: 8px 15px;
    font-size: 14px;
    background-color: #d4b483;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    z-index: 100;
    transition: all 0.3s ease;
}

.back-btn:hover {
    background-color: #c19968;
}
</style>
</head>
<body>

<audio id="flipSound" src="https://www.soundjay.com/books/page-flip-1.mp3"></audio>

<button class="back-btn" onclick="goBack()">Back</button>

<div class="notebook">
    <!-- Left Page -->
    <div class="page" id="leftPage" onclick="flipPage('left')">
        <div class="front">
            <h2>On a Snowy Evening</h2>
            <p>Click the page to flip upwards</p>
        </div>
        <div class="back">
            <h2>On a Snowy Evening</h2>
            <p>
                Whose woods these are I think I know.<br>
                His house is in the village though;<br>
                He will not see me stopping here<br>
                To watch his woods fill up with snow.
            </p>
            <div class="mini-game">
                <p>Fill in the blank:</p>
                <p>"He will not see me stopping ___"</p>
                <input type="text" id="leftAnswer" placeholder="Type your answer here">
                <button onclick="checkLeftAnswer()">Check</button>
                <div class="feedback" id="leftFeedback"></div>
            </div>
        </div>
    </div>

    <div class="spine"></div>

    <!-- Right Page -->
    <div class="page" id="rightPage" onclick="flipPage('right')">
        <div class="front">
            <h2>The Road Not Taken</h2>
            <p>Click the page to flip upwards</p>
        </div>
        <div class="back">
            <h2>The Road Not Taken</h2>
            <p>
                Two roads diverged in a yellow wood,<br>
                And sorry I could not travel both<br>
                And be one traveler, long I stood<br>
                And looked down one as far as I could
            </p>
            <div class="mini-game">
                <p>Choose the correct meaning of the line:</p>
                <p>"Two roads diverged in a yellow wood"</p>
                <button onclick="checkRightAnswer(this, true)">A choice between two paths in life</button><br>
                <button onclick="checkRightAnswer(this, false)">Confusion in the forest</button><br>
                <button onclick="checkRightAnswer(this, false)">A literal road construction</button>
                <div class="feedback" id="rightFeedback"></div>
            </div>
        </div>
    </div>
</div>

<script>
let flippedPages = { left: false, right: false };

function flipPage(side) {
    const sound = document.getElementById('flipSound');
    sound.play();
    const page = document.getElementById(side + 'Page');

    // Toggle flip
    flippedPages[side] = !flippedPages[side];
    if(flippedPages[side]) {
        page.classList.add('flipped');
    } else {
        page.classList.remove('flipped');
    }
}

function resetPages() {
    flippedPages = { left: false, right: false };
    document.getElementById('leftPage').classList.remove('flipped');
    document.getElementById('rightPage').classList.remove('flipped');
    document.getElementById('leftFeedback').textContent = "";
    document.getElementById('rightFeedback').textContent = "";
    document.getElementById('leftAnswer').value = "";
}

function goBack() {
    resetPages();
    window.location.href = '/homeprojects';
}

// Mini-games
function checkLeftAnswer() {
    const answer = document.getElementById('leftAnswer').value.trim().toLowerCase();
    const feedback = document.getElementById('leftFeedback');
    feedback.style.color = (answer === "here") ? "green" : "red";
    feedback.textContent = (answer === "here") ? "Correct! 🎉" : "Try again!";
}

function checkRightAnswer(button, correct) {
    const feedback = document.getElementById('rightFeedback');
    feedback.style.color = correct ? "green" : "red";
    feedback.textContent = correct ? "Correct! 🎉" : "Incorrect, try another choice!";
}
</script>

</body>
</html>
