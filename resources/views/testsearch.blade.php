<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
	<form action="{{route('getSearch')}}" method="get">
		<input type="text" name="keyword">
		{{-- {{csrf_field()}} --}}
		<input type="submit" value="Search">
	</form>
	<br>
			<table class="table table-bordered">
				<thead>
					<th>Id</th>
					<th>Title</th>
					<th>Category</th>
					<th>Author</th>
					<th>Creation Date</th>
					<th>Updated Date</th>
				</thead>
				<tbody>
					@if($result->count())
						@foreach($result as $key => $item)
							<tr>
								<td>{{ $item->id}}</td>
								<td>{{ $item->name }}</td>
								<td>{{$item->category->name}}</td>
								<td>{{$item->author->name}}</td>
								<td>{{ $item->created_at }}</td>
								<td>{{ $item->updated_at }}</td>
							</tr>
						@endforeach
					@else
						<tr>
							<td colspan="4">There are no data.</td>
						</tr>
					@endif
				</tbody>
			</table>
			{{ $result->appends(request()->query())->links() }}
</body>
</html>