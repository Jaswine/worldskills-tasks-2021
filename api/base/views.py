from rest_framework.response import Response
from rest_framework.decorators import api_view
from .models import *
from .serializers import *

@api_view(['GET'])
def loaded(request):
  return Response({'message': 'I work'})

# * Method: POST
# ! Route: /api/start-game
# TODO: 2-letter Code, his/her/them name, projectile image
# ? Just User
@api_view(['POST'])
def StartGameSave(request):
  if request.method == 'POST':
    
    if 'image' in request.FILES:
      photo = request.FILES['image']
    else: 
      photo = ''
    
    data = User.objects.create(
      name = request.data['name'],
      country = request.data['country'],
      image = photo
    )
    
    # return Response({'Start Game Date':StartGameSave(user, many=False).data})
    return Response({
      'status': 'success',
      'data': StartGameSaveSerializer(data, many=False).data
    })


# * Method: POST
# ! Route: /api/save-throw
# TODO: aving the game starting timestamp, angle, and power of the attempt.(3)
# ? registered user
@api_view(['POST'])
def BeginGameSave(request):
  if request.method == 'POST':
    
    id = request.data['user']
    user = User.objects.get(id=id)
    
    data = StartGame.objects.create(
      user = user,
      started = request.data['started'],
      angle = request.data.get('angle'),
      power = request.data.get('power'),
    )
    
    return Response({
      'status': 'success',
      'data': StartGameSerializer(data, many=False).data
    })


# * Method: POST
# ! Route: /api/game-over
# TODO: When the attempt is over, aving the game starting timestamp, angle, and power of the attempt.
# ? registered user
@api_view(['POST'])
def EndOneGame(request):
  if request.method == 'POST':
    
    id = request.data['user']
    user = User.objects.get(id=id)
    
    data = EndGame.objects.create(
      user = user,
      startGame = request.data.get('startGame'),
      angle = request.data.get('angle'),
      power = request.data.get('power'),
      endGame = request.data.get('endGame'),
    )
    
    return Response({
      'status': 'success',
      'data': EndOneGameSerializer(data, many=False).data
    })

# * Method: POST
# ! Route: /api/in-flight 
# TODO: create a log of the throw(0.5sec), the speed and x and y coordinates of the projectile
# ? registered user
@api_view(['POST'])
def InFlightCreate(request):
  if request.method == 'POST':
    
    id = request.data['user']
    user = User.objects.get(id=id)
   
    data = InFlight.objects.create(
      user = user,
      speed = request.data.get('speed'),
      x = request.data.get('x'),
      y = request.data.get('y'),
    )
    
    return Response({
      'status': 'success',
      'data': InFlightSerializer(data, many=False).data
    })

# * Method: POST
# ! Route: /api/bounce
# TODO: Every bounce should be stored in the database to the current game session. speed, base angle, last angle, power,time
# ? registered user
@api_view(['POST'])
def AddBounce(request):
  if request.method == 'POST':
    
    id = request.data['user']
    user = User.objects.get(id=id)
    
    data = Bounce.objects.create(
      user = user,
      speed = request.data.get('speed'),
      baseAngle = request.data.get('baseAngle'),
      lastAngle = request.data.get('lastAngle'),
      power = request.data.get('power'),
      time = request.data.get('time'),
    )
    
    return Response({
      'status': 'success',
      'data': BounceSerializer(data, many=False).data
    })
  

# * Method: GET || POST
# ! Route: /api/game-finish
# TODO: Show the best 5 results +- Player. || The game takes the average of the top 2 distances as the final result.
# ? registered user
@api_view(['GET', 'POST'])
def gameFinish(request):
  if request.method == 'GET':
    data = GameFinish.objects.all()
    
    return Response({
      'users':  GameFinishSerializer(data, many=True).data
    })
    
  if request.method == 'POST':
    id = request.data['user']
    user = User.objects.get(id=id)
    
    data = GameFinish.objects.create(
      user = user,
      result = request.data.get('result'),
    )
    
    return Response({
      'status': 'success',
      'data': GameFinishSerializer(data, many=False).data
    })