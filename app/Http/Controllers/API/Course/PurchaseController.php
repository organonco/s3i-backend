<?php

namespace App\Http\Controllers\API\Course;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Course\PurchaseCourseRequest;
use App\Models\Course;
use App\Models\Purchase;
use App\Traits\ChecksSubscription;
use Alhelwany\LaravelEcash\DataObjects\PaymentDataObject;
use Alhelwany\LaravelEcash\Enums\CheckoutType;
use Alhelwany\LaravelEcash\Facades\LaravelEcashClient;

/**
 * @group Purchase
 */
class PurchaseController extends Controller
{
    use ChecksSubscription;

    public function purchaseCourse(PurchaseCourseRequest $request)
    {
        $studentId = $this->getAuthenticatedStudent()->id;

        /** @var Course */
        $course = Course::find($request->getCourseId());

        $purchase = Purchase::findExistingPurchase($studentId, $course);
        if (is_null($purchase)) {
            $paymentDataObject = new PaymentDataObject(CheckoutType::CARD, $course->getPrice());
            $paymentDataObject->setRedirectUrl("https://www.s3i.training");

            $payment = LaravelEcashClient::checkout($paymentDataObject);
            $purchase = Purchase::create([
                'purchasable_id' => $course->id,
                'purchasable_type' => Course::class,
                'student_id' => $studentId,
                'ecash_payment_id' => $payment->getId(),
            ]);
        }
        return $purchase->ecashPayment->checkout_url;
    }
}
