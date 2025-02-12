<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data SPM</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Data SPM</h1>
    <table>
        <thead>
            <tr>
              
                <th>No SPM</th>
                <th>Uraian SPM</th>
                <th>Nominal SPM</th>
                <th>Tanggal Dibuat</th>
                
            </tr>
        </thead>
        <tbody>
            @foreach ($dataspm as $data)
                <tr>
                    <td>{{ $data->nospm }}</td>
                    <td>{{ $data->uraian}}</td>
                    <td>{{ $data->nominal_spm}}</td>
                    <td>{{ $data->tanggal_input }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
