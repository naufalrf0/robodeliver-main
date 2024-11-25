<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name'];

    // Relationships
    public function products()
    {
        return $this->hasMany(MerchantProduct::class);
    }

    // Query Scopes
    public function scopeByName($query, string $name)
    {
        return $query->where('name', $name);
    }

    // Validation rules
    public static function rules()
    {
        return [
            'name' => 'required|string|max:100|unique:categories,name',
        ];
    }
}
