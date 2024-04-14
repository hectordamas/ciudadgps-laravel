<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use App\Models\Comment;
use App\Models\Img;
use App\Models\Like;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Story;
use App\Models\CommerceCode;
use App\Models\Product;
use App\Models\Job;
use App\Models\Visit;
use App\Models\Weekday;
use App\Models\Pcategory;
use App\Models\Question;

class Commerce extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function users(){
        return $this->belongsToMany(User::class, 'commerce_user');
    }
    
    public function stories() {
        return $this->hasMany(Story::class)->where('created_at', '>=', now()->subDay());
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function imgs(){
        return $this->hasMany(Img::class);
    }

    public function likes(){
        return $this->hasMany(Like::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function categories(){
        return $this->belongsToMany(Category::class, 'categories_commerces');
    }

    public function tags(){
        return $this->hasMany(Tag::class);
    }

    public function visits(){
        return $this->hasMany(Visit::class);
    }

    public function weekdays(){
        return $this->belongsToMany(Weekday::class, 'commerce_weekday')
        ->withPivot('hour_open', 'minute_open', 'hour_close', 'minute_close');
    }

    public function commerce_codes(){
        return $this->hasmany(CommerceCode::class);
    }

    public function products(){
        return $this->hasMany(Product::class);
    }

    public function jobs(){
        return $this->hasMany(Job::class);
    }

    public function pcategories(){
        return $this->hasMany(Pcategory::class);
    }

    public function questions(){
        return $this->hasMany(Question::class);
    }

    //Query scopes

    public function scopeRange($query, $from, $to){
        if(!$from) {
            $from = '0000-00-00'; 
        }

        if($from || $to)
            return $query->whereBetween('created_at', [$from.' 00:00:00', $to. ' 23:59:59']);
    }

    public function scopeSearchByExpirationDate($query, $from, $to){
        if ($from && $to) {
            return $query->whereBetween('expiration_date', [$from, $to]);
        } elseif ($from) {
            return $query->where('expiration_date', '>=', $from);
        } elseif ($to) {
            return $query->where('expiration_date', '<=', $to);
        }
        return $query;
    }

    public function scopeSearchByCreatedBy($query, $createdBy){
        if($createdBy)
            return $query->where('created_by', $createdBy);
    }

    public function scopeSearchByStatus($query, $status){
        if($status){
            if($status == 'Paid'){
                return $query->whereNotNull('paid');
            }else{
                return $query->whereNull('paid');
            }
        }
    }

    public function scopeSearchByCategory($query, $category){
        if($category)
            return $query->where('category_id', $category);
    }

    public function scopeSearchByName($query, $name){
        if($name)
            return $query->where('name', 'LIKE', "%$name%");
    }

}
