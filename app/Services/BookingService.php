<?php

namespace App\Services;

use App\Models\Booking;
use App\Repositories\Interfaces\BookingRepositoryInterface;
use App\Repositories\Interfaces\RoomRepositoryInterface;
use App\Repositories\Interfaces\TimeSlotRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        $timeSlot = $this->timeSlotRepository->get($data->timeSlot);
        $room = $this->roomRepository->get($data->roomId);
        if (!isset($timeSlot)) {
            return response('time slot does not found!', Response::HTTP_BAD_REQUEST);
        }
        if (!isset($room)) {
            return response('Scape room not found!', Response::HTTP_BAD_REQUEST);
        }
        $bookingParticipants = $data->participants;
        $doesTimeSlotHasCapacity = $this->checkCapacity($timeSlot, $room, $bookingParticipants);
        $isTimeSlotAvailable = $this->checkTimeSlotAvailability($timeSlot);
        $isBirthday = $this->checkUserBirthday($user);
        if (!$doesTimeSlotHasCapacity) {
            return response('This time slot does not have enough capacity for you! Please select another time.', Response::HTTP_BAD_REQUEST);
        }
        if (!$isTimeSlotAvailable) {
            return response('This time slot is already booked! Please select another time.', Response::HTTP_BAD_REQUEST);
        }
        $totalPrice = $this->calculatePrice($isBirthday, $bookingParticipants, $room);
        $isPayedSuccessfully = $this->paymentService($totalPrice, $user);
        if (!$isPayedSuccessfully) {
            return response('Your payment was not successfully! please try again.', Response::HTTP_BAD_REQUEST);
        }
        $isDuplicateBooking = $this->checkDuplicateBooking($user->id, $timeSlot->id, $room->id);
        if ($isDuplicateBooking) {
            return response('You already booked this room on this time slot!', Response::HTTP_BAD_REQUEST);
        }
        DB::beginTransaction();
        $booking = $this->bookingRepository->save([
            'user_id' => $user->id,
            'room_id' => $room->id,
            'time_slot_id' => $timeSlot->id,
            'birthday_discount' => $isBirthday,
            'count' => $bookingParticipants,
        ]);
        $this->timeSlotRepository->update($timeSlot, [
            'participants' => $timeSlot->participants + $bookingParticipants,
            'is_booked' => $room->max_participants == $timeSlot->participants + $bookingParticipants
        ]);
        DB::commit();
        return response(['data' => $booking], Response::HTTP_OK);
    }

    public function getBookingList()
    {
        return $this->bookingRepository->getBookingsByUserId(Auth::user()->id);
    }

    public function deleteBooking($id)
    {
        $booking = $this->bookingRepository->get($id);
        if (!$booking) {
            return response('Booking not found!', Response::HTTP_BAD_REQUEST);
        }
        $isCancelationPossible = $this->checkCancelationRules($booking);
        if (!$isCancelationPossible) {
            return response('It is too late to cancel this booking!', Response::HTTP_BAD_REQUEST);
        }
        $timeSlot = $this->timeSlotRepository->get($booking->time_slot_id);
        DB::beginTransaction();

        //reduce time slot participants and turn is_booked status to false
        $this->timeSlotRepository->update($timeSlot, [
            'participants' => $timeSlot->participants - $booking->count,
            'is_booked' => false
        ]);

        //delete the booking
        $this->bookingRepository->delete($booking);
        //TODO return booking price to the balance of user
        DB::commit();
        return response(['data' =>'Booking with id ' . $id . ' canceled successfully!'], Response::HTTP_OK);
    }

    private function checkCancelationRules($booking)
    {
        //TODO think what other rules needed to be checked here!
        if ($booking->timeSlot->start >= Carbon::now()) {
            return true;
        }
        return false;
    }

    private function checkCapacity($timeSlot, $room, $bookingParticipants)
    {
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

    private function checkTimeSlotAvailability($timeSlot)
    {
        if (!$timeSlot->is_booked) {
            return true;
        }
        return false;
    }

    private function calculatePrice($isBirthday, $bookingParticipants, $room)
    {
        $price = $room->price * $bookingParticipants;
        if ($isBirthday) {
            $price = $price - $price / 10;
        }
        return $price;
    }

    private function paymentService($price, $user)
    {
        //Do payment stuff
        return true;
    }

    private function checkDuplicateBooking($userId, $timeSlotId, $roomId)
    {
        if(Booking::whereUserId($userId)->whereTimeSlotId($timeSlotId)->whereRoomId($roomId)->first()) {
            return true;
        }
        return false;
    }
}
