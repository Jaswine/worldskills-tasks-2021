from django.db import models

class User(models.Model):
  name = models.CharField(max_length=225)
  country = models.CharField(max_length=2)
  image = models.ImageField(upload_to='images', blank=True, default='')
  
  def __str__(self):
      return self.name
  
class StartGame(models.Model):
  user = models.ForeignKey(User, on_delete=models.CASCADE)
  started = models.DateTimeField(auto_now_add=True)
  angle = models.CharField(max_length=5)
  power = models.CharField(max_length=100)
  
  def __str__(self):
      return self.user.name
    
class EndGame(models.Model):
  user = models.ForeignKey(User, on_delete=models.CASCADE)
  startGame = models.CharField(max_length=100);
  angle = models.CharField(max_length=5);
  power = models.CharField(max_length=100);
  endGame = models.DateTimeField(auto_now_add=True);
  
  def __str__(self):
      return self.user.name

class FlightModel(models.Model):
  user = models.ForeignKey(User, on_delete=models.CASCADE)
  speed = models.CharField(max_length=100)
  x = models.CharField(max_length=100)
  y = models.CharField(max_length=100)
  
  created = models.DateTimeField(auto_now_add=True)
  
  def __str__(self):
    return self.user.name
  
class Bounce(models.Model):
  user = models.ForeignKey(User, on_delete=models.CASCADE)
  speed = models.CharField(max_length=100)
  baseAngle = models.CharField(max_length=100)
  lastAngle = models.CharField(max_length=100)
  power = models.CharField(max_length=100)
  time = models.DateField(auto_now_add=True)
  
  def __str__(self):
    return self.user.name

class GameFinish(models.Model):
  user = models.ForeignKey(User, on_delete=models.SET_NULL, null=True)
  result = models.CharField(max_length=300)
  
  created = models.DateTimeField(auto_now_add=True)
  updated = models.DateTimeField(auto_now=True)
  
  def __str__(self):
    return self.user.name