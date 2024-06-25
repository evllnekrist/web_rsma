<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OpenApi\Annotations as OA;

/**
 * Class Article.
 * 
 * @author  Evelline <evelline.kristiani@ukrida.ac.id>
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
        'category_id',
        'slug',
        'title',
        'content',
        'status',
        'type',
        'keywords',
        'img_main',
        'icon',
        'caption',
        'sequence',
        'portal_user_id',
        'created_at',
        'post_at',
        'publish_at',
    ];
}
