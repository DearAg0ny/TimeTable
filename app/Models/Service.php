<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Models\CompletedJobs;

class Service extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'company_code',
        'company_name',
        'company_address',
        'service_id',
        'service_name'
    ];

    public function category(){
        return $this->belongsTo(CompletedJobs::class);
    }
}