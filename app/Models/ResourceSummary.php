<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OpenApi\Annotations as OA;

/**
 * Class ResourceSummary.
 * 
 * @author  Evelline <ev.attoff@gmail.com>
 * 
 * @OA\Schema(
 *     description="ResourceSummary model",
 *     title="ResourceSummary model",
 *     @OA\Xml(
 *         name="ResourceSummary"
 *     )
 * )
 */
class ResourceSummary extends Model
{
    use SoftDeletes;

    protected $table = 'resource_summaries';
    protected $fillable = [
        'type',
        'key',
        'key_label',
        'amount',
        'description',
        'link',
        'sequence',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
    ];
}
