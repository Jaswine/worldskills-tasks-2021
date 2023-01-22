from django.contrib import admin
from .models import *

admin.site.register(User)
admin.site.register(StartGame)
admin.site.register(EndGame)
admin.site.register(InFlight)
admin.site.register(Bounce)
admin.site.register(GameFinish)