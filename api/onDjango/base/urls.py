from django.urls import path
from . import views

urlpatterns = [
    path('loaded', views.loaded, name='loaded'),
    
    #TODO: Register
    path('start-game', views.StartGameSave, name='start-game-save'),
    
    #TODO: Start Game
    path('save-throw', views.BeginGameSave, name='save-throw'),
    
    #TODO: After 1 Attempt
    path('game-over', views.EndOneGame, name='game-over'),
    
    #TODO: Just Log
    path('in-flight', views.InFlightCreate, name='in-flight'),
    
    #TODO: Add Bounce
    path('bounce', views.AddBounce, name='bounce'),
    
    #TODO: Game Finish
    path('game-finish', views.gameFinish, name='game-finish'),
]
