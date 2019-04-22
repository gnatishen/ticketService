Ваша заявка зареєстрована в системі Сервісного центру. <br>
<hr>

Очікуйте дзвінка менеджера по сервісу.<br>
Ви також можете перевірити статус вашої заявки на <a href="http://t.prelude.km.ua/ticketStatus"> сайті сервісного центру </a>
<hr>
<table>
  <tbody>               
    <tr>
      <td>Номер заявки</td>
      <td>{{$ticket->ticket_article}}</td>
    </tr>
    <tr>
      <td>ФІО</td>
      <td>{{$ticket->fio}}</td>
    </tr>
    <tr>
      <td>Номер телефону</td>
      <td>{{$ticket->phone}}</td>
    </tr>
    <tr>
      <td>E-mail</td>
      <td>{{$ticket->email}}</td>
    </tr>
    <tr>
      <td>Місто</td>
      <td>{{$ticket->city}}</td>
    </tr>
    <tr>
      <td>Вулиця / будинок</td>
      <td>{{$ticket->adress}}</td>
    </tr>
    <tr>
      <td>Тип заявки</td>
      <td>{{$ticket->type}}</td>
    </tr>
    <tr>
      <td>Бренд</td>
      <td>{{$ticket->brand}}</td>
    </tr>
    <tr>
      <td>Модель</td>
      <td>{{$ticket->model}}</td>
    </tr>
    <tr>
      <td>Серійний номер</td>
      <td>{!! $ticket->serial_number !!}</td>
    </tr>
    <tr>
      <td>Дата продажу</td>
      <td>{!! date('d.m.Y',strtotime($ticket->date_sale)) !!}</td>
    </tr>
    <tr>
      <td>Додаткова інформація</td>
      <td>{!! $ticket->description !!}</td>
    </tr>         
  </tbody>


</table>