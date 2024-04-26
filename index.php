<!doctype html>
<html lang="fa"
      style="min-height: 100vh; background: url('video.gif') no-repeat;background-size: cover;padding: 15px">
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
<div id="container" style="width: 300px;height: 555px;margin: 50px auto 0;padding: 15px;position: relative;">
    <div id="reset-game" class=""
         style="overflow: hidden;width: 208px;position: relative;box-shadow: 1px 7px 15px #000;margin-bottom: 25px">
        <canvas id="game-board" width="200" height="400" style="border: 3px solid #fff;overflow: hidden"></canvas>
    </div>
    <canvas id="next"
            style="border: 1px solid #ffffff;position: absolute; top: 20px;right: 15px;box-shadow: 1px 7px 15px #000;"
            width="80"
            height="80"></canvas>
    <div style="width: 80px;height: 50px;border: 1px solid #ffffff;position: absolute; top: 120px;right: 15px;box-shadow: 1px 7px 15px #000;">
        <span style="display: inline-block;height: 20px;width: 100%;background: #3498db;color: #fff;text-align: center">Score</span>
        <span id="score" style="text-align: center;color: #fff;width: 100%;display: block;padding-top: 5px;">0</span>
    </div>
    <div style="width: 80px;height: 50px;border: 1px solid #ffffff;position: absolute; top: 220px;right: 15px;box-shadow: 1px 7px 15px #000;">
        <span style="display: inline-block;height: 20px;width: 100%;background: #3498db;color: #fff;text-align: center">Level</span>
        <span id="level" style="text-align: center;color: #fff;width: 100%;display: block;padding-top: 5px">1</span>
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
             style="display: flex;justify-content: center;row-gap: 10px;flex-wrap: wrap;color: #fff;font-size: 1.1em;position: relative;text-align: center">
            <div>
                <i class="bi bi-circle-fill start-button" onclick=" startGame()"></i>
                <span style="display: inline-block;width: 100%">Start(S)</span>
            </div>
            <div>
                <i class="bi bi-circle-fill pause-button" onclick=" pause()"></i>
                <span style="display: inline-block;width: 100%">Pause(P)</span>

            </div>
            <div>
                <i class="bi bi-circle-fill reset-game-button" onclick="resetGame()"></i>
                <span style="display: inline-block;width: 100%">Reset(R)</span>

            </div>
            <div>
                <i class="bi bi-circle-fill reset-game-button" style="font-size: 3em" onclick="dropDown()"></i>
                <span style="display: inline-block;width: 100%">DropDown(space)</span>
            </div>
        </div>
    </div>
</div>
</body>
<script src="tetromino.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/swiped-events/1.1.9/swiped-events.min.js"
        integrity="sha512-Km1M9MRIhy+uzmSn7MU2G0fQawFMpfpScHpf0UUvcpkGJCJhwlTRF/mbTUimo1N9woYZ5RLES7iL+kp65Q1d0Q=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="tetris.js"></script>

</html>
