<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Channel extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['name', 'icon', 'configuration', 'status'];

    protected $searchableFields = ['*'];

    protected $casts = [
        'configuration' => 'array',
        'status' => 'boolean',
    ];

    public function conversations()
    {
        return $this->hasMany(Conversation::class);
    }
}
