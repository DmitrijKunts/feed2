<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("CREATE EXTENSION IF NOT EXISTS rum;");
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->string('merchant');
            $table->string('ln');
            $table->string('code')->unique();
            $table->string('name');
            $table->string('category');
            $table->string('pictures')->nullable();
            $table->text('description')->nullable();
            $table->decimal('price', $precision = 8, $scale = 2);
            $table->decimal('oldprice', $precision = 8, $scale = 2);
            $table->string('currencyId');
            $table->string('url');
            $table->string('vendor')->nullable();
            $table->string('model')->nullable();
            $table->jsonb('param')->nullable();
            $table->timestamps();
        });

        DB::statement("ALTER TABLE offers ADD COLUMN tsv TSVECTOR");
        DB::statement("CREATE INDEX offers_tsv_rum ON offers USING RUM(tsv)");

        DB::statement("
        CREATE FUNCTION offers_tsv_trigger() RETURNS trigger AS $$
        begin
          new.tsv :=
             setweight(to_tsvector(new.ln, new.name), 'A') ||
             setweight(to_tsvector(new.ln, new.category), 'B');
          return new;
        end $$ LANGUAGE plpgsql;");
        DB::statement("CREATE TRIGGER tsv_search BEFORE INSERT OR UPDATE ON offers FOR EACH ROW EXECUTE PROCEDURE offers_tsv_trigger()");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP TRIGGER IF EXISTS tsv_search ON offers");
        DB::statement("DROP INDEX IF EXISTS offers_tsv_rum");
        DB::statement("DROP FUNCTION IF EXISTS offers_tsv_trigger");
        Schema::dropIfExists('offers');
        DB::statement("DROP EXTENSION IF EXISTS rum;");
    }
};
