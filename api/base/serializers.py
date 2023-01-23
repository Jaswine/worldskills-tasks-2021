from rest_framework.serializers import ModelSerializer
from .models import *

class StartGameSaveSerializer(ModelSerializer):
  class Meta:
    model = User
    fields = '__all__'
    
class StartGameSerializer(ModelSerializer):
  class Meta:
    model = StartGame
    fields = '__all__'
    
class EndOneGameSerializer(ModelSerializer):
  class Meta:
    model = EndGame
    fields = '__all__'
    
class InFlightSerializer(ModelSerializer):
  class Meta:
    model = InFlight
    fields = '__all__'
    
class BounceSerializer(ModelSerializer):
  class Meta:
    model = Bounce
    fields = '__all__'
    
class GameFinishSerializer(ModelSerializer):
  user = StartGameSaveSerializer()
  
  class Meta:
    model = GameFinish
    fields = ['id', 'user', 'result' , 'created', 'updated']