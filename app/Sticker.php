<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sticker extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'unique_id', // Use the custom ID
        'student_matricNumber',
        'validity_date',
        'status_sticker',
    ];
    const STATUS_REQUESTED = 'requested';
    const STATUS_APPROVED = 'approved';
    const STATUS_REJECTED = 'rejected';

    /**
     * Automatically cast these attributes to Carbon instances.
     *
     * @var array
     */
    protected $dates = [
        'validity_date',
    ];

    /**
     * Get the student that owns this sticker.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'student_matricNumber', 'matric_number');
    }

    /**
     * Generate the next unique sticker ID.
     * (This assumes IDs follow the 'ARAU-XXXXX' pattern.)
     *
     * @return string
     */
    public static function generateNextUniqueId()
    {
        $lastSticker = self::latest('id')->first();
        if ($lastSticker) {
            $lastNumber = (int) substr($lastSticker->unique_id, 5); // Get the last number part
            $nextNumber = str_pad($lastNumber + 1, 5, '0', STR_PAD_LEFT);
        } else {
            $nextNumber = '00001';
        }

        return 'ARAU-' . $nextNumber;
    }
    
}
