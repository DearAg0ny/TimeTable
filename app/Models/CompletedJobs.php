<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Service;

class CompletedJobs extends Model
{
    use HasFactory;

    protected $fillable = ['date','company','service','description','from','to'];

    public function completedJobs(){
        return $this->hasMany(Service::class);
    }
}
