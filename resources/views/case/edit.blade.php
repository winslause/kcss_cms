<form method="POST" action="{{ route('case.update', $case->id) }}">
    @csrf
    @method('PUT')
    <select name="client_id" required>
        @foreach($clients as $client)
            <option value="{{ $client->id }}" {{ $case->client_id == $client->id ? 'selected' : '' }}>
                {{ $client->name }} - {{ $client->nationalid }}
            </option>
        @endforeach
    </select>
    <!-- Other form fields like title, status, description -->
</form>