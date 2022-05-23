<?php

namespace App\Models;

use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $guarded = [] ;

    /**
     * Au lieu d'écrire ça dans le contolleur voir juste en dessous
     *    Post::create([
     *       'name' => $request->name,
     *       'content' => $request->content,
     *       'image' => $imageName,
     *  ]); 
     */
    public static function boot(){
        parent::boot() ;

        self::creating(function ($post) {
            $post->user()->associate(auth()->user()->id) ;
            $post->category()->associate(request()->category) ;
        });

        
        self::updating(function ($post) {
            $post->category()->associate(request()->category) ;
        }) ;
    }

    public function user(){

        return $this->belongsTo(User::class);
    }

    public function category(){

        return $this->belongsTo(Category::class);
    }

// Pour automatiser Str::title dans la vue index
    public function getTitleAttribute($attribute)
    {
        return Str::title($attribute) ;
    }
}
