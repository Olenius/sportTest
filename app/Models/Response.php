<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    use HasFactory;

    protected $fillable = [
        'vacancyId',
        'userId',
        'message',
        ];

    public function getList($vacancyId) : array{
        return $this->query()
            ->where('vacancyId', $vacancyId)
            ->limit(50)
            ->orderByDesc(self::getUpdatedAtColumn())
            ->get()->toArray();
    }


}
