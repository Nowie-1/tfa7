<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    // Customer Accounts page (/customers).
    public function list()
    {
        $customers = Customer::orderBy('id')->get();

        return view('customers.index', ['customers' => $customers]);
    }

    // Show the empty Create Customer form (/customers/create).
    public function create()
    {
        return view('customers.create', ['customer' => new Customer()]);
    }

    // Validate the submitted form, then insert the record.
    public function store(Request $request)
    {
        $validated = $request->validate($this->rules());

        Customer::create($this->withDefaults($validated));

        return redirect()->route('customers.list')
            ->with('status', 'Customer created successfully.');
    }

    // Show the edit form pre-filled with the existing record.
    public function edit(Customer $customer)
    {
        return view('customers.edit', ['customer' => $customer]);
    }

    // Validate the submitted form, then update the record.
    public function update(Request $request, Customer $customer)
    {
        $validated = $request->validate($this->rules());

        $customer->update($this->withDefaults($validated));

        return redirect()->route('customers.list')
            ->with('status', 'Customer updated successfully.');
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
