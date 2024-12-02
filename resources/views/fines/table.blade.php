<table class="table">
    <thead>
        <tr>
            <th>Student Matric Number</th>
            <th>Fine Date</th>
            <th>Fine Time</th>
            <th>Kesalahan</th>
            <th>Dikompaun</th>
            <th>Compounded Expiration</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($fines as $fine)
            <tr>
                <td>{{ $fine->student_matricNum }}</td>
                <td>{{ $fine->fine_date }}</td>
                <td>{{ $fine->fine_time }}</td>
                <td>
                    {{-- Display kesalahan as a comma-separated list if stored as JSON --}}
                    {{ is_array($fine->kesalahan) ? implode(', ', $fine->kesalahan) : $fine->kesalahan }}
                </td>
                <td>{{ $fine->dikompaun }}</td>
                <td>{{ $fine->compounded_expiration ? $fine->compounded_expiration->format('Y-m-d') : '-' }}</td>
                <td>
                    <a href="{{ route('fines.show', $fine->id) }}" class="btn btn-info">View</a>
                    <a href="{{ route('fines.edit', $fine->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('fines.destroy', $fine->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

