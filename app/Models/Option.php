<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OpenApi\Annotations as OA;

/**
 * Class Option.
 * 
 * @author  Evelline <evelline.kristiani@ukrida.ac.id>
 * 
 * @OA\Schema(
 *     description="Option model",
 *     title="Option model",
 *     @OA\Xml(
 *         name="Option"
 *     )
 * )
 */
class Option extends Model
{
    use SoftDeletes;

    protected $table = 'options';
    protected $fillable = [
        'type',
        'value',
        'value2',
        'label',
        'desc',
        'img_main',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
    ];
}
