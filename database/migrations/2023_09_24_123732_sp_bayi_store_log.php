<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    private $spName = 'bayiinsert';

    /**
     * Run the migrations.
     */
    public function up(): void {
        $sql = <<<SQL
        CREATE OR REPLACE PROCEDURE $this->spName
            (IN p_Action ENUM('UPDATE', 'INSERT', 'DELETE'), IN p_Log TEXT)
        BEGIN
            INSERT INTO logs (action, log)
            VALUES (p_Action, p_Log);
        END;
        SQL;

        DB::unprepared($sql);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        $sql = "DROP PROCEDURE IF EXISTS $this->spName;";
        DB::unprepared($sql);
    }
};
