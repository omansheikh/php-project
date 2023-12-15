<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SharedFile extends Model
{
    protected $fillable = ['file_id', 'user_id', "shared_with_email", 'shared_with', 'permission_level'];

    // Define relationships or additional methods related to shared files here
}
