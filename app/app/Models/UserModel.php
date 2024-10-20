<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = "users";
    protected $primaryKey = "id";
    protected $allowedFields = ["name", "email", "password", "profile_pic", "role", "email_verified", "admin_blocked_email", "created_at", "updated_at"];
}
