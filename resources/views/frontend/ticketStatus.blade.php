@extends('frontend.layouts.app')

@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>

@endif

<!-- Default form contact -->

<div class="container">
  <div class="card">

    <div class="card-header text-center"> Статус заявки </div>
    
    <div class="card-body">

      @if (\Session::has('status'))


        @foreach (\Session::get('status') as $message)
            <table class="table table-sm">
              <tbody>
                <tr>
                  <td>Статус Заявки</td>
                  <td><b>{{$message->status}}</b></td>
                </tr>                
                <tr>
                  <td>Ваш номер заявки</td>
                  <td>{{$message->ticket_article}}</td>
                </tr>

                <tr>
                  <td>ФІО</td>
                  <td>{{$message->fio}}</td>
                </tr>
                <tr>
                  <td>Номер телефону</td>
                  <td>{{$message->phone}}</td>
                </tr>
                <tr>
                  <td>Тип заявки</td>
                  <td>{{$message->type}}</td>
                </tr>
                <tr>
                  <td>Бренд</td>
                  <td>{{$message->brand}}</td>
                </tr>
                <tr>
                  <td>Модель</td>
                  <td>{{$message->model}}</td>
                </tr>
                <tr>
                  <td>Відповідь менджера СЦ</td>
                  <td>{!! $message->answer !!}</td>
                </tr>          
              </tbody>
            </table>

        @endforeach

      @else

        {{ Form::open(array('url' => 'ticketStatus', 'class'=>'form-horizontal', 'enctype'=>"multipart/form-data")) }}
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="ticketCode-field">Введіть код заявки:</label>
              <input id="ticketCode-field" type="text" name="ticketCode" class="form-control"  required>
            </div>
          </div>
          <button class="btn btn-success btn-block" type="submit">Відправити</button>
        {{ Form::close() }}
      @endif
    </div>
  </div>
</div>

@endsection