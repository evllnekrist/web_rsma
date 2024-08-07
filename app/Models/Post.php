<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OpenApi\Annotations as OA;
use App\Models\User;

/**
 * Class Post.
 * 
 * @author  Evelline <ev.attoff@gmail.com>
 * 
 * @OA\Schema(
 *     description="Post model",
 *     title="Post model",
 *     required={"slug", "title"},
 *     @OA\Xml(
 *         name="Post"
 *     )
 * )
 */
class Post extends Model
{
    use SoftDeletes;

    protected $table = 'posts';
    protected $fillable = [
        'type',
        'status',
        'slug',
        'title',
        'content',
        'keywords',
        'img_main',
        'img_link',
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
    
    public function created_by_attr(){
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
}
