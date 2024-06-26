<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OpenApi\Annotations as OA;

/**
 * Class Satisfaction.
 * 
 * @author  Evelline <ev.attoff@gmail.com>
 * 
 * @OA\Schema(
 *     description="Satisfaction model",
 *     title="Satisfaction model",
 *     @OA\Xml(
 *         name="Satisfaction"
 *     )
 * )
 */
class Satisfaction extends Model
{
    use SoftDeletes;

    protected $table = 'satisfactions';
    protected $fillable = [
        'star',
        'name',
        'email',
        'title',
        'description',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
    ];
}
