<?php

namespace App\Listeners;

use App\Models\Course;
use App\Models\Purchase;
use App\Notifications\PurchaseFailed;
use App\Notifications\PurchasePaid;
use App\Notifications\PurchaseProcessing;
use Alhelwany\LaravelEcash\Enums\PaymentStatus;
use Alhelwany\LaravelEcash\Events\PaymentStatusUpdated as EventsPaymentStatusUpdated;

class AddStudentToCourse
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(EventsPaymentStatusUpdated $event): void
    {
        $payment = $event->getPaymentModel();
        $purchase = Purchase::findByPayment($payment->id);
        $purchaseable = $purchase->purchasable;
        $student = $purchase->student;
        if ($purchaseable instanceof Course) {
            if ($payment->status == PaymentStatus::PROCESSING)
                $student->notify(new PurchaseProcessing());
            elseif ($payment->status == PaymentStatus::FAILED)
                $student->notify(new PurchaseFailed());
            elseif ($payment->status == PaymentStatus::PAID) {
                $purchaseable->addStudent($purchase->student);
                $student->notify(new PurchasePaid($purchaseable));
            }
        }
    }
}
