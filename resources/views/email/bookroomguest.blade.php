<h2>Hi {{ $guest->name }},</h2> 
<br>
<p>Your room has been booked successfully.</p>
<p>Booking Details:</p>
<ul>
    <li>Room Number: {{ $room->room->room_no }}</li>
    <li>Price: {{ $room->price }}</li>
    <li>Total Guest: {{ $room->no_of_guest }}</li>
    <li>Status: {{ $room->status }}</li>
    <li>From Date: {{ $room->start_date }}</li>
    <li>To Date: {{ $room->end_date }}</li>
</ul>
<p>This is test mail from Hotel-Management.</p>
