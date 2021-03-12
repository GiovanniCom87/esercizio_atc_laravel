<?php

use App\Models\Task;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddResourceIdToTasks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->unsignedBigInteger('resource_id');
            $table->foreign('resource_id')->references('id')->on('resources');
        });

        $path = database_path('seeds/tasks.json');
    
        $tasks = json_decode(file_get_contents($path), true);
    
        foreach($tasks as $task){
   
            $b = new Task();
            $b->task = $task['task'];
            $b->price = $task['price'];
            $b->date = $task['date'];
            $b->resource_id = $task['resource_id'];
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
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropForeign(['resource_id']);
            $table->dropColumn('resource_id');
        });
    }
}
