<!DOCTYPE html>
<html>
<head>
    <title>Student List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f9fafb;
            padding: 40px;
        }
        h2 {
            text-align: center;
            color: #111827;
            margin-bottom: 30px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
        th {
            background: #2563eb;
            color: #fff;
            padding: 12px;
            text-align: left;
            font-size: 14px;
        }
        td {
            padding: 10px 12px;
            font-size: 14px;
            border-bottom: 1px solid #e5e7eb;
        }
        tr:nth-child(even) td {
            background: #f9fafb;
        }
        .btn-row {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 20px;
        }
        .btn {
            padding: 10px 18px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            border: none;
            cursor: pointer;
        }
        .btn-download {
            background: #16a34a;
            color: #fff;
        }
        .btn-back {
            background: #6b7280;
            color: #fff;
        }
    </style>
</head>
<body>

<h2>Student List</h2>

<table>
    <tr>
        <th>ID</th>
        <th>Reg No</th>
        <th>Name</th>
        <th>Address</th>
        <th>DOB</th>
        <th>Degree</th>
    </tr>
    @foreach($students as $student)
        <tr>
            <td>{{ $student->id }}</td>
            <td>{{ $student->reg_no }}</td>
            <td>{{ $student->name }}</td>
            <td>{{ $student->address }}</td>
            <td>{{ $student->dob }}</td>
            <td>{{ $student->degree }}</td>
        </tr>
    @endforeach
</table>

<div class="btn-row">
    <a href="{{ asset('exports/students.pdf') }}" download class="btn btn-download">
        <i class="fa fa-download"></i> Download PDF
    </a>
    <a href="{{ route('admin.students') }}" class="btn btn-back">
        <i class="fa fa-arrow-left"></i> Back to List
    </a>
</div>

</body>
</html>
