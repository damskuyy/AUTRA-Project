<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Fluent;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);

        Schema::macro('noPrefixCreate', function (string $table, \Closure $callback) {
            $connection = Schema::getConnection();
            $grammar = $connection->getSchemaGrammar();

            $blueprint = new Blueprint($table);
            $callback($blueprint);

            $blueprint->create();

            $statements = (array) $grammar->compileCreate(
                $blueprint,
                new Fluent(),
                $connection
            );

            foreach ($statements as $statement) {
                $connection->statement($statement);
            }
        });
        info('✅ Macro noPrefixCreate registered');

    }
}
