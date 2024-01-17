<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>
        .table-dark {
            background-color: #212121;
            color: #fff;
        }

        .table-dark thead tr {
            background-color: #161616;
            color: #fff;
        }

        .table-dark th,
        .table-dark td {
            padding: 10px 15px;
            border: 1px solid #161616;
        }

        .footer {
            background-color: #212121;
            color: #fff;
            padding: 30px;
        }

        .footer .copyright {
            text-align: center;
        }

        .footer .social-links {
            display: flex;
            justify-content: center;
        }

        .footer .social-links li {
            margin-right: 10px;
        }

        .footer .social-links a {
            text-decoration: none;
            color: #fff;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>
<body class="bodybg">
<header class="bg-dark text-white text-center p-3">
    <h1></h1>
</header>

<div class="container ">
    <h1></h1>


    <table dir="rtl" class="table table-hover table-striped tablebg">
        <thead>
        <tr class="text-center">
            <th scope="col">#</th>
            <th scope="col">Salary</th>
            <th scope="col">Experience</th>
            <th scope="col">Link</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $row)
            <tr class="@if($row->is_used == 1) bg-danger @endif text-center">
                <th scope="row">{{ $loop->iteration }}</th>
                <td>{{ $row->salary }}</td>
                <td>{{ $row->experience }}</td>
                <td>
                    <a href="{{ route('seen',['link'=>$row->id]) }}">
                        <button type="button" class="btn btn-secondary">visit ad</button>
                    </a>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>


</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.css"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOgOMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
</body>
</html>
