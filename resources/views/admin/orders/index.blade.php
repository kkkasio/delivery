@extends('app')
@section('content')
	<div class="container">
		<h3>Pedidos</h3>
		<br><br>
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>ID</th>
					<th>Total</th>
					<th>Data</th>
					<th>Itens</th>
					<th>Entregador</th>
					<th>Status</th>
					<th>Ação</th>
				</tr>
			</thead>
			<tbody>
			@foreach($orders as $order)
	
				<tr>
					<td>{{$order->id}}</td>
					<td>{{$order->total}}</td>
					<td>{{$order->created_at}}</td>
					<td>
						<ul>
						@foreach($order->items as $item)
							<li>{{$item->product->name}}</li>
						@endforeach
						</ul>
					</td>
					<td>
						@if($order->deliveryman)
							{{$order->deliveryman->name}}
						@else
							Sem Nome
						@endif
					</td>
					<td>
						{{ ($order->status == 0) ? 'Pendente' : ($order->status == 1) ? 'A Caminho' : ($order->status == 2) ? 'Entregue' : 'Cancelado' }}
					</td>
					<td><a href="{{route('admin.orders.edit',['id'=>$order->id])}}" class="btn btn-warning btn-sm">Editar</a></td>
				</tr>
			@endforeach
			</tbody>

		</table>
		{!! $orders->render() !!}
	</div>
@endsection