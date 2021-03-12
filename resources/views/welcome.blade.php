<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Elenco risorse</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <link rel="stylesheet" href="/css/app.css">

    </head>
    <body class="antialiased">
        <div class="container py-5">
            <div class="row">
                <div class="col-12">
                    <h2>Elenco Risorse</h2>
                    <table class="table">
                        <thead class="thead-dark">
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Risorsa</th>
                            <th scope="col">Reparto</th>
                            <th scope="col">Tasks</th>
                            <th scope="col">Valore Tasks</th>
                            <th scope="col">Data Tasks</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($resources as $r)
                                <tr>
                                <th scope="row">{{$r[0]->id}}</th>
                                <td>{{$r[0]->name}} {{$r[0]->surname}}</td>
                                <td>{{$r[0]->department}}</td>
                                <td>
                                    {{-- {{$r[0]->task}} --}}
                                    @foreach ($r as $rtask)
                                        {{$rtask->task}}@if(!$loop->last), @endif 
                                    @endforeach
                                </td>
                                <td>
                                    <?php $sum = 0 ?>

                                    @foreach ($r as $rtask)
                                        <?php $sum += $rtask->tprice ?>
                                        
                                    @endforeach
                                        {{$sum}}
                                </td>
                                <td>
                                    @foreach ($r as $rtask)
                                    {{\Carbon\Carbon::parse($rtask->date)->format('d M Y')}}@if(!$loop->last), @endif 
                                    @endforeach
                                </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-6 mx-auto">
                    <form action="{{route('filter')}}" method="POST">
                        @csrf
                        <span>filtra da:</span>
                        <input type="date" name="from" class="mr-4">
                        <span>a:</span>
                        <input type="date" name="to" class="mr-4">
                        <button> invia </button>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
