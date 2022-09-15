<?php

namespace App\Admin\Controllers;

use App\Models\Currency;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Encore\Admin\Auth\Permission;

class CurrencyController extends Controller
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

        Permission::check('currencys.index');
        return $content
            ->header('Currency')
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
        Permission::check('currencys.create');
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
        $grid = new Grid(new Currency);

        $grid->id('ID');
        $grid->currencyname('currencyname');
        $grid->buyingrate('buyingrate');
        $grid->sellindrate('sellindrate');
        $grid->exchangecommissionrate('exchangecommissionrate');
        $grid->exchangecommission('exchangecommission');
        $grid->accountname('accountname');
        $grid->accountno('accountno');
        $grid->ticketheader('ticketheader');
        $grid->description('description');
      //  $grid->created_at(trans('admin.created_at'));
    //    $grid->updated_at(trans('admin.updated_at'));

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
        $show = new Show(Currency::findOrFail($id));

        $show->id('ID');
        $show->currencyname('currencyname');
        $show->buyingrate('buyingrate');
        $show->sellindrate('sellindrate');
        $show->exchangecommissionrate('exchangecommissionrate');
        $show->exchangecommission('exchangecommission');
        $show->accountname('accountname');
        $show->accountno('accountno');
        $show->ticketheader('ticketheader');
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
        $form = new Form(new Currency);

     //   $form->display('ID');
        $form->text('currencyname', 'currencyname');
        $form->text('buyingrate', 'buyingrate');
        $form->text('sellindrate', 'sellindrate');
        $form->text('exchangecommissionrate', 'exchangecommissionrate');
        $form->text('exchangecommission', 'exchangecommission');
        $form->text('accountname', 'accountname');
        $form->text('accountno', 'accountno');
        $form->text('ticketheader', 'ticketheader');
        $form->text('description', 'description');
       // $form->display(trans('admin.created_at'));
      //  $form->display(trans('admin.updated_at'));

        return $form;
    }
}
