<?php

namespace App\Models;

use App\Models\Resource;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory;
    
    protected $guarded=[];


    public function resource()
    {
        return $this->belongsTo(Resource::class);
    }
}
