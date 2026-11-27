
<h1>Add Pet</h1>

<form action="{{ route('petshops.store') }}" method="POST">
    @csrf

    <label for="name">Pet Name:</label><br>
    <input type="text" id="name" name="name" value="{{ old('name') }}" required><br><br>

    <label for="type">Pet Type:</label><br>
    <select id="type" name="type" required>
        <option value="">Select type</option>
        <option value="Dog" {{ old('type') == 'Dog' ? 'selected' : '' }}>Dog</option>
        <option value="Cat" {{ old('type') == 'Cat' ? 'selected' : '' }}>Cat</option>
        <option value="Bird" {{ old('type') == 'Bird' ? 'selected' : '' }}>Bird</option>
        <option value="Other" {{ old('type') == 'Other' ? 'selected' : '' }}>Other</option>
    </select><br><br>

    <label for="breed">Breed:</label><br>
    <input type="text" id="breed" name="breed" value="{{ old('breed') }}"><br><br>

    <label for="birth_date">Birth Date:</label><br>
    <input type="date" id="birth_date" name="birth_date" value="{{ old('birth_date') }}" required><br><br>

    <label for="owner_first_name">Owner First Name:</label><br>
    <input type="text" id="owner_first_name" name="owner_first_name"
           value="{{ old('owner_first_name') }}" required><br><br>

    <label for="owner_last_name">Owner Last Name:</label><br>
    <input type="text" id="owner_last_name" name="owner_last_name"
           value="{{ old('owner_last_name') }}" required><br><br>

    <label for="owner_phone">Owner Phone:</label><br>
    <input type="text" id="owner_phone" name="owner_phone"
           value="{{ old('owner_phone') }}" required><br><br>

    <label for="next_vaccination_date">Next Vaccination Date:</label><br>
    <input type="date" id="next_vaccination_date" name="next_vaccination_date"
           value="{{ old('next_vaccination_date') }}"><br><br>

    <button type="submit">Create Pet</button>
</form>
