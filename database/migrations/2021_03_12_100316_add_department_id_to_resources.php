<?php

use App\Models\Resource;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDepartmentIdToResources extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('resources', function (Blueprint $table) {
            $table->unsignedBigInteger('department_id');
            $table->foreign('department_id')->references('id')->on('departments');
        });

        $path = database_path('seeds/anagrafica.json');
    
        $resources = json_decode(file_get_contents($path), true);
    
        foreach($resources as $resource){
   
            $b = new Resource();
            $b->name = $resource['name'];
            $b->surname = $resource['surname'];
            $b->department_id = $resource['department_id'];
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
        Schema::table('resources', function (Blueprint $table) {
            $table->dropForeign(['department_id']);
            $table->dropColumn('department_id');
        });
    }
}
