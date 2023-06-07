<?php

namespace App\Services;


use App\Repositories\Interfaces\BookingRepositoryInterface;
use App\Repositories\Interfaces\RoomRepositoryInterface;
use App\Repositories\Interfaces\TimeSlotRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class BookingService
{
    protected $bookingRepository;
    protected $roomRepository;
    protected $timeSlotRepository;

    public function __construct(
        BookingRepositoryInterface $bookingRepository,
        RoomRepositoryInterface $roomRepository,
        TimeSlotRepositoryInterface $timeSlotRepository)
    {
        $this->bookingRepository = $bookingRepository;
        $this->roomRepository = $roomRepository;
        $this->timeSlotRepository = $timeSlotRepository;
    }

    public function storeBooking($data)
    {
        $user = Auth::user();
        $timeSlotId = $data->timeSlot;
        $roomId = $data->roomId;
        $bookingParticipants = $data->participants;
        $doesTimeSlotHasCapacity = $this->checkCapacity($timeSlotId, $roomId, $bookingParticipants);
        $isTimeSlotAvailable = $this->checkTimeSlotAvailability($timeSlotId);
        $isBirthday = $this->checkUserBirthday($user);
        if (!$doesTimeSlotHasCapacity) {
            return response('This time slot does not have enough capacity for you! Please select another time.', Response::HTTP_BAD_REQUEST);
        }
        if (!$isTimeSlotAvailable) {
            return response('This time slot is already booked! Please select another time.', Response::HTTP_BAD_REQUEST);
        }
        $totalPrice = $this->calculatePrice($isBirthday, $bookingParticipants, $roomId);
        $isPayedSuccessfully = $this->paymentService($totalPrice, $user);
        if (!$isPayedSuccessfully) {
            return response('Your payment was not successfully! please try again.', Response::HTTP_BAD_REQUEST);
        }
        return $isBirthday;
    }

    private function checkCapacity($timeSlotId, $roomId, $bookingParticipants)
    {
        $room = $this->roomRepository->get($roomId);
        $timeSlot = $this->timeSlotRepository->get($timeSlotId);
        if ($room->max_participants >= $bookingParticipants + $timeSlot->participants) {
            return true;
        }
        return false;
    }

    private function checkUserBirthday($user)
    {
        $birthday = $user->birthday;
        if (Carbon::parse($birthday)->isBirthday()) {
            return true;
        }
        return false;
    }

    private function checkTimeSlotAvailability($timeSlotId)
    {
        $timeSlot = $this->timeSlotRepository->get($timeSlotId);
        if (!$timeSlot->is_booked) {
            return true;
        }
        return false;
    }

    private function calculatePrice($isBirthday, $bookingParticipants, $roomId)
    {
        $room = $this->roomRepository->get($roomId);
        $price = $room->price * $bookingParticipants;
        if ($isBirthday) {
            $price = $price - $price / 10;
        }
        return $price;
    }

    private function paymentService($price, $user)
    {
        return true;
    }

}
