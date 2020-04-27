<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Movie extends Model
{
    protected $fillable = ['name', 'description', 'path', 'poster', 'image', 'rating', 'year', 'percent'];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'movie_category');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_movie');
    }

    protected $appends = ['image_path', 'poster_path', 'is_favored'];

    public function getImagePathAttribute()
    {
        return Storage::url('images/' . $this->image);
    }

    public function getPosterPathAttribute()
    {
        return Storage::url('images/' . $this->poster);
    }

    public function getIsFavoredAttribute()
    {
        if (auth()->user()) {
            return (bool)$this->users()->where('user_id', auth()->user()->id)->count();
        }
        return false;
    }

    public function scopeWhenSearch($query, $search)
    {
        return $query->when($search, function ($q) use ($search) {
            return $q->where('name', 'like', "%$search%")
                ->orWhere('description', 'like', "%$search%")
                ->orWhere('year', 'like', "%$search%")
                ->orWhere('rating', 'like', "%$search%");
        });

    }// end of scopeWhenSearch

    public function scopeWhenCategory($query, $category)
    {
        return $query->when($category, function ($q) use ($category) {

            return $q->whereHas('categories', function ($qu) use ($category) {

                return $qu->whereIn('category_id', (array)$category)
                    ->orWhereIn('name', (array)$category);

            });

        });

    }// end of scopeWhenCategory

    public function scopeWhenFavorite($query, $favorite)
    {
        return $query->when($favorite, function ($q) {

            return $q->whereHas('users', function ($qu) {

                return $qu->where('user_id', auth()->user()->id);
            });

        });

    }// end of scopeWhenCategory

}
