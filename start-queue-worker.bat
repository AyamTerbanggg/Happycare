@echo off
echo Starting Queue Worker for Email Server...
echo.
echo This will process email jobs in the background
echo Press Ctrl+C to stop the worker
echo.
php artisan queue:work --tries=3 --timeout=60 --memory=512
pause 