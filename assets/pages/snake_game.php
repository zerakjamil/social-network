
<div class="container" style="display:flex; justify-content:center; align-items:center; margin-top:20px;">
    <div class="wrapper">
      <div class="game-details">
        <span class="score"> خاڵەکانت : 0 </span>
        <span class="high-score">بەرزترین خاڵت : 0 </span>
      </div>
      <div class="play-board"></div>
      <div class="controls">
        <i data-key="ArrowLeft" class="bi bi-arrow-left"></i>
        <i data-key="ArrowUp" class="bi bi-arrow-up"></i>
        <i data-key="ArrowRight" class="bi bi-arrow-right"></i>
        <i data-key="ArrowDown" class="bi bi-arrow-down"></i>
      </div>
    </div>
    </div>

<style>

.wrapper {
  width: 100vmin;
  height: 80vmin;
  display: flex;
  overflow: hidden;
  flex-direction: column;
  justify-content: center;
  border-radius: 10px;
  background: #293447;
  box-shadow: 0 20px 40px rgba(52, 87, 220, 0.2);
}
@media screen and (max-width: 994px) {
  .wrapper {
  width: 100vmin;
  height: 100vmin;
  display: flex;
  overflow: hidden;
  flex-direction: column;
  justify-content: center;
  border-radius: 5px;
  background: #293447;
  box-shadow: 0 20px 40px rgba(52, 87, 220, 0.2);
}
}
.game-details {
  color: #B8C6DC;
  font-weight: 500;
  font-size: 1.2rem;
  padding: 20px 27px;
  display: flex;
  justify-content: space-between;
}
.play-board {
  height: 100%;
  width: 100%;
  display: grid;
  background: #212837;
  grid-template: repeat(30, 1fr) / repeat(30, 1fr);
}
.play-board .food {
  background: greenyellow;
}
.play-board .head {
  background: #60CBFF;
}

.controls {
  display: none;
  justify-content: space-between;
}
.controls i {
  padding: 25px 0;
  text-align: center;
  font-size: 1.3rem;
  color: #B8C6DC;
  width: calc(100% / 4);
  cursor: pointer;
  border-right: 1px solid #171B26;
}

@media screen and (max-width: 800px) {
  .wrapper {
    width: 90vmin;
    height: 115vmin;
  }
  .game-details {
    font-size: 1rem;
    padding: 15px 27px;
  }
  .controls {
    display: flex;
  }
  .controls i {
    padding: 15px 0;
    font-size: 1rem;
  }
}
</style>
<script>
  const playBoard = document.querySelector(".play-board");
const scoreElement = document.querySelector(".score");
const highScoreElement = document.querySelector(".high-score");
const controls = document.querySelectorAll(".controls i");

let gameOver = false;
let foodX, foodY;
let snakeX = 5, snakeY = 5;
let velocityX = 0, velocityY = 0;
let snakeBody = [];
let setIntervalId;
let score = 0;

// Getting high score from the local storage
let highScore = localStorage.getItem("high-score") || 0;
highScoreElement.innerText = `بەرزترین خاڵت : ${highScore}`;

const updateFoodPosition = () => {
    // Passing a random 1 - 30 value as food position
    foodX = Math.floor(Math.random() * 30) + 1;
    foodY = Math.floor(Math.random() * 30) + 1;
}

const handleGameOver = () => {
    // Clearing the timer and reloading the page on game over
    clearInterval(setIntervalId);
    alert("یاریەکە کۆتایی هات! گرتە لە ok بکە بۆ دووبارە کردنەوە...");
    location.reload();
}

const changeDirection = e => {
    // Changing velocity value based on key press
    if(e.key === "ArrowUp" && velocityY != 1) {
        velocityX = 0;
        velocityY = -1;
    } else if(e.key === "ArrowDown" && velocityY != -1) {
        velocityX = 0;
        velocityY = 1;
    } else if(e.key === "ArrowLeft" && velocityX != 1) {
        velocityX = -1;
        velocityY = 0;
    } else if(e.key === "ArrowRight" && velocityX != -1) {
        velocityX = 1;
        velocityY = 0;
    }
}

// Calling changeDirection on each key click and passing key dataset value as an object
controls.forEach(button => button.addEventListener("click", () => changeDirection({ key: button.dataset.key })));

const initGame = () => {
    if(gameOver) return handleGameOver();
    let html = `<div class="food" style="grid-area: ${foodY} / ${foodX}"></div>`;

    // Checking if the snake hit the food
    if(snakeX === foodX && snakeY === foodY) {
        updateFoodPosition();
        snakeBody.push([foodY, foodX]); // Pushing food position to snake body array
        score++; // increment score by 1
        highScore = score >= highScore ? score : highScore;
        localStorage.setItem("high-score", highScore);
        scoreElement.innerText = `خاڵەکانت : ${score}`;
        highScoreElement.innerText = `بەرزترین خاڵت: ${highScore}`;
    }
    // Updating the snake's head position based on the current velocity
    snakeX += velocityX;
    snakeY += velocityY;
    
    // Shifting forward the values of the elements in the snake body by one
    for (let i = snakeBody.length - 1; i > 0; i--) {
        snakeBody[i] = snakeBody[i - 1];
    }
    snakeBody[0] = [snakeX, snakeY]; // Setting first element of snake body to current snake position

    // Checking if the snake's head is out of wall, if so setting gameOver to true
    if(snakeX <= 0 || snakeX > 30 || snakeY <= 0 || snakeY > 30) {
        return gameOver = true;
    }

    for (let i = 0; i < snakeBody.length; i++) {
        // Adding a div for each part of the snake's body
        html += `<div class="head" style="grid-area: ${snakeBody[i][1]} / ${snakeBody[i][0]}"></div>`;
        // Checking if the snake head hit the body, if so set gameOver to true
        if (i !== 0 && snakeBody[0][1] === snakeBody[i][1] && snakeBody[0][0] === snakeBody[i][0]) {
            gameOver = true;
        }
    }
    playBoard.innerHTML = html;
}

updateFoodPosition();
setIntervalId = setInterval(initGame, 100);
document.addEventListener("keyup", changeDirection);
</script>