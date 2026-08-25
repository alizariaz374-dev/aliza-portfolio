<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        "id",
        "full_name",
        "email",
        "phone_no",
        "about",
        "certificate",
        "certificate_description",
        "linkedin_url",
        "git_url",
        "web_url",
        "avatar_url"
    ];
}
