<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OpenApi\Annotations as OA;
use App\Models\ResourceSumamry;

/**
 * Class ResourceDetail.
 * 
 * @author  Evelline <ev.attoff@gmail.com>
 * 
 * @OA\Schema(
 *     description="ResourceDetail model",
 *     title="ResourceDetail model",
 *     @OA\Xml(
 *         name="ResourceDetail"
 *     )
 * )
 */
class ResourceDetail extends Model
{
    use SoftDeletes;

    protected $table = 'resource_details';
    protected $fillable = [
        'key',
        'name',
        'description',
        'link',
        'sequence',
        'img_main',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
    ];
    
    public function summary(){
        return $this->belongsTo(ResourceSummary::class, 'key', 'key');
    }

    public function schedule(){
        return $this->hasMany(ResourceDetailSchedule::class, 'resource_id', 'id');
    }
}