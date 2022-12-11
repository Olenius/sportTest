<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class JobVacancy extends Model
{
    use HasFactory;

    protected $table = 'job_vacancies';

    const IS_DELETED_YES = 1,
          IS_DELETED_NO = 0;

    const   FIELD_ID = 'id',
            FIELD_USER_ID = 'userId',
            FIELD_TITLE = 'title',
            FIELD_DESCRIPTION = 'description',
            FIELD_IS_DELETED = 'is_deleted';

    protected $fillable = [
        self::FIELD_TITLE,
        self::FIELD_DESCRIPTION,
        self::FIELD_USER_ID,
        self::FIELD_DESCRIPTION,
    ];

    public function user() {
        return $this->hasOne(User::class, 'id', self::FIELD_USER_ID);
    }

    public function getForDashboard() : array {
        return $this->query()
                            ->where(self::FIELD_IS_DELETED, self::IS_DELETED_NO)
                            ->limit(50)
                            ->orderByDesc(self::getUpdatedAtColumn())
                            ->get()->toArray();
    }

    public function edit($data) {
        $this->update($data);
    }

    public function delete() {
        $this->is_Deleted = self::IS_DELETED_YES;
        $this->update();
    }

    public function isOwner() : bool {
        return Auth::id() === $this->userId;
    }
}
