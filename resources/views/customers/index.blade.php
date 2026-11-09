@extends('layouts.pos')

@section('page_title', 'Customer Accounts')

@section('body')
    <h1>Customer Accounts</h1>

    <div class="actions">
        <a class="btn" href="{{ route('customers.create') }}">+ Add Customer</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>Customer ID</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            {{-- One table row for each Customer model retrieved from the database --}}
            @foreach ($customers as $customer)
                <tr>
                    <td>C-{{ str_pad($customer->id, 3, '0', STR_PAD_LEFT) }}</td>
                    <td>{{ $customer->full_name }}</td>
                    <td>{{ $customer->email }}</td>
                    <td>{{ $customer->phone }}</td>
                    <td>
                        <a href="{{ route('customers.show', $customer) }}">View</a> |
                        <a href="{{ route('customers.edit', $customer) }}">Edit</a> |
                        <form class="inline-form" method="POST" action="{{ route('customers.destroy', $customer) }}"
                              onsubmit="return confirm('Delete this customer?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-small">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
