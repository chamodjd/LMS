
    @forelse ($students as $student)
        <tr>
            <td>{{ $student->id }}</td>
            <td>{{ $student->reg_no }}</td>
            <td>{{ $student->name }}</td>
            <td>{{ $student->address }}</td>
            <td>{{ $student->dob }}</td>
            <td>{{ $student->degree }}</td>
            <td>
                <button type="button" class="btn btn-warning btn-sm me-1" onclick="openUpdateModal({{ $student->id }})">Update</button>

                <button type="button" class="btn bg-danger btn-sm" onclick="confirmDelete({{ $student->id }})">Delete</button>
                <form id="delete-form-{{ $student->id }}" action="/delete/{{ $student->id }}" method="POST" style="display:none">
                    @csrf
                    @method('DELETE')
                </form>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="6" style="text-align:center;padding:16px;color:#8A8AA3;">No students yet.</td>
        </tr>
    @endforelse

