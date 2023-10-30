<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    private $triggerName = 'trigger_after_insert_pencatatan_bayi';

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $sql = <<<SQL
        CREATE OR REPLACE TRIGGER $this->triggerName
        AFTER INSERT ON pencatatan_bayi FOR EACH ROW
        BEGIN
            CALL bayiinsert('INSERT',
                CONCAT(
                    'nama:', NEW.nama,
                    'berat_badan:', NEW.berat_badan 
                )
            );
        END;
        SQL;

        DB::unprepared($sql);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $sql = "DROP TRIGGER IF EXISTS $this->triggerName;";
        DB::unprepared($sql);
    }
};
