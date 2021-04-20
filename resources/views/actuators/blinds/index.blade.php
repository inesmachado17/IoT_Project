@extends('layouts.app')

@section('content')


     <div class="row">
         <div class="col-10 offset-1">
             <p>Tabela</p>
             <table class="table table-striped table-hover">
                 <thead>
                 <tr>
                     <th>ID</th>
                     <th>Designação</th>
                     <th>Estado</th>
                     <th>Ações</th>
                 </tr>
                 </thead>
                 <tbody>
                 @foreach($blinds as $blind)
                     <tr>
                         <td>{{ $blind['id'] }}</td>
                         <td>{{ $blind['name'] }}</td>
                         <td>{{ $blind['state'] }}</td>
                         <td>
                             <a href="{{ url('/actuators/blinds/'. $blind['id'] . '/edit') }}" class="btn btn-outline-secondary btn-sm" role="button" aria-pressed="true" >
                                 <i class="bi bi-gear"></i>
                             </a>
                         </td>
                     </tr>
                 @endforeach
                 </tbody>
             </table>

             <div class="row">
                <div class="col d-flex justify-content-center">
                    <a href="{{ $prev }}" class="btn btn-primary btn-lg {{ $prev == null ? 'disabled' : '' }}" role="button" aria-pressed="true"  aria-disabled="{{ $prev == null ? 'true' : 'false' }}">Anterior</a>
                    <a href="{{ $next }}" class="btn btn-primary btn-lg ml-2 {{ $next == null ? 'disabled' : '' }}" role="button" aria-pressed="true"  aria-disabled="{{ $next == null }}">Proximo</a>
                </div>
             </div>
         </div>
     </div>

@endsection
