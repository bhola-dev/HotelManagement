<h2>Hi {{ $admin->name }},</h2> 
<br>
<p>A user has been booked a room.</p>
<p>Booking Details:</p>
<ul>
    <li>Guest Name: {{ $guest->name }}</li>
    <li>Guest Email: {{ $guest->email }}</li>
    <li>Room Number: {{ $room->room->room_no }}</li>
    <li>Price: {{ $room->price }}</li>
    <li>Total Guest: {{ $room->no_of_guest }}</li>
    <li>Status: {{ $room->status }}</li>
    <li>From Date: {{ $room->start_date }}</li>
    <li>To Date: {{ $room->end_date }}</li>
</ul>
<p>This is test mail from Hotel-Management.</p>
