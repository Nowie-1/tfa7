{{-- Shared by create and edit. $customer is a new Customer on create, an existing one on edit. --}}
@php($editing = $customer->exists)

<form method="POST" action="{{ $editing ? route('customers.update', $customer) : route('customers.store') }}" novalidate>
    @csrf
    @if ($editing)
        @method('PUT')
    @endif

    <div class="form-group">
        <label for="full_name">Full Name *</label>
        <input type="text" id="full_name" name="full_name"
               value="{{ old('full_name', $customer->full_name) }}"
               class="@error('full_name') input-error @enderror">
        @error('full_name')
            <div class="error">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="email">Email *</label>
        <input type="email" id="email" name="email"
               value="{{ old('email', $customer->email) }}"
               class="@error('email') input-error @enderror">
        @error('email')
            <div class="error">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="phone">Phone</label>
        <input type="text" id="phone" name="phone"
               value="{{ old('phone', $customer->phone) }}"
               class="@error('phone') input-error @enderror">
        @error('phone')
            <div class="error">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn">{{ $editing ? 'Save Changes' : 'Create Customer' }}</button>
    <a class="btn btn-secondary" href="{{ route('customers.index') }}">Cancel</a>
</form>
