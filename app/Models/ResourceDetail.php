<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OpenApi\Annotations as OA;

/**
 * Class ResourceDetail.
 * 
 * @author  Evelline <evelline.kristiani@ukrida.ac.id>
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
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
    ];
}