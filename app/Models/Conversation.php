<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Conversation extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['name', 'image', 'channel_id'];

    protected $searchableFields = ['*'];

    public function chats()
    {
        return $this->hasMany(Chat::class);
    }

    public function userConversations()
    {
        return $this->hasMany(UserConversation::class);
    }

    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }
}
