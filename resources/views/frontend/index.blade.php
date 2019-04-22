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

    <div class="card-header text-center"> ЗАЯВА </div>
    
    <div class="card-body">

      @if (\Session::has('status'))


        @foreach (\Session::get('status') as $message)
            Ваш номер заявки - <b>{{$message}}</b><br>
        @endforeach
        Статус вашої заявки можна отмати <a href="/ticketStatus">Тут</a>

      @else

        {{ Form::open(array('url' => 'addTicket', 'class'=>'form-horizontal', 'enctype'=>"multipart/form-data")) }}
          <clientform-component></clientform-component>
          <hr>
          <div class="form-row">
              <div class="form-group col-md-6">
                  <label for="type">Тип заяви</label>
                  <select class="form-control" id="type" name="type">
                    <option>Ремонт</option>
                    <option>Запчастини</option>
                    <option>Дефект</option>
                  </select>
              </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="brand-field">Бренд</label>
              <input id="brand-field" type="text" name="brand" class="form-control"  required>
            </div>
            <div class="form-group col-md-6">
              <label for="model-field">Модель</label>
              <input id="model-field" type="text" name="model" class="form-control"  required>
            </div>
          </div>
          <div class="form-row ">
            <div class="form-group col-md-6">
              <label for="serial-field">Серійний номер</label>
              <input id="serial-field" type="text" name="serial_number" class="form-control">
            </div>
            <div class="form-group col-md-6">
              <label for="datesale-field">Дата продажу</label>
              {!! Form::input('date', 'date_sale', date('D-m-y'), ['id'=>'datesale-field', 'class' => 'form-control']) !!}
            </div>
          </div>
          <div class="form-group">
              <label for="description-field">Додаткові відомості</label>
              <textarea name="description" class="form-control rounded-0" id="description-field" rows="6"></textarea>
          </div>


          <div class="form-group" >
            <label for="files-field">ДОДАТИ ФАЙЛИ <span style="color: rgba(0, 0, 0, 0.7)">( щоб додати декілька файлів затисніть при виборі CTRL або SHIFT )</span></label><br>
            <input id="files-field" type="file" name="files[]" multiple>
          </div>

          <button class="btn btn-success btn-block" type="submit">Відправити</button>
        {{ Form::close() }}
      @endif
    </div>
  </div>
</div>

@endsection