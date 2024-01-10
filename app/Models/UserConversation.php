<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserConversation extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['conversation_id', 'user_id'];

    protected $searchableFields = ['*'];

    protected $table = 'user_conversations';

    public function conversation()
    {
        return $this->belongsTo(Conversation::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
