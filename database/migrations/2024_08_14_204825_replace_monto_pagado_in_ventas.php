<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ReplaceMontoPagadoInVentas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ventas', function (Blueprint $table) {
            $table->dropColumn('monto_pagado');
            $table->renameColumn('monto_pagado_new', 'monto_pagado');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ventas', function (Blueprint $table) {
            $table->decimal('monto_pagado', 10, 2)->nullable()->default(null);
            $table->renameColumn('monto_pagado', 'monto_pagado_new');
        });
    }
}

