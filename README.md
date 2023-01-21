# European-Competition-2021---Snow-Game
European Competition 2021 - TEST PROJECT -Final version

<h2>Resume</h2>

<h3>Design and layout</h3>
- Colors
- Include the WSPA logo to start & end screens.

![image](https://user-images.githubusercontent.com/82625479/213872246-18930c8c-03d2-42d2-949c-f19cd1675ee3.png)

- run on desktop & mobile
- the Desktop is 1000px x 640px
- on the desktop, controlled via keyboard; on mobile controlled by tooching the screen area

<h3>Assets format</h3>
- use webp or svg for all the images
- 3 sound effects in the game: (Let It Burn - Cold Kingdom or  PvP - Amaranthe :> )
    - Game screen after loading finished.
    - When hitting the projectile.
    - When the game is over.
    
 <h3>Start screen</h3>
- On the first screen, the player needs to enter his/her name and select the 2-letter country code from a list (https://restcountries.eu/).
- the player can upload the projectile image(the upload button or drag and drop); the uploaded image is square.
- Every game played should be stored in a database. Create an API call: /api/start-game, and store all players data from the start screen.

<h3>Loading screen</h3>
- If all the resources loaded I need to show the game (Add loader + cool animation)

<h3>The snowball throwing scene</h3>
- The snowMan 2.0 to throw the projectiles.He is on the left-hand side of the scene and he is throwing projectiles to the right side as far as he can.
- For each game session, there are 3 projectiles for the player to throw. After each throw, the projectile rests on the destination as an indicator. 
- The user can control two parameters (one at a time) to give the projectile a good throw.
    1.Angle
    2.Power
- The angle has a vertical bar going up and down and the power has a horizontal bar going left to right every e.g. 0.25 seconds. Both bars should show an indication of the scale.(a gradient heat map or spectrum scale to indicate from worst value to best.)

<h3>Game Control</h3>
- The player either hits the spacebar button or taps on the screen on a mobile device at the right moment to stop the two parameters, one at a time.
- If it is the optimal combination, the game freezes at the moment of the hitting touch for 1 second, and shows a "perfect" asset to enhance the visual effects.
- During game debugging, there should be a way
to trigger this "perfect" hitting effect for any combinations of angle and power. To assess this “feature” a “debug-mode” button is included, which triggers this functionality.
-After selecting the angle and the power, the projectile starts flying from left to right on a 2D scene, but the projectile is focused in the middle of the scene.
- After selecting the angle and the power, the projectile starts flying from left to right on a 2D scene, but the projectile is focused in the middle of the scene.
- To implement indicators for showing the distance of the throw.
- When the projectile flys through the air, a particle visual effect is shown at the tail of the projectile.
- It is important to save the exact moment of the throw to the user’s game session into the database. Saving the game starting timestamp, angle, and power of the attempt. Create an API call: /api/save-throw.

<h3>Game Over conditions</h3>
- There is only one game over condition:
    - After all 3 attempts have been played
- Attempt failed conditions:
    - When a projectile goes out of the screen on the top side;
    - When the angle is less than 5 degrees and power less than 30%;
- When the attempt is over, the projectile's speed is set to 0 and this attempt is saved to the database for the current game. Create an API call: /api/game-over

<h3>Game mechanics</h3>
- While the projectile is flying, its course is calculated by some formula, and the trajectory is saved into the database every 0.5 seconds also at the same time the speed of the projectile is reduced by 10%. This way we create a log of the throw. Create an API call -/api/in-flight and store in the database the speed and x and y coordinates of the projectile.
- At some point, the projectile will come back to the ground, and depending on whether it still has enough speed (at least 20% of the initial speed), it might bounce off the ground and add a bit more distance. When the projectile's speed is still above 60% of the initial speed, let the projectile bounce and rotate 90 degrees forwards. The bounce-back angle should be calculated based on the incoming angle minus 10%.(If there is enough inertia (speed) on the next projectile landing, the bounce is repeated.) Every bounce should be stored in the *DATABASE to the current game session. Create an API call: /api/bounce
- If the projectile’s speed is below 20% of the initial speed, initiate the final glide of 0.5 seconds, and reduce the speed to 0.

![image](https://user-images.githubusercontent.com/82625479/213885392-0154d478-d789-4b95-946f-5ba971864146.png)


<h3>End screen</h3>
- The longer distance the better. The game takes the average of the top 2 distances as the final result.
- Show a leaderboard of the five top players. Display the name, country code, the image of the projectile used, and their results on each row.
Clearly highlight the position of the current player’s recent game session and the top
three positions within the list. If the current player’s position is out of the “top 5 players” it is displayed as an additional row.
- There is also a button that brings you all the way back to the start screen, where the player can either start a new game or play again with the same credentials (name, country code and projectile image).

<h3>Result Sharing</h3>
- In the end screen, the following image is automatically generated and displayed to the player. A horizontal image that displays the best result of the three attempts with the path of the projectile.
- The client wants the following elements to be on this shareable image:
    1.The text Winter Sports Popularization Association.
    2.The logo for the WSPA.
    3.The player’s name.
    4.The path of the projectile, using the correct image.
    5.The distance.
- Here is an imaginary result shareable image, the layout is free to be adjusted.
- 
![image](https://user-images.githubusercontent.com/82625479/213885527-a8b0b6f6-a103-4f32-b85d-929b316bcb09.png)

