@echo off
TITLE MCPE SERVER
cd /d %~dp0
netstat -o -n -a | findstr 0.0.0.0:19132>nul
if %ERRORLEVEL% equ 0 (
    goto :StartPM
    exit 1
) ELSE (
    echo Starting your PocketMine-MP server...
    goto :StartPM
)


:loop
echo Checking if server is online...
PING 127.0.0.1 -n 5 >NUL


netstat -o -n -a | findstr 0.0:19132>nul
if %ERRORLEVEL% equ 0 (
    echo Server is running.
    goto :loop
) ELSE (
    taskkill /T /IM mintty.exe
    echo Starting PocketMine-MP in 10 seconds...
    PING 127.0.0.1 -n 1 >NUL
    goto :StartPM
)


:StartPM
start start.cmd
goto :loop