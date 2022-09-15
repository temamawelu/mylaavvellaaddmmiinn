<?php

namespace App\Admin\Controllers;

use App\Models\Port;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class PortController extends Controller
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
            ->header('API Management')
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
        $grid = new Grid(new Port);

        $grid->id('ID');
        $grid->ip('ip');
        $grid->port('port');
        $grid->url('url');
        $grid->username('username');
        $grid->password('password');
        $grid->token('token');
        $grid->apiname('apiname');
        $grid->description('description');
        $grid->index('created_by');
        $grid->created_at(trans('admin.created_at'));
     //   $grid->updated_at(trans('admin.updated_at'));

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
        $show = new Show(Port::findOrFail($id));

        $show->id('ID');
        $show->ip('ip');
        $show->port('port');
        $show->url('url');
        $show->username('username');
        $show->password('password');
        $show->token('token');
        $show->apiname('apiname');
        $show->description('description');
        $show->created_by('created_by');
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
        $form = new Form(new Port);

       // $form->display('ID');
        $form->ip('ip', 'IP')->rules('required');
        $form->text('port', 'Port')->rules('required|min:4');
        $form->url('url', 'URL');
        $form->text('username', 'username')->rules('required');
        $form->password('password', 'password')->rules('required');
        $form->text('token', 'Token');
        $form->text('apiname', 'API Name');
        $form->text('description', 'description');
    

        $form->submitted(function (Form $form) {
            $form->ignore('created_by');
          
         });

        $form->display(trans('admin.created_at'));
      //$form->display(trans('admin.updated_at'));

        return $form;
    }
}
