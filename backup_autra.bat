@echo off
:: === SETTING DASAR ===
set DB_USER=root
set DB_PASS=
set DB_NAME=autra_project
set BACKUP_DIR=C:\xampp\htdocs\AUTRA-Project\backup
set MYSQL_PATH=C:\xampp\mysql\bin

:: === TANGGAL OTOMATIS (format YYYY-MM-DD) ===
for /f "tokens=2 delims==" %%I in ('"wmic os get localdatetime /value"') do set datetime=%%I
set DATE=%datetime:~0,4%-%datetime:~4,2%-%datetime:~6,2%

:: === BUAT FOLDER BACKUP JIKA BELUM ADA ===
if not exist "%BACKUP_DIR%" mkdir "%BACKUP_DIR%"

:: === NAMA FILE BACKUP ===
set BACKUP_FILE=%BACKUP_DIR%\%DB_NAME%_%DATE%.sql

:: === PROSES BACKUP ===
echo Membuat backup database %DB_NAME% ...
"%MYSQL_PATH%\mysqldump" -u %DB_USER% -p%DB_PASS% %DB_NAME% > "%BACKUP_FILE%"

:: === SELESAI ===
echo Backup selesai! File tersimpan di:
echo %BACKUP_FILE%
pause
