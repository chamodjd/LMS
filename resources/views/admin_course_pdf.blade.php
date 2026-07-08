<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        h2 { text-align: center; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; }
        th { background: #2563eb; color: #fff; padding: 8px; font-size: 13px; text-align: left; }
        td { padding: 8px; font-size: 13px; border-bottom: 1px solid #e5e7eb; }
        tr:nth-child(even) td { background: #f3f4f6; }
    </style>
</head>
<body>
<h2>Course List</h2>
<table>
    <tr>
        <th>ID</th><th>Course Name</th><th>Duration</th><th>Price</th>
    </tr>
    @foreach($courses as $course)
        <tr>
            <td>{{ $course->id }}</td>
            <td>{{ $course->name }}</td>
            <td>{{ $course->duration }} years</td>
            <td>${{ number_format($course->price, 2) }}</td>
        </tr>
    @endforeach
</table>
</body>
</html>
