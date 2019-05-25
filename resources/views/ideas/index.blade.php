@extends('mainlayout')

@section('content')

@if(count($ideas) > 0)
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
		</tr>
    </thead>
    <tbody id="idea-results">
      @foreach($ideas as $idea)
      <tr>
          <td><a href="{{ route('ideas.show',$idea->id)}}">{{$idea->title}}</a></td>
          <td>{{$idea->publisher}}</td>
          <td>{{$idea->destination}}</td>
          <td>{{$idea->start_date}}</td>
		  <td>{{$idea->end_date}}</td>
		  <td>{{$idea->tags}}</td>
          <td>{{$idea->comments_number}}</td>
      </tr>
      @endforeach
    </tbody>
</table>
<p id="summary"></p>

@else

<p>There is no any idea currently. Go create one!</p>

@endif


@endsection

@section('search')

<select id="searchselect">
	<option>Destination</option>
	<option>Tag</option>
</select>
<input type="text" id="searchkeyword" name="search" />
<span>
	<input type="checkbox" id="partial" name="partial" />
	<span>Partial Match</span>
</span>
<input type="submit" id="submitsearch" value="Find Ideas!" />

@endsection





