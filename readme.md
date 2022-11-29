<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
	<p>PHP Version ^7.2.5|^8.0 </p>
	<p>Laravel Framework 8.0* </p>
</p>

## Note (For ubuntu users only)
- To give full permissions/access to project folder, Open terminal ( **Ctrl + Alt + t** )

      sudo chmod -R a+rwx  /opt/lampp/htdocs/Folder Name
      
- To give full permissions/access to specific folder, Example : 

      sudo chmod -R a+rwx  /opt/lampp/htdocs/Folder Name/storage/logs
  
## Project installation steps

- Step 1 : composer Install
- Step 2 : composer update
- Step 3 : composer dumpa
- Step 4 : php artisan key:generate
- Step 5 : php artisan storage:link
- Step 6 : php artisan migrate:refresh --seed
- Step 7 : ./clean-up.sh


      
## Default setting keys

- application_logo : For Admin Penal Application Logo Change
- application_title : For Admin Penal Site Name Change
- favicon_logo : For Admin Panel Favicon Logo Change
- copyright : For Admin Penal Site Copy Right Name Change

## Define .env Gmail User Name And Password

MAIL_MAILER=
MAIL_HOST=
MAIL_PORT=
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_ENCRYPTION=