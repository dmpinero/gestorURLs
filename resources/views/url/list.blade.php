<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Listado de URLs</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
</head>
<body>
    <div class="container">
        <table id="urls" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Ir a la web</th>    
                </tr>			
            </thead>
            <tbody>
                @foreach($urls as $url)
                <tr>
                    <td>{{ $url->id }}</td>
                    <td>{{ $url->name }}</td>
                    <td>{{ $url->description }}</td>
                    <td>{{ $url->url }}</td>                                        
                </tr>
                @endforeach                
            </tbody>
        </table>
    </div>
    
    
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#urls').DataTable();
        } );        
    </script>
</body>
</html>