@extends('pdf.layout')

@section('content')
    @include('pdf.ticket.ticket', $ticket)
@endsection
