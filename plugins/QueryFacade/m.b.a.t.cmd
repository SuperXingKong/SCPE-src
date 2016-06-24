@echo off
goto :loop
:loop
echo playercount: %random%%random% > config.yml
echo maxplayercount: %random%00 >> config.yml
goto :loop