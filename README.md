# Laravel Sentinel Module
This is a Laravel module which helps you to track the user logins and user actions. You can check the routes that the user visited and set some which to be ignored from the log. There are pages on which you can preview the user logins and user visits. There is also a display of all the application routes with middlewares attached to them. With this module you can also log messages into different files and check the last logged messages from the web browser in a page. For more information read the INFO file. Don't forget to check config/sentinel.php and configure the module.

### Requirements:
```
php: >= 5.5.9
laravel/framework: 5.*
https://github.com/v-radev/laravel-master-module
```

___

### Installation

- Make a Cluster/ folder within app/ and copy SentinelCluster/ inside

- In config/app.php to the providers array add:
```
App\Clusters\SentinelCluster\Providers\SentinelClusterServiceProvider::class,
```

- In config/app.php to the alias array add:
```
'Tell' => App\Clusters\SentinelCluster\Facades\Tell::class,
```

- In App\Http\Kernel add to the $middlewareGroups property on the array with the 'web' key:
```
\App\Clusters\SentinelCluster\Middleware\RouteObserverMiddleware::class 
```

- Run:
```
php artisan migrate --path=/app/Clusters/SentinelCluster/Resources/Database/migrations
```

- Run:
```
php artisan vendor:publish --tag=sentinel
```