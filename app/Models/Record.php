<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    use HasFactory;

    const getFillable = ['user', 'client', 'client_type', 'date', 'duration', 'type_of_call', 'external_call_score'];

    protected $fillable = Record::getFillable;

    public function scopeUser($query, $user) {
        return $query->where('user', $user);
    }

    public function scopeClient($query, $client) {
        return $query->where('client', $client);
    }

    public function scopeCallType($query, $call_type) {
        return $query->where('type_of_call', $call_type);
    }
}
