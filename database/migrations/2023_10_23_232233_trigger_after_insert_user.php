<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    private $triggerName = 'trigger_after_insert_user';

    public function up(): void
    { 
        DB::unprepared(
            "CREATE TRIGGER $this->triggerName
            AFTER INSERT ON user FOR EACH ROW
            BEGIN
                DECLARE u_username VARCHAR(100);
                
                SELECT username INTO u_username FROM user WHERE id = NEW.id;
                    
                CALL Active(u_username, 'INSERT',
                    CONCAT(
                        'username:', u_username
                    )
                    );
                    END;"
        );
    }

    public function down(): void
    {
        DB::unprepared("DROP TRIGGER IF EXISTS $this->triggerName");
    }
};