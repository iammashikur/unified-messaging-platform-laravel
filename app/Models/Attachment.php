<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Attachment extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['chat_id'];

    protected $searchableFields = ['*'];

    public function chat()
    {
        return $this->belongsTo(Chat::class);
    }
}
