@extends('commentlayout')

@section('content')
    <h2>{{$idea->title}}</h2>
    <p>Destination: <span id="dest">{{$idea->destination}}</span></p>
    <p>Travel Date: {{$idea->start_date}} to {{$idea->end_date}}</p>
    <p>Tags: {{$idea->tags}}</p>
    <p>Publisher: {{$idea->publisher}}</p>
    
    <section>
        <p>Total <span id="comments_number">{{$idea->comments_number}}</span> comment(s)</p>
        <div id="chatbox"></div>
        <input id="comments_content" />
        <input id="sendcomment" type="submit" value="Send" />
    </section>
@endsection

@section('API')
    <h2>Destination Weather</h2>
    <p id="destination_weather">Oops, we can not find the destination.</p>
    <h2>Hotwire Hotel Search</h2>
    <p id="testa"></p>
    <ol id="hotel_list"></ol>
@endsection