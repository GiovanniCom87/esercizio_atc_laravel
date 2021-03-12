<?php

use App\Models\Department;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('departments', function (Blueprint $table) {
            $table->id();
            $table->string('department');
            $table->timestamps();
        });

        $path = database_path('seeds/reparti.json');
    
        $departments = json_decode(file_get_contents($path), true);
    
        foreach($departments as $dept){
   
            $b = new Department();
            $b->department = $dept['department'];
            $b->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('departments');
    }
}
