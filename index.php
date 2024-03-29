<!doctype html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Tetris Game</title>
</head>
<body>
<div id="container">
    style="overflow: hidden;width: 208px;position: relative;box-shadow: 1px 7px 15px #000;">
    <canvas id="game-board" width="200" height="400"></canvas>
    <canvas id="next"
            width="80"
            height="80"></canvas>
    <div id="score-div">
        <span style="display: inline-block;height: 20px;background: #3498db;">Score</span>
        <span id="score" style="display: block;padding-top: 5px;">0</span>
    </div>
    <div id="level-div">
        <span style="display: inline-block;height: 20px;background: #3498db;">Level</span>
        <span id="level" style="display: block;padding-top: 5px;">1</span>
    </div>
    <div id="controllers">
        <div class="right" style="float: right;color: #fff;font-size: 2em;width: 100px">
            <div style="display: inline-block;width: 100px;text-align: center">
                <i class="bi bi-arrow-up-circle-fill control-up" onclick="p.rotate()"></i>
            </div>
            <div style="display: inline-block;">
                <i class="bi bi-arrow-left-circle-fill control-left" style="text-align: left"
                   onclick="p.moveLeft()"></i>

                <i class="bi bi-arrow-right-circle-fill control-right"
                   style="text-align: right;margin-left: 25px" onclick="p.moveRight()"></i>
            </div>
            <div style="display: inline-block;width: 100px;text-align: center">
                <i class="bi bi-arrow-down-circle-fill control-down" onclick="p.moveDown()"></i>
            </div>
        </div>
        <div class="left"
             style="display: inline-block;margin-top: 20px;color: #fff;font-size: 1.1em;position: relative;text-align: center">
            <div>
                <i class="bi bi-circle-fill start-button" style="margin-right: 25px" onclick=" startGame()"></i>
                <i class="bi bi-circle-fill pause-button" style="margin-right: 25px" onclick=" pause()"></i>
                <i class="bi bi-circle-fill reset-game-button" onclick="resetGame()"></i>
            </div>
            <div>
                <span>Start(S)</span>
                <span>Pause(P)</span>
                <span>Reset(R)</span>
            </div>
        </div>
    </div>
</div>
<script src="tetris.js"></script>
</body>
</html>