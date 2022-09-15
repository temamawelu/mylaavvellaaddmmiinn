<?php

namespace App\Admin\Controllers;

use App\Models\AccountList;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class AccountListController extends Controller
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
            ->header('Account List')
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
        $grid = new Grid(new AccountList);

        $grid->id('ID')->sortable();
        

        $grid->accounttype('accounttype');
        $grid->accountname('accountname');
        $grid->accountno('accountno');
        $grid->description('description');
        $grid->created_at(trans('admin.created_at'));
         $grid->updated_at(trans('admin.updated_at'));
 


     
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
        $show = new Show(AccountList::findOrFail($id));

        $show->id('ID');
        $show->accounttype('accounttype');
        $show->accountname('accountname');
        $show->accountno('accountno');
        $show->description('description');
        // $show->created_at(trans('admin.created_at'));
        // $show->updated_at(trans('admin.updated_at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new AccountList);

        // $form->display('ID');
        $form->text('accounttype', 'Account Type')->rules('required|min:3');
        $form->text('accountname', 'Account Name')->rules('required|min:3');
        $form->text('accountno', 'Account No')->rules('required|regex:/^\d+$/|min:14', ['regex' => 'Account must be numbers','min'   => 'Account can not be less than 14 characters',
        ]);
        $form->text('description', 'Description');
        // $form->display(trans('admin.created_at'));
        // $form->display(trans('admin.updated_at'));

        return $form;
    }
}
