@extends('layouts.admin')
@section('title', 'Proveedores')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-sm-6 mb-3">
			<span class="float-left">
				<a class="btn blue darken-4 text-white" href="/proveedores/nuevo" class="btn btn-link">
					<i class="fa fa-plus" aria-hidden="true"></i> Nuevo Proveedor
				</a>
			</span>
		</div>
	</div>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-line-primary">
                <div class=" card-header">
                    <h4>Proveedores</h4>
                </div>
				
                <div class="card-body">                	
                	<ul class="list-inline">
						<li class="list-inline-item">
							<a href="/" class="link_ruta">
								Inicio &nbsp; &nbsp;<i class="fa fa-chevron-right" aria-hidden="true"></i>
							</a>
						</li>
						<li class="list-inline-item">
							<a href="/proveedores" class="link_ruta">
								Proveedores &nbsp; &nbsp;<i class="fa fa-chevron-right" aria-hidden="true"></i>
							</a>
						</li>
					</ul>
                    
                    <div class="row">
                    	<div class="card-body">
	                        <div class="table-responsive">
								<table width="97%" class="table table-striped display ">
									<thead>
										<tr>
											<th >ID</th>
											<th >Nombre</th>
											<th >RUT</th>
											<th>Dirección</th>
											<th >Telefono</th>
											<th >Mail</th>
											
										</tr>
									</thead>

									@foreach($proveedores as $proveedor)
										<tbody>
											<tr>
												<td>
													<a href="/proveedores/detalle/{{ $proveedor->id}}">
														{{ $proveedor->id}}
													</a>
												</td>
												<td>
													<a href="/proveedores/detalle/{{ $proveedor->id}}">
														{{ $proveedor->nombre }}
													</a>
												</td>
												<td>{{ $proveedor->rut}}</td>
												<td>{{ $proveedor->direccion}}</td>
												<td>{{ $proveedor->telefono}}</td>
												<td>{{ $proveedor->mail}}</td>
												
										</tbody>
									@endforeach							
								</table>
							</div>
							
						</div>
                    </div>                    
                </div>                
            </div>
        </div>
    </div>
</div>
@endsection