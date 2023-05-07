# hzh seeder

This library allow to generate a seeder file from existing table in current database (Laravel).

### Installation:

composer require hzh/seeder

### Use:

1. After Installation you must put this line in your config/app.php inside a provider's array:

      Hzh\Seeder\HzhServiceProvider::class
      
      
2. Use this command to generate the seeder File:

      php artisan hzh:seeder tableName ModelName
      
3. Enjoy it!


### NOTE: Is imperative to has a `Model` created before use this library.


