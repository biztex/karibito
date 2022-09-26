<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class TransferRequest extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    const APPLYING = 1;
    const TRANSFER_COMPLETED = 2;
    const TRANSFER_FAILURE = 3;

    const STATUS = [
        self::APPLYING => '振込申請中',
        self::TRANSFER_COMPLETED => '振込完了',
        self::TRANSFER_FAILURE => '振込失敗',
    ];

    const EARLY_MONTH = 1;
    const LATE_MONTH = 2;

    const MONTH_SEASON = [
        self::EARLY_MONTH => '上旬',
        self::LATE_MONTH => '下旬',
    ];

    public function scopeUserTransferRequest($query, $user_id)
    {
        return $query->whereUserId($user_id);
    }

    public function scopeRequestDateBetween($query, $date_from, $date_to)
    {
        // 検索範囲の開始日00:00:00から、終了日23:59:59まで
        $date_from = $date_from . ' 00:00:00';
        $date_to = $date_to . ' 23:59:59';

        return $query->whereBetween('requested_at',[$date_from, $date_to]);
    }

    public function scopeRequestSeason($query, $data)
    {
        $year = substr($data, 0, 4);
        $month = substr($data, 4, 2);
        $season = substr($data, 6, 1);

        if($season == self::EARLY_MONTH) {
            $date_from = Carbon::create($year, $month, 1)->firstOfMonth();
            $date_to =  Carbon::create($year, $month, 15);
        } else {
            $date_from = Carbon::create($year, $month, 16);
            $date_to = Carbon::create($year, $month, 1)->lastOfMonth();
        }
        $date_from_string = $date_from . ' 00:00:00';
        $date_to_string = $date_to . ' 23:59:59';

        return $query->requestDateBetween($date_from_string, $date_to_string);

    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transferRequestDetails()
    {
        return $this->hasMany(TransferRequestDetail::class);
    }

}
