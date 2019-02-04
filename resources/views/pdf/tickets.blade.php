@extends('pdf.layout')

@section('content')
    @foreach($order->tickets as $ticket)
        @include('pdf.ticket.ticket', $ticket)
        <div class="page-break"></div>
    @endforeach
@endsection
