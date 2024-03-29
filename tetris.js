let canvas = document.getElementById('game-board')
let ctx = canvas.getContext("2d")

const sq = 20;
const row = 20
const column = 10
const vacant = "black"
let gameOver = true;
let gameLevelElement = document.getElementById('level')
let level = parseInt(gameLevelElement.innerHTML)
let scoreElement = document.getElementById('score')
let score = parseInt(scoreElement.innerHTML)
let next = document.getElementById('next')
let nextCTX = next.getContext('2d');
let board = []
let p;
let nextP;
let intervalId

function drawSquare(x, y, color, board = ctx) {
    board.fillStyle = color;
    board.fillRect(x * sq, y * sq, sq, sq);
    board.strokeStyle = "white";
    board.strokeRect(x * sq, y * sq, sq, sq);
}

// Draw Game Board
function drawBoard() {
    for (let i = row; i >= 0; i--) {
        for (let j = column; j >= 0; j--) {
            drawSquare(j, i, board[i][j]);
        }
    }
}


function clearBoard() {
    for (let i = row; i >= 0; i--) {
        board[i] = [];
        for (let j = column; j >= 0; j--) {
            board[i][j] = vacant;
        }
    }
}

clearBoard()
drawBoard()

// the pieces and their colors
const PIECES = [[Z, "#487eb0"], [S, "#2ecc71"], [T, "#f1c40f"], [O, "#2980b9"], [L, "#ecf0f1"], [I, "#44bd32"], [J, "#e67e22"]];

// generate random pieces
function randomPiece() {
    let r = Math.floor(Math.random() * PIECES.length)
    return new Piece(PIECES[r][0], PIECES[r][1])
}


function Piece(tetromino, color) {
    this.tetromino = tetromino
    this.tetrominoN = 0
    this.color = color
    this.activeTetromino = this.tetromino[this.tetrominoN]
    this.x = 3
    this.y = -2

}

Piece.prototype.fill = function (color, board = ctx) {
    for (let r = this.activeTetromino.length - 1; r >= 0; r--) {
        for (let c = this.activeTetromino.length - 1; c >= 0; c--) {
            if (this.activeTetromino[r][c]) {
                drawSquare(this.x + c, this.y + r, color, board)
            }
        }
    }
}
// draw a piece to the board

Piece.prototype.draw = function (board = ctx) {
    this.fill(this.color, board);
}

// undraw a piece


Piece.prototype.unDraw = function () {
    this.fill(vacant);
}

Piece.prototype.collision = function (x, y, piece) {
    for (let r = piece.length - 1; r >= 0; r--) {
        for (let c = piece.length - 1; c >= 0; c--) {
            // if the square is empty, we skip it
            if (!piece[r][c]) {
                continue;
            }
            // coordinates of the piece after movement
            let newX = this.x + c + x;
            let newY = this.y + r + y;
            // conditions
            if (newX < 0 || newX >= column || newY >= row) {
                return true;
            }
            // skip newY < 0; board[-1] will crush our game
            if (newY < 0) {
                continue;
            }
            // check if there is a locked piece already in place
            if (board[newY][newX] !== vacant) {
                return true
            }
        }
    }
    return false
}
// move Right the piece
Piece.prototype.moveRight = function () {
    if (!this.collision(1, 0, this.activeTetromino)) {
        this.unDraw();
        this.x++;
        this.draw();
    }
}
// move Down the piece
Piece.prototype.moveDown = function () {
    if (!this.collision(0, 1, this.activeTetromino)) {
        this.unDraw()
        this.y++;
        this.draw();
    } else {
        // we lock the piece and generate a new one
        this.lock();
        p = nextP;
        nextP = randomPiece();
        showNext()
    }
}

// move left the piece
Piece.prototype.moveLeft = function () {
    if (!this.collision(-1, 0, this.activeTetromino)) {
        this.unDraw();
        this.x--;
        this.draw();
    }
}
// move right the piece
Piece.prototype.moveRight = function () {
    if (!this.collision(1, 0, this.activeTetromino)) {
        this.unDraw();
        this.x++;
        this.draw();
    }
}

Piece.prototype.rotate = function () {
    let nextPattern = this.tetromino[(this.tetrominoN + 1) % this.tetromino.length];
    let kick = 0
    if (this.collision(0, 0, nextPattern)) {
        if (this.x > column / 2) {
            kick = -1
        } else {
            kick = 1
        }
    }
    if (!this.collision(kick, 0, nextPattern)) {
        this.unDraw()
        this.x += kick
        this.tetrominoN = (this.tetrominoN + 1) % this.tetromino.length
        this.activeTetromino = this.tetromino[this.tetrominoN]
        this.draw()
    }
}

Piece.prototype.lock = function () {
    for (let r = this.activeTetromino.length - 1; r >= 0; r--) {
        for (let c = this.activeTetromino.length - 1; c >= 0; c--) {
            if (!this.activeTetromino[r][c]) {
                continue;
            }
            if (this.y + r < 0) {
                gameOver = true;
                alert('Game Over');
                score = 0;
                scoreElement.innerHTML = score;
                clearBoard()
                clearInterval(intervalId)
                break
            }
            board[this.y + r][this.x + c] = this.color;
        }
    }
    removeRow()
    drawBoard()
}
// CONTROL the piece

document.addEventListener("keydown", CONTROL);

function CONTROL(event) {
    if (event.code === "ArrowLeft") {
        if (!gameOver) {
            p.moveLeft();
        } else {
            if (level === 1) {
                level = 5
            } else {
                level -= 1
            }
            gameLevelElement.innerHTML = level
        }
    } else if (event.code === "ArrowUp") {
        if (!gameOver) {
            p.rotate();
        }
    } else if (event.code === "ArrowRight") {
        if (!gameOver) {
            p.moveRight();
        } else {
            if (level === 5) {
                level = 1
            } else {
                level += 1
            }
            gameLevelElement.innerHTML = level

        }
    } else if (event.code === "ArrowDown") {
        if (!gameOver) {
            p.moveDown();
        }
    } else if (event.code === "KeyP") {
        pause()
    } else if (event.code === 'KeyR') {
        resetGame()
    } else if (event.code === 'KeyS') {
        startGame();
    }
}

function pause() {
    if (!intervalId) {
        drop()
    } else {
        clearInterval(intervalId)
        intervalId = false
    }
}

function resetGame() {
    if (!gameOver) {

        clearInterval(intervalId)
        document.getElementById('reset-game').classList.add('active')
        setTimeout(() => document.getElementById('reset-game').classList.remove('active'), 5000)
        setTimeout(() => {
            score = 0;
            scoreElement.innerHTML = score;
            nextCTX.clearRect(0, 0, next.width, next.height)
            clearBoard();
            drawBoard();
            gameOver = true
        }, 2500)
    }
}

function removeRow() {
    for (let r = 0; r < row; r++) {
        let f = 0;

        for (let c = column; c >= 0; c--) {
            if (board[r][c] !== vacant) {
                f++;
            }
        }
        if (f === column) {
            f = 0
            for (let y = r; y > 1; y--) {
                for (let c = column; c >= 0; c--) {
                    board[y][c] = board[y - 1][c];
                }
            }
            for (let c = column; c >= 0; c--) {
                board[0][c] = vacant;
            }
            score += column;

        }
    }
    scoreElement.innerHTML = score
}

function drop() {
    if (!gameOver) {
        intervalId = setInterval(() => p.moveDown(), 1000 / level)
    }
}


function startGame() {
    if (gameOver === true) {
        p = randomPiece();
        nextP = randomPiece();
        showNext()
        gameOver = false;
        drop();
    }
}


function showNext() {
    nextCTX.clearRect(0, 0, next.width, next.height);
    for (let x = nextP.activeTetromino.length - 1; x >= 0; x--) {
        for (let y = nextP.activeTetromino.length - 1; y >= 0; y--) {
            if (nextP.activeTetromino[y][x]) {
                drawSquare(x, y, nextP.color, nextCTX)
            }
        }
    }
}


