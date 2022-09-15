<?php

namespace App\Admin\Controllers;

use App\Models\AccountType;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class AccountTypeController extends Controller
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
            ->header('Account Type')
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
        $grid = new Grid(new AccountType);

        $grid->id('ID');
        $grid->accountname('accountname');
        $grid->ServiceChargeRate('ServiceChargeRate');
        $grid->CalculateFrom('CalculateFrom');
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
        $show = new Show(AccountType::findOrFail($id));

        $show->id('ID');
        $show->accountname('accountname');
        $show->ServiceChargeRate('ServiceChargeRate');
        $show->CalculateFrom('CalculateFrom');
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
        $form = new Form(new AccountType);

        //$form->display('ID');
        $form->text('accountname', 'accountname')->rules('required|min:3');
        $form->text('ServiceChargeRate', 'ServiceChargeRate')->rules('required');
        $form->text('CalculateFrom', 'CalculateFrom')->rules('required');
        $form->text('description', 'description');
       // $form->display(trans('admin.created_at'));
       // $form->display(trans('admin.updated_at'));

        return $form;
    }
}
