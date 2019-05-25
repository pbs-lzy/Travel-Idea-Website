@extends('crudlayout')

@section('content')
<p>Please use the form below to edit your idea.</p>
{!! Form::open(['action' => ['IdeasController@update', $idea->id], 'method' => 'PUT']) !!}

<div class="form-group">
    {!! Form::label('title', 'Title') !!}
    {!! Form::text('title', $idea->title, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('destination', 'Destination') !!}
    {!! Form::text('destination', $idea->destination, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('start_date', 'Start Date') !!}
    {!! Form::text('start_date', $idea->start_date, ['class' => 'form-control datepicker']) !!}
</div>

<div class="form-group">
    {!! Form::label('end_date', 'End Date') !!}
    {!! Form::text('end_date', $idea->end_date, ['class' => 'form-control datepicker']) !!}
</div>

<div class="form-group">
    {!! Form::label('tags', 'Tags') !!}
    {!! Form::text('tags', $idea->tags, ['class' => 'form-control']) !!}
</div>

{!! Form::submit('Submit', ['class' => 'btn btn-info']) !!}

{!! Form::close() !!}
@endsection