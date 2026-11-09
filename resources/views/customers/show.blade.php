@extends('layouts.pos')

@section('page_title', 'Customer Details')

@section('body')
    <h1>Customer Details</h1>

    <dl class="details">
        <dt>Customer ID</dt>
        <dd>C-{{ str_pad($customer->id, 3, '0', STR_PAD_LEFT) }}</dd>
        <dt>Full Name</dt>
        <dd>{{ $customer->full_name }}</dd>
        <dt>Email</dt>
        <dd>{{ $customer->email }}</dd>
        <dt>Phone</dt>
        <dd>{{ $customer->phone ?: '-' }}</dd>
    </dl>

    <a class="btn" href="{{ route('customers.edit', $customer) }}">Edit</a>
    <a class="btn btn-secondary" href="{{ route('customers.index') }}">Back to list</a>
@endsection
