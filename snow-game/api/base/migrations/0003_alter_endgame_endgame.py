# Generated by Django 4.1.4 on 2023-01-22 13:03

from django.db import migrations, models


class Migration(migrations.Migration):

    dependencies = [
        ('base', '0002_alter_startgame_started'),
    ]

    operations = [
        migrations.AlterField(
            model_name='endgame',
            name='endGame',
            field=models.CharField(max_length=100),
        ),
    ]
