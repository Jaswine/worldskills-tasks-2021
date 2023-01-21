from rest_framework.response import Response
from rest_framework.decorators import api_view
from .models import *
from .serializers import *

@api_view(['GET'])
def loaded(request):
  return Response('I work')

# * Method: POST
# ! Route: /api/start-game
# TODO: 2-letter Code, his/her/them name, projectile image
# ? Just User


# * Method: POST
# ! Route: /api/save-throw
# TODO: aving the game starting timestamp, angle, and power of the attempt.(3)
# ? registered user

# * Method: POST
# ! Route: /api/game-over
# TODO: When the attempt is over, aving the game starting timestamp, angle, and power of the attempt.
# ? registered user

# * Method: POST
# ! Route: /api/in-flight 
# TODO: create a log of the throw(0.5sec), the speed and x and y coordinates of the projectile
# ? registered user

# * Method: POST
# ! Route: /api/bounce
# TODO: Every bounce should be stored in the database to the current game session. speed, base angle, last angle, power,time
# ? registered user

# * Method: POST
# ! Route: /api/game-finish
# TODO: The game takes the average of the top 2 distances as the final result.
# ? registered user

# * Method: GET
# ! Route: /api/game-finish
# TODO: Show the best 5 results +- Player.
# ? registered user