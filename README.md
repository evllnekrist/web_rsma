<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://img.freepik.com/premium-vector/caduceus-logo-vector-health-care-hospital_516670-132.jpg" width="400" alt="Health Related"></a></p>


## Developer Note
- Laravel 11.9, PHP 8.2
- Security using Laravel Passport
- Open API Specification 3.0

### Getting Started
- How to start after clone:
-- 'composer install' <-- Laravel standard to retrieve vendor folder packages, also create autoload
-- 'npm install' <-- optional to Laravel, but necessary for this project, due to Breeze implementation
-- 'npm run build' <-- the 2nd necessary after npm install 
- File upload using storage Laravel. 
-- Storage Laravel method will uploads the file into /($ROOT_FOLDER)/storage/app/public
-- Meanwhile it could be uploaded, to access it is different story. Please do 'php artisan storage:link' (opt. rm -rf public/storage). For [more info](https://laracasts.com/discuss/channels/laravel/show-images-from-storage-folder). It will makes 'softlink' folder in /($ROOT_FOLDER)/public
-- Make sure the upload path (storeAs) same as you save into db

## License
The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
