<?php

namespace App\Admin\Controllers;

use App\Models\TicketTitle;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class TicketTitleController extends Controller
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
            ->header('Ticket Title')
            ->description(trans('admin.description'))
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
            ->header(trans('admin.detail'))
            ->description(trans('admin.description'))
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
            ->header(trans('admin.edit'))
            ->description(trans('admin.description'))
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
            ->header(trans('admin.create'))
            ->description(trans('admin.description'))
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new TicketTitle);

        $grid->id('ID');
        $grid->ticketname('ticketname');
        $grid->ticketno('ticketno');
        $grid->description('description');
        $grid->created_at(trans('admin.created_at'));
        // $grid->updated_at(trans('admin.updated_at'));

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
        $show = new Show(TicketTitle::findOrFail($id));

        $show->id('ID');
        $show->ticketname('ticketname');
        $show->ticketno('ticketno');
        $show->description('description');
        $show->created_at(trans('admin.created_at'));
        $show->updated_at(trans('admin.updated_at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new TicketTitle);

        //$form->display('ID');
        $form->text('ticketname', 'Ticket Name')->rules('required|min:3');
        $form->text('ticketno', 'Ticket No')->rules('required|regex:/^\d+$/');
        $form->text('description', 'Description');
        $form->display(trans('admin.created_at'));

      //  $form->display(trans('admin.updated_at'));

        return $form;
    }
}
