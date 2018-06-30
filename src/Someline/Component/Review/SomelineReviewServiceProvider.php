<?php

namespace Someline\Component\Review;


use Dingo\Api\Routing\Router as ApiRouter;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;
use Someline\Models\Review\SomelineReview;
use Someline\Repositories\Eloquent\SomelineReviewRepositoryEloquent;
use Someline\Repositories\Interfaces\SomelineReviewRepository;

class SomelineReviewServiceProvider extends ServiceProvider
{

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        if (class_exists(SomelineReview::class)) {
            Relation::morphMap([
                SomelineReview::MORPH_NAME => SomelineReview::class,
            ]);
        }
        $this->loadMigrationsFrom(__DIR__ . '/../../../database/migrations');
        $this->publishes([
            __DIR__ . '/../../../config/config.php' => config_path('someline-review.php'),

            // master files
            __DIR__ . '/../../../master/Api/SomelineReview.php.dist' => app_path('Models/Review/SomelineReview.php'),
            __DIR__ . '/../../../master/Api/SomelineReviewRepository.php.dist' => app_path('Repositories/Interfaces/SomelineReviewRepository.php'),
            __DIR__ . '/../../../master/Api/SomelineReviewRepositoryEloquent.php.dist' => app_path('Repositories/Eloquent/SomelineReviewRepositoryEloquent.php'),
            __DIR__ . '/../../../master/Api/SomelineReviewsController.php.dist' => app_path('Api/Controllers/SomelineReviewsController.php'),
            __DIR__ . '/../../../master/Api/SomelineReviewTransformer.php.dist' => app_path('Transformers/SomelineReviewTransformer.php'),
            __DIR__ . '/../../../master/Api/SomelineReviewValidator.php.dist' => app_path('Validators/SomelineReviewValidator.php'),
            __DIR__ . '/../../../master/Http/Console/SomelineReviewController.php.dist' => app_path('Http/Controllers/Console/SomelineReviewController.php'),

            // database
            __DIR__ . '/../../../database/seeds/SomelineReviewsTableSeeder.php.dist' => base_path('database/seeds/SomelineReviewsTableSeeder.php'),

            // resources folders
//            __DIR__ . '/../../../resources/assets/js/console' => resource_path('assets/js/components/console'),
//            __DIR__ . '/../../../resources/views/console' => resource_path('views/console'),
        ]);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../../../config/config.php',
            'someline-review'
        );

        // repository
        if (interface_exists(SomelineReviewRepository::class)) {
            $this->app->bind(SomelineReviewRepository::class, SomelineReviewRepositoryEloquent::class);
        }
    }

    public static function api_routes(ApiRouter $api, callable $callback = null)
    {

        // /reviews
        $api->group(['prefix' => 'reviews'], function (ApiRouter $api) use ($callback) {
            $callback && call_user_func($callback, $api);

            $api->get('/', 'SomelineReviewsController@index');
            $api->post('/', 'SomelineReviewsController@store');
            $api->get('/{id}', 'SomelineReviewsController@show')->where('id', '[0-9]+');
            $api->put('/{id}', 'SomelineReviewsController@update')->where('id', '[0-9]+');
            $api->delete('/{id}', 'SomelineReviewsController@destroy')->where('id', '[0-9]+');

        });

    }

    public static function console_routes(callable $callback = null)
    {
        \Route::group(['prefix' => 'reviews'], function () use ($callback) {
            $callback && call_user_func($callback);

            \Route::get('/', 'SomelineReviewController@getReviewList');
            \Route::get('/new', 'SomelineReviewController@getReviewNew');
            \Route::get('/{review_id}', 'SomelineReviewController@getReviewDetail');
            \Route::get('/{review_id}/edit', 'SomelineReviewController@getReviewEdit');

        });
    }

    public static function getConfig($name)
    {
        return config('someline-review.' . $name);
    }

    public static function isWithPackage($package_name)
    {
        $packages_config = self::getConfig('packages');
        return (isset($packages_config[$package_name]) && $packages_config[$package_name]);
    }

}