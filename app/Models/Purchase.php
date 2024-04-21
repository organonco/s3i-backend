<?php

namespace App\Models;

use App\Interfaces\Purchasable;
use Illuminate\Database\Eloquent\Model;
use Alhelwany\LaravelEcash\Models\EcashPayment;

class Purchase extends Model
{
    protected $fillable = ['student_id', 'purchasable_id', 'purchasable_type', 'ecash_payment_id'];

    public function ecashPayment()
    {
        return $this->belongsTo(ecashPayment::class);
    }

    public function purchasable()
    {
        return $this->morphTo('purchasable');
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
    public static function findExistingPurchase(int $studentId, Purchasable $purchasable)
    {
        return self::query()
            ->where('student_id', $studentId)
            ->where("purchasable_type", $purchasable->getType())
            ->where('purchasable_id', $purchasable->getId())
            ->first();
    }
    public static function findByPayment(string $payment_id)
    {
        return self::query()->where('ecash_payment_id', $payment_id)->first();
    }
}
