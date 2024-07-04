<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OpenApi\Annotations as OA;

/**
 * Class Page.
 * 
 * @author  Evelline <ev.attoff@gmail.com>
 * 
 * @OA\Schema(
 *     description="Page model",
 *     title="Page model",
 *     required={"slug", "title"},
 *     @OA\Xml(
 *         name="Page"
 *     )
 * )
 */
class Page extends Model
{
    use SoftDeletes;

    public $primaryKey = 'slug';
    public $incrementing = false;
    protected $table = 'pages';
    protected $fillable = [
      'slug',
      'title',
      'layout',
      'img_main',
      'file_main',
      'file_link',
      'body',
      'created_at',
      'created_by',
      'updated_at',
      'updated_by',
    ];
}
