@extends('crudlayout')

@section('content')
	
@if(count($myideas) > 0)

<table>
    <thead>
		<tr>
			<td>Title</td>
			<td>Publisher</td>
			<td>Destination</td>
			<td>Start_Date</td>
			<td>End_Date</td>
			<td>Tags</td>
			<td>Comments</td>
			<td>Actions</td>
		</tr>
    </thead>
    <tbody id="idea-results">
		@foreach($myideas as $idea)
		<tr>
			<td><a href="{{ route('ideas.show', $idea->id)}}">{{$idea->title}}</a></td>
			<td>{{$idea->publisher}}</td>
			<td>{{$idea->destination}}</td>
			<td>{{$idea->start_date}}</td>
			<td>{{$idea->end_date}}</td>
			<td>{{$idea->tags}}</td>
			<td>{{$idea->comments_number}}</td>
			<td><a href="/ideas/{{$idea->id}}/edit" class="btn btn-info">Edit</a> </td>
			<td>
				{!! Form::open(['action' => ['IdeasController@destroy', $idea->id], 'method' => 'DELETE']) !!}
					{!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
				{!! Form::close() !!}
			</td>
      </tr>
	  @endforeach
    </tbody>
</table>

@else

<p>There is no any idea currently. Go create one!</p>

@endif

@endsection

