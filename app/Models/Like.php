<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    const   ENTITY_TYPE_USER = 1,
            ENTITY_TYPE_VACANCY = 2;

    protected $fillable = [
        'userId',
        'entityId',
        'entityType',
    ];

    /**
     * @param int $fromId
     * @param int $toId
     * @param int $entityType
     * @return string like is like set; unlike if unset
     */
    public function setNewState(int $fromId, int $toId, int $entityType) : string {
        $like = $this->query()
            ->where('userId', $fromId)
            ->where('entityId', $toId)
            ->where('entityType', $entityType)
            ->first();

        if ($like) {
            $like->delete();

            return 'unlike';
        } else {
            (new Like([
                'userId' => $fromId,
                'entityId' => $toId,
                'entityType' => $entityType,
            ]))->save();

            return 'like';
        }
    }
}
