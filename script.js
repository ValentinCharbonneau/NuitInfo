const SCALE = 1;
const WIDTH = 48;
const HEIGHT = 96;
const SCALED_WIDTH = SCALE * WIDTH;
const SCALED_HEIGHT = SCALE * HEIGHT;
const UP_CYCLE_LOOP = [6, 7, 9, 9, 10, 11];
const DOWN_CYCLE_LOOP = [18, 19, 20, 21, 22, 23];
const LEFT_CYCLE_LOOP = [12, 13, 14, 15, 16, 17];
const RIGHT_CYCLE_LOOP = [0, 1, 2, 3, 4, 5];
const FACING_DOWN = 2;
const FACING_UP = 2;
const FACING_LEFT = 2;
const FACING_RIGHT = 2;
const FRAME_LIMIT = 12;
const MOVEMENT_SPEED = 1;

let canvas = document.querySelector('canvas');
let ctx = canvas.getContext("2d");
let keyPresses = {};
let currentDirection = FACING_DOWN;
let currentLoopIndex = 0;
let frameCount = 0;
let positionX = 0;
let positionY = 0;
let img = new Image();
let map = new Image();
map.src = "./map.png";

window.addEventListener('keydown', keyDownListener);
function keyDownListener(event) {
    keyPresses[event.key] = true;
}

window.addEventListener('keyup', keyUpListener);
function keyUpListener(event) {
    keyPresses[event.key] = false;
}

function loadImage() {
    img.src = './img/test0.png';
    img.onload = function() {
        window.requestAnimationFrame(gameLoop);
    };
}

function drawFrame(frameX, frameY, canvasX, canvasY) {
    ctx.drawImage(img,
        frameX * WIDTH, frameY * HEIGHT, WIDTH, HEIGHT,
        canvasX, canvasY, SCALED_WIDTH, SCALED_HEIGHT);

}

loadImage();

function gameLoop() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    let cycleloop = DOWN_CYCLE_LOOP;
    ctx.drawImage(map, 0, 0, 720, 480);

    let hasMoved = false;

    if (keyPresses.z) {
        moveCharacter(0, -MOVEMENT_SPEED, FACING_UP);
        cycleloop = UP_CYCLE_LOOP;

        hasMoved = true;
    } else if (keyPresses.s) {
        cycleloop = DOWN_CYCLE_LOOP;
        moveCharacter(0, MOVEMENT_SPEED, FACING_DOWN);
        hasMoved = true;
    }

    if (keyPresses.q) {
        cycleloop = LEFT_CYCLE_LOOP;
        moveCharacter(-MOVEMENT_SPEED, 0, FACING_LEFT);
        hasMoved = true;
    } else if (keyPresses.d) {
        cycleloop = RIGHT_CYCLE_LOOP;
        moveCharacter(MOVEMENT_SPEED, 0, FACING_RIGHT);
        hasMoved = true;
    }

        frameCount++;
        if (frameCount >= FRAME_LIMIT) {
            frameCount = 0;
            currentLoopIndex++;
            if (currentLoopIndex >= cycleloop.length) {
                currentLoopIndex = 0;
            }
        }

    if (!hasMoved) {
        currentLoopIndex = 0;
    }

    drawFrame(cycleloop[currentLoopIndex], currentDirection, positionX, positionY);
    window.requestAnimationFrame(gameLoop);
}

function moveCharacter(deltaX, deltaY, direction) {

    if (positionX + deltaX > 0 && positionX + SCALED_WIDTH + deltaX < canvas.width) {
        positionX += deltaX;
    }
    if (positionY + deltaY > 0 && positionY + SCALED_HEIGHT + deltaY < canvas.height) {
        positionY += deltaY;
    }
    currentDirection = direction;
}