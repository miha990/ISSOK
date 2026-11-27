
<div>
    <h1>Pets</h1>

    <a href="{{ route('petshops.create') }}">Add Pet</a>

    <p>Total number of pets: {{ $totalPets }}</p>
    <p>Pets without scheduled vaccination: {{ $petsWithoutVaccination }}</p>

    @if($pets->isEmpty())
        <p>No pets found.</p>
    @else
        <table border="1">
            <thead>
            <tr>
                <th>Name</th>
                <th>Type</th>
                <th>Breed</th>
                <th>Birth Date</th>
                <th>Owner First Name</th>
                <th>Owner Last Name</th>
                <th>Owner Phone</th>
                <th>Next Vaccination Date</th>
                <th>Actions</th>
            </tr>
            </thead>

            <tbody>
            @foreach ($pets as $pet)
                <tr>
                    <td>{{ $pet->name }}</td>
                    <td>{{ $pet->type }}</td>
                    <td>{{ $pet->breed ?? '-' }}</td>
                    <td>{{ $pet->birth_date }}</td>
                    <td>{{ $pet->owner_first_name }}</td>
                    <td>{{ $pet->owner_last_name }}</td>
                    <td>{{ $pet->owner_phone }}</td>
                    <td>{{ $pet->next_vaccination_date ?? 'Не е закажана' }}</td>

                    <td>
                        <a href="{{ route('petshops.edit', $pet->id) }}">Update</a>

                        <form action="{{ route('petshops.destroy', $pet->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
</div>
