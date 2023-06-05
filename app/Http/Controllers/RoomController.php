<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Traits\HMResponse;
use App\Jobs\EmailQueueJob;
use App\Models\RoomBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RoomController extends Controller
{
    use HMResponse;

    public function index(Request $request)
    {
        $page_limit = request('page_limit') ?? 10;
        $paginator = 'paginate';
        if (request('paginator') == 'simple') {
            $paginator = 'simplePaginate';
        }

        $search = $request->q;

        $rooms = Room::when($search, function ($query) use($search) {
                $query->where('room_no', 'like', "%$search%");
            })
            ->$paginator($page_limit);

        return $this->success($rooms, "Rooms found");
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'payload.room_no' => 'required',
            'payload.price' => 'required|numeric',
            'payload.guest_capacity' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return $this->validationError($validator->errors()->first());
        }

        $req = $request->payload;
        
        $room = Room::create([
            'room_no' => $req['room_no'],
            'price' => $req['price'],
            'guest_capacity' => $req['guest_capacity'],
            'status' => $req['status']
        ]);

        if (!$room) {
            return $this->validationError("Room details not saved");
        }
        
        return $this->success($room, "Room details saved");
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'payload.id' => 'required|exists:rooms,id',
            'payload.room_no' => 'required',
            'payload.price' => 'required|numeric',
            'payload.guest_capacity' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return $this->validationError($validator->errors()->first());
        }

        $req = $request->payload;

        $room = Room::find($req['id']);
        
        $updated = $room->update([
            'room_no' => $req['room_no'],
            'price' => $req['price'],
            'guest_capacity' => $req['guest_capacity'],
            'status' => $req['status']
        ]);

        if (!$updated) {
            return $this->validationError("Room details not updated");
        }
        
        return $this->success($room, "Room details updated");
    }

    public function destroy(Request $request)
    {
        $roomId = $request->id;

        $room = Room::find($roomId);

        if (empty($room)) {
            return $this->validationError('Room not exist');
        }

        $room->delete();

        return $this->success([], "Room deleted");
    }

    public function bookRoom(Request $request)
    {
        $user = auth()->user();
        
        $validator = Validator::make($request->all(), [
            'payload.room_id' => 'required',
            'payload.no_of_guest' => 'required|numeric',
            'payload.start_date' => 'required|date',
            'payload.end_date' => 'required|date',
        ]);

        if ($validator->fails()) {
            return $this->validationError($validator->errors()->first());
        }
        
        $req = $request->payload;

        // $checkBooking = RoomBooking::where('room_id', $req['room_id'])->whereNotIn('status', ['Cancealed','Completed'])->get();
        $checkBooking = RoomBooking::where('room_id', $req['room_id'])->where('status', 'Booked')->get();
        if ($checkBooking->isNotEmpty()) {
            return $this->validationError("Room already booked");
        }

        $room = Room::find($req['room_id']);

        if($req['no_of_guest'] > $room['guest_capacity']) {
            return $this->validationError("Allowed only {$room['guest_capacity']} guest");
        }

        $roomBooking = RoomBooking::create([
            'room_id' => $req['room_id'],
            'guest_id' => $user['id'],
            'price' => $room['price'],
            'no_of_guest' => $req['no_of_guest'],
            'status' => "Booked",
            'start_date' => $req['start_date'],
            'end_date' => $req['end_date']
        ]);

        if (!$roomBooking) {
            return $this->validationError("Room not booked");
        }

        $bookDetails = [
            'room_id' => $req['room_id'],
            'guest_id' => $user['id']
        ];

        dispatch(new EmailQueueJob($bookDetails));
        
        return $this->success($room, "Room booked");
    }

    public function checkRoomAvail(Request $request)
    {

        $room_id = $request->room_id;

        if(empty($room_id)) {
            return $this->validationError("Please select room");
        }

        $checkBooking = RoomBooking::where('room_id', $room_id)->where('status', 'Booked')->get();
        if ($checkBooking->isNotEmpty()) {
            return $this->validationError("Room not available for book now");
        }

        return $this->success([], "Room available for book now");
    }

    public function availRoomList()
    {
        $page_limit = request('page_limit') ?? 10;
        $paginator = 'paginate';
        if (request('paginator') == 'simple') {
            $paginator = 'simplePaginate';
        }

        $rmBook = RoomBooking::where('status', 'Booked')->pluck('room_id')->all();
        $availRooms = Room::whereNotIn('id', $rmBook)->$paginator($page_limit);

        return $this->success($availRooms, "Room available");
    }

    public function cancelBooking(Request $request)
    {
        $user = auth()->user();
        
        $validator = Validator::make($request->all(), [
            'payload.room_id' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->validationError($validator->errors()->first());
        }

        $req = $request->payload;
        
        $checkRMBook = RoomBooking::where('room_id', $req['room_id'])->where('guest_id', $user->id)->where('status', 'Booked')->first();

        if (!$checkRMBook) {
            return $this->validationError("Room not found to cancel");
        }

        RoomBooking::where('id', $checkRMBook->id)
            ->update([
                'status' => 'Cancealed'
            ]);

        return $this->success([], "Room cancealed successfully");
    }
}
