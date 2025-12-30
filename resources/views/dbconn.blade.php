<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel & MYSQL DB Connection</title>
    <style>
        table { border-collapse: collapse; margin-top: 1rem; }
        th, td { padding: 8px 12px; border: 1px solid #ccc; }
    </style>
</head>
<body>
    <div>
        <strong>Showing in-memory student data (no database required)</strong>
    </div>

    @if(isset($students) && $students->isNotEmpty())
        <h2>Students (In-memory sample)</h2>
        @php $first = (array) $students->first(); @endphp
        <table>
            <thead>
                <tr>
                    @foreach(array_keys($first) as $col)
                        <th>{{ $col }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach($students as $student)
                    <tr>
                        @foreach((array) $student as $val)
                            <td>{{ $val }}</td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No in-memory student records found.</p>
    @endif
</body>
</html>