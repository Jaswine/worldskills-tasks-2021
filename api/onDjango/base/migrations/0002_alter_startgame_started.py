# Generated by Django 4.1.4 on 2023-01-22 12:40

from django.db import migrations, models


class Migration(migrations.Migration):

    dependencies = [
        ('base', '0001_initial'),
    ]

    operations = [
        migrations.AlterField(
            model_name='startgame',
            name='started',
            field=models.CharField(max_length=100),
        ),
    ]
