@extends('layouts.main')
@section('page_header')
    <h1>Contact Us</h1>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-4">
    <p>Have a reason to contact us? Want to tell us about something that is broken? How about telling us about something cool you found on the site? Tell us a joke? Ask us a question? Suggest a new feature?</p> 

    <p>Cool - just fill in this form and we'll get back to you as soon as we can.</p>

    <p>We won't pass your email on to any mailing lists or third party people - pinky swear!</p>

    </div>
    <div class="col-md-8">
        
                    {!! Form::open(array('route' => 'contact_submit')) !!}

                    @if (count($errors) > 0)
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif

                    <div class="form-group">
                        {!! Form::label('name', 'Name') !!}
                        {!! Form::text('name', old('name'), [
                            'class' => 'form-control',
                            'placeholder' => 'Your name',
                            'autofocus' => 'on',
                            'autocomplete' => 'on',
                            'required' => 'required',
                            'tabindex' => 1
                        ]) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('email', 'Email Address') !!}
                        {!! Form::email('email', old('email'), [
                            'class' => 'form-control',
                            'placeholder' => 'Email address',
                            'autofocus' => 'off',
                            'autocomplete' => 'on',
                            'required' => 'required',
                            'tabindex' => 2
                        ]) !!}
                    </div>


                    <div class="form-group">
                        {!! Form::label('contact_message', 'Message') !!}
                        {!! Form::textarea('contact_message', old('message'), [
                                'class' => 'form-control',
                                'placeholder' => 'Enter your message here',
                                'autofocus' => 'off',
                                'autocomplete' => 'off',
                                'required' => 'required',
                                'tabindex' => 3
                                ]) !!}
                    </div>

                    {!! Form::button('Send it!', [
                        'type' => 'submit',
                        'class' => 'btn btn-danger'
                    ]) !!}

                {!! Form::close() !!}
    </div>


</div>
@endsection;
