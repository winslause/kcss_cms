<form method="POST" action="{{ route('case.store') }}">
    @csrf
    <select name="client_id" required>
        @foreach($clients as $client)
            <option value="{{ $client->id }}">{{ $client->name }} - {{ $client->nationalid }}</option>
        @endforeach
    </select>
    <!-- Other form fields like title, status, description -->
</form>