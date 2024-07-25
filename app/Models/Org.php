<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OpenApi\Annotations as OA;

/**
 * Class Org.
 * 
 * @author  Evelline <ev.attoff@gmail.com>
 * 
 * @OA\Schema(
 *     description="Org model",
 *     title="Org model",
 *     @OA\Xml(
 *         name="Org"
 *     )
 * )
 */
class Org extends Model
{
    use SoftDeletes;

    protected $table = 'orgs';
    protected $fillable = [
        'name',
        'nip',
        'img_main',
        'desc_title',
        'desc_body',
        'job_title',
        'pid',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
    ];

    public function superior_attr()
    {
        return $this->hasOne(Org::class, 'id', 'pid');
    }
}
