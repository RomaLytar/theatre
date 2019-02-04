<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div class="order">
        <h1 class="order__title">You have bought tickets successfully</h1>
        <div class="order__number">Your order number is {{ $order->id }}</div>
    </div>
    <div class="tickets">
        <div class="tickets__title">Your tickets</div>
        @foreach($order->tickets as $ticket)
            <div class="tickets-item">
                <div class="ticket__series">№ кв.: {{ $ticket->id }}</div>
                <div class="event__title">Назва: {{ $ticket->performanceCalendar->performance->translate->title }}</div>
                <div class="event__date">Дата: {{ \Jenssegers\Date\Date::parse($ticket->performanceCalendar->date)->format('j F Y') }}</div>
                <div class="event__time">Початок: {{ \Jenssegers\Date\Date::parse($ticket->performanceCalendar->date)->format('H:i') }}</div>
                <div class="ticket__hall">Зал: {{ $ticket->seatPrice->seat->row->section->hall->translate->title }}</div>
                <div class="ticket__section">Секція: {{ $ticket->seatPrice->seat->row->section->translate->title }}</div>
                <div class="ticket__row">Ряд: {{ $ticket->seatPrice->seat->row->number }}</div>
                <div class="ticket__seat">Місце: {{ $ticket->seatPrice->seat->number }}</div>
                <div class="ticket__price">Ціна: {{ $ticket->seatPrice->priceZone->price }}</div>
                <img src="data:image/png;base64, {!! \DNS1D::getBarcodePNG($order->id . '-' . $ticket->id, "C39") !!} " alt="barcode" />
            </div>
            <br>
        @endforeach
    </div>

</body>
</html>