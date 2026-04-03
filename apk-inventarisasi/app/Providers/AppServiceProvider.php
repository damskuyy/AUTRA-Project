<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Fluent;
use App\Models\Inventory;

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

        View::composer('be.navbar', function ($view) {
            $lowStockNotifications = Inventory::with('barangMasuk')
                ->whereHas('barangMasuk', function ($query) {
                    $query->where('jenis_barang', 'bahan');
                })
                ->where('stok', '<=', 10)
                ->get()
                ->groupBy(fn ($item) => $item->barangMasuk->nama_barang)
                ->map(function ($items, $nama) {
                    return (object) [
                        'nama_barang' => $nama,
                        'total_stok' => $items->sum('stok'),
                        'satuan' => $items->first()->barangMasuk->satuan ?? 'pcs',
                    ];
                })
                ->values();

            $view->with([
                'lowStockNotifications' => $lowStockNotifications,
                'lowStockNotificationsCount' => $lowStockNotifications->count(),
            ]);
        });

        info('✅ Macro noPrefixCreate registered');

    }
}
