<!doctype html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
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
</div>
<script src="tetris.js"></script>
</body>
</html>