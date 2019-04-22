<?php

namespace App\Admin\Controllers;

use App\Ticket;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Grid\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class TicketController extends Controller
{
    use HasResourceActions;

    /**
     * Index interface.
     *
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {
        return $content
            ->header('Заяви')
            ->description('description')
            ->body($this->grid());
    }

    /**
     * Show interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function show($id, Content $content)
    {
        return $content
            ->header('Detail')
            ->description('description')
            ->body($this->detail($id));
    }

    /**
     * Edit interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function edit($id, Content $content)
    {
        return $content
            ->header('Edit')
            ->description('description')
            ->body($this->form()->edit($id));
    }

    /**
     * Create interface.
     *
     * @param Content $content
     * @return Content
     */
    public function create(Content $content)
    {
        return $content
            ->header('Create')
            ->description('description')
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Ticket);

        $grid->model()->orderBy('created_at', 'DESC');

        $grid->filter(function($filter){
            
            // Remove the default id filter
            $filter->disableIdFilter();
            
            $filter->in('type','Тип заявки')->checkbox([
                'Ремонт'    => 'Ремонт',
                'Запчастини'    => 'Запчастини',
                'Дефект'    => 'Дефект',
            ]);


            $filter->in('status','Статус заявки')->checkbox([
                'Відкрита'    => 'Відкрита',
                'В обробці'    => 'В обробці',
                'Закрита'    => 'Закрита',
            ]);

            $filter->where(function ($query) {

            $query->where('fio', 'like', "%{$this->input}%");
            }, 'ФІО');

        });

        $grid->column('Заява створена')->display(function(){
            return $this->created_at->format('d.m.Y H:m');
        });

        $grid->column('Дані клієнта')->display(function () {
            return $this->fio . '<br>' .
                    '<b>'.$this->phone  . '</b><br>' .
                    $this->email  . '<br>' .
                    $this->city  . '<br>' .
                    $this->adress;
        });

        $grid->column('Дані по заяві')->display(function () {
            $result = '';
            foreach ($this->files as $file) {
                $result = $result.'<a href="/storage/'.$file.'"  target="_blank">Файл</a> ';
            }           
            return '<b> Номер: </b>' . $this->ticket_article . '<br>' .
                   '<b>Тип Заявки: </b>' . $this->type . '<br>' .
                   '<b>Бренд: </b>' . $this->brand . '<br>' .
                   '<b>Модель: </b>' . $this->model . '<br>' .
                   '<b>С/Н: </b>' . $this->serial_number . '<br>' .
                   '<b>Дата продажу: </b>' . date('d.m.Y',strtotime($this->date_sale)) . '<br>' .
                    $result;
        });
        $grid->description('Додаткові відомості')->width('250px');
        $grid->answer('Відповідь клієнту')->editable('textarea')->width('250px');
        $grid->status('Статус')->editable('select', [
            'Відкрита'  => 'Відкрита',
            'В обробці' => 'В обробці',
            'Закрита'   => 'Закрита'
        ]);

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Ticket::findOrFail($id));

        $show->id('Id');
        $show->ticket_article('Ticket article');
        $show->fio('Fio');
        $show->phone('Phone');
        $show->city('City');
        $show->adress('Adress');
        $show->email('Email');
        $show->type('Type');
        $show->brand('Brand');
        $show->model('Model');
        $show->serial_number('Serial number');
        $show->date_sale('Date sale');
        $show->description('Description');
        $show->status('Status');
        $show->created_at('Created at');
        $show->updated_at('Updated at');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Ticket);

        $form->text('ticket_article', 'Номер заявки')->default(mt_rand(100000, 999999))->placeholder(' ');
        $form->text('fio', 'ФІО')->placeholder(' ');
        $form->mobile('phone', 'Телефон')->options(['mask' => '+38(999) 999 99 99'])->placeholder(' ');
        $form->text('city', 'Місто')->placeholder(' ');
        $form->text('adress', 'Адреса')->placeholder(' ');
        $form->email('email', 'Email')->placeholder(' ');
        $form->select('type', 'Тип')->options([
            'Ремонт'     => 'Ремонт',
            'Запчастини' => 'Запчастини',
            'Дефект'     => 'Дефект'
        ])->placeholder(' ');
        $form->text('brand', 'Бренд')->placeholder(' ');
        $form->text('model', 'Модель')->placeholder(' ');
        $form->text('serial_number', 'С/Н')->placeholder(' ');

        $form->date('date_sale', 'Дата продажу')->format('DD.MM.YYYY')->placeholder(' ');
        $form->textarea('description', 'Додатково')->placeholder(' ');
        $form->multipleFile('files', 'Файли')->placeholder(' ');
        $form->textarea('answer', 'Відповідь клієнту')->placeholder(' ');
        $form->select('status', 'Статус')->options([
            'Відкрита'  => 'Відкрита',
            'В обробці' => 'В обробці',
            'Закрита'   => 'Закрита'
        ])->placeholder(' ');

        return $form;
    }
}
