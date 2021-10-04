@extends('layouts.admin')
@section('title', 'Apertura de caja')
@section('content')
<div class="container">
	<div class="row">  
	<div class="btn-group">
		<div class="col-sm-12">
			
		<a class="btn btn-md blue darken-4 text-white mb-3" href="/apertura/create" class="btn btn-link">
			<i class="fa fa-user-plus" aria-hidden="true"></i> Nueva apertura
		</a>

		</div>
	</div>
		<div class="col-md-12">
			<div class="card card-line-primary">
				<div class=" card-header">
					<h4>Vista general de la apertura de caja</h4>
				</div>
				<div class="card-body">
					
					<ul class="list-inline">
						<li class="list-inline-item">
							<a href="/" class="link_ruta">
								Inicio &nbsp; &nbsp;<i class="fa fa-chevron-right" aria-hidden="true"></i>
							</a>
						</li>
						<li class="list-inline-item">
							<a href="/apertura" class="link_ruta">
								Apertura
							</a>
						</li>						
					</ul><br>
			
					<div class="table-responsive">
						<table class="table table-responsive-sm table-hover table-outline mb-0 table-sm">
                        <thead class="thead-light">
                            <tr>
                                <th class="text-center">Identificador</th>
                                <th class="text-center">Fecha</th>
                                <th class="text-center">Hora de apertura</th>
                                <th class="text-center">Hora de cierre</th>
                                <th class="text-center">Monto de apertura</th>
                                <th class="text-center">Monto de cierre</th>
                                <th class="text-center">Estado</th>
                                <th class="text-center">Caja</th>
                                <th class="text-center">Opciones</th>
                            </tr>         
							</thead>
							@if (count($cajas)>0)
                                                @foreach ($cajas as $item)
                                                    <tbody>
                                                        <tr>
                                                            <td class="text-center">{{strtoupper($item->codigo)}}</td>
                                                            <td class="text-center">{{$item->fecha}}</td>
                                                            <td class="text-center">{{$item->hora}}</td>
                                                            <td class="text-center">
                                                                @if (!$item->hora_cierre)
                                                                <span class="badge badge-dark">Aun no cerrada</span>
                                                                @else
                                                                    {{$item->hora_cierre}}
                                                                @endif        
                                                            </td>
                                                            <td class="text-center">${{$item->monto}} USD</td>
                                                            <td class="text-center">
                                                                @if ($item->monto_cierre == '0.00' || !$item->monto_cierre)
                                                                    <span class="badge badge-dark">Aun no cerrada</span>
                                                                @else
                                                                {{$config->prefijo_moneda}}{{$item->monto_cierre}} {{$config->currency}}
                                                                @endif
                                                            </td>
                                                            <td class="text-center">{{$item->estado}}</td>
                                                            <td class="text-center">{{$item->caja}}</td>
                                                            <td class="text-center">
                                                               
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                @endforeach
                                              @else
                                        <tbody>
                                            <tr>
                                                <td colspan="8" class="text-center">No se aperturó alguna caja este día.</td>
                                            </tr>
                                        </tbody>
                                    @endif
                                </table>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	@include('partials.mensajes');
</div>

@endsection
