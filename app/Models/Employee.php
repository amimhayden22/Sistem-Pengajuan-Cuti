<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $table = 'employees';
    protected $fillable = [
        'position_id', 'user_id', 'code', 'name', 'place_of_birth', 'date_of_birth', 'email',
        'address', 'phone', 'religion', 'education', 'bank', 'account_number'
    ];

    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
