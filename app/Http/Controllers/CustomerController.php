<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    // List all customers (GET /customers).
    public function index()
    {
        $customers = Customer::orderBy('id')->get();

        return view('customers.index', ['customers' => $customers]);
    }

    // Show the empty create form (GET /customers/create).
    public function create()
    {
        return view('customers.create', ['customer' => new Customer()]);
    }

    // Validate the form, then insert the record (POST /customers).
    public function store(Request $request)
    {
        $validated = $request->validate($this->rules());

        Customer::create($this->withDefaults($validated));

        return redirect()->route('customers.index')
            ->with('status', 'Customer created successfully.');
    }

    // Show one customer (GET /customers/{customer}).
    public function show(Customer $customer)
    {
        return view('customers.show', ['customer' => $customer]);
    }

    // Show the pre-filled edit form (GET /customers/{customer}/edit).
    public function edit(Customer $customer)
    {
        return view('customers.edit', ['customer' => $customer]);
    }

    // Validate the form, then update the record (PUT /customers/{customer}).
    public function update(Request $request, Customer $customer)
    {
        $validated = $request->validate($this->rules());

        $customer->update($this->withDefaults($validated));

        return redirect()->route('customers.index')
            ->with('status', 'Customer updated successfully.');
    }

    // Delete the record (DELETE /customers/{customer}).
    public function destroy(Customer $customer)
    {
        $customer->delete();

        return redirect()->route('customers.index')
            ->with('status', 'Customer deleted successfully.');
    }

    // Same rules for create and update.
    private function rules(): array
    {
        return [
            'full_name' => ['required', 'string', 'max:255'],
            'email'     => ['required', 'email', 'max:255'],
            'phone'     => ['nullable', 'string', 'max:30'],
        ];
    }

    // The phone column is NOT NULL, so store an empty string when it is left blank.
    private function withDefaults(array $validated): array
    {
        $validated['phone'] = $validated['phone'] ?? '';

        return $validated;
    }
}
