<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OpenApi\Annotations as OA;

/**
 * Class Article.
 * 
 * @author  Evelline <ev.attoff@gmail.com>
 * 
 * @OA\Schema(
 *     description="Article model",
 *     title="Article model",
 *     required={"slug", "title"},
 *     @OA\Xml(
 *         name="Article"
 *     )
 * )
 */
class Article extends Model
{
    use SoftDeletes;

    protected $table = 'articles';
    protected $fillable = [
        'type',
        'status',
        'slug',
        'title',
        'content',
        'keywords',
        'img_main',
        'caption',
        'sequence',
        'portal_user_id',
        'post_at',
        'publish_at',
        'created_at',
        'created_by',
        'updated_at',
        'created_by',
    ];
}
