<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        h2 { text-align: center; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; }
        th { background: #2563eb; color: #fff; padding: 8px; font-size: 12px; text-align: left; }
        td { padding: 8px; font-size: 12px; border-bottom: 1px solid #e5e7eb; }
        tr:nth-child(even) td { background: #f3f4f6; }
    </style>
</head>
<body>
<h2>Instructor List</h2>
<table>
    <tr>
        <th>ID</th><th>Emp No</th><th>Name</th><th>Mobile</th><th>Hire Date</th><th>Salary</th><th>Department</th><th>Qualification</th>
    </tr>
    @foreach($instructors as $instructor)
        <tr>
            <td>{{ $instructor->id }}</td>
            <td>{{ $instructor->emp_no }}</td>
            <td>{{ $instructor->name }}</td>
            <td>{{ $instructor->mobile_no }}</td>
            <td>{{ $instructor->hire_date }}</td>
            <td>{{ $instructor->salary }}</td>
            <td>{{ $instructor->department }}</td>
            <td>{{ $instructor->qualification }}</td>
        </tr>
    @endforeach
</table>
</body>
</html>
