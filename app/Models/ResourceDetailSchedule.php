<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OpenApi\Annotations as OA;
use App\Models\ResourceDetail;

/**
 * Class ResourceDetailSchedule.
 * 
 * @author  Evelline <ev.attoff@gmail.com>
 * 
 * @OA\Schema(
 *     description="ResourceDetailSchedule model",
 *     title="ResourceDetailSchedule model",
 *     @OA\Xml(
 *         name="ResourceDetailSchedule"
 *     )
 * )
 */
class ResourceDetailSchedule extends Model
{
    public $timestamps = false;
    protected $table = 'resource_detail_schedules';
    protected $fillable = [
        'id',
        'resource_id',
        'day',
        'time_start',
        'time_end',
    ];
    
    public function resource_attr(){
        return $this->belongsTo(ResourceDetail::class, 'resource_id', 'id');
    }
}