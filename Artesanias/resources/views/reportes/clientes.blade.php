<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clientes</title>
    <style>
        h1{
            text-align: center;
            color:red;
        }
        thead{
            background-color:#fcfcfc;
            width: 100%;
            height: 50px;
        }
    </style>
</head>
<body>
    <h1>REPORTE DE CLIENTES DEL {{ $fecha }}</h1>
    <table>
    <thead>
            <tr>
              <th>Nombre</th>
              <th>Email</th>
              <th>Dirección</th>
              <th>Ciudad</th>
            
            </tr>
          </thead>
          
          <tbody>
            @foreach($datos as $p)
              <tr>
               
                <td>{{ $p->name }}</td>
                <td>{{ $p->email }}</td>
                <td>{{ $p->address }}</td>
                <td>{{ $p->city }}</td>
                </tr>
        
                @endforeach
                </tbody>
                </table>
</body>
</html>