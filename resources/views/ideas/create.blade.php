@extends('crudlayout')

@section('content')
<p>Please use the form below to add your idea.</p>
{!! Form::open(['route' => 'ideas.store']) !!}

<div class="form-group">
    {!! Form::label('title', 'Title') !!}
    {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Title']) !!}
</div>

<div class="form-group">
    {!! Form::label('destination', 'Destination') !!}
    {!! Form::text('destination', null, ['class' => 'form-control', 'placeholder' => 'Destination']) !!}
</div>

<div class="form-group">
    {!! Form::label('start_date', 'Start Date') !!}
    {!! Form::text('start_date', null, ['class' => 'form-control datepicker', 'placeholder' => 'Start Date']) !!}
</div>

<div class="form-group">
    {!! Form::label('end_date', 'End Date') !!}
    {!! Form::text('end_date', null, ['class' => 'form-control datepicker', 'placeholder' => 'End Date']) !!}
</div>

<div class="form-group">
    {!! Form::label('tags', 'Tags') !!}
    {!! Form::text('tags', null, ['class' => 'form-control', 'placeholder' => 'Tags']) !!}
</div>

{!! Form::submit('Submit', ['class' => 'btn btn-info']) !!}

{!! Form::close() !!}
    
@endsection