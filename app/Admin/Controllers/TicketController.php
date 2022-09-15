<?php

namespace App\Admin\Controllers;

use App\Models\Ticket;
use App\Models\Currency;
use App\Models\User;
use App\Models\AccountType;
use App\Models\TicketTitle;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Row;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Illuminate\Support\MessageBag;
use App\Admin\Forms\Setting;


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
            ->header('Frieght Ticket List')
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
        $grid = new Grid(new Ticket);

        $grid->id('ID');
        $grid->Refno('Refno');
        $grid->Billno('Billno');
        $grid->Shipno('Shipno');
        $grid->RefDate('RefDate');
        $grid->DebitAccountNo('DebitAccountNo');
        $grid->DebitAccountName('DebitAccountName');
        $grid->BranchName('BranchName');
        $grid->Amount('Amount');
        $grid->Currency('Currency');
        $grid->AccountType('AccountType');
        $grid->TicketType('TicketType');
        $grid->ServiceAccountNo('ServiceAccountNo');
        $grid->ServiceAccountName('ServiceAccountName');
        $grid->ServiceAmount('ServiceAmount');
        $grid->ExAccountNo('ExAccountNo');
        $grid->ExAccountName('ExAccountName');
        $grid->ExAmount('ExAmount');
        $grid->ExRate('ExRate');
        $grid->LocalEtb('LocalEtb');
        $grid->TotalEtb('TotalEtb');
        $grid->TotalUsd('TotalUsd');
        $grid->transactioncode('transactioncode');
        $grid->user_id('user_id');
        $grid->ticket_status('ticket_status');
        $grid->narration('narration');
     //   $grid->created_at(trans('admin.created_at'));
      //  $grid->updated_at(trans('admin.updated_at'));
      $grid->column('id', 'ID')->sortable()->totalRow('Total');

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

        $show->id('ID');
        $show->Refno('Refno');
        $show->Billno('Billno');
        $show->Shipno('Shipno');
        $show->RefDate('RefDate');
        $show->DebitAccountNo('DebitAccountNo');
        $show->DebitAccountName('DebitAccountName');
        $show->BranchName('BranchName');
        $show->Amount('Amount');
        $show->Currency('Currency');
        $show->AccountType('AccountType');
        $show->TicketType('TicketType');
        $show->ServiceAccountNo('ServiceAccountNo');
        $show->ServiceAccountName('ServiceAccountName');
        $show->ServiceAmount('ServiceAmount');
        $show->ExAccountNo('ExAccountNo');
        $show->ExAccountName('ExAccountName');
        $show->ExAmount('ExAmount');
        $show->ExRate('ExRate');
        $show->LocalEtb('LocalEtb');
        $show->TotalEtb('TotalEtb');
        $show->TotalUsd('TotalUsd');
        $show->transactioncode('transactioncode');
        $show->user_id('user_id');
        $show->ticket_status('ticket_status');
        $show->narration('narration');
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
                $form = new Form(new Ticket);
       
                $form->column(1/2, function ($form) 
                {
                $form->divider('General Ticket Information');
              
                $form->text('Refno', 'Ref No')->rules('required')->setWidth(4,4);
                $form->text('Billno', 'Bill No')->setWidth(4, 4);
                $form->text('Shipno')->creationRules(['required', "unique:ticket"])->updateRules(['required', "unique:ticket,Shipno,{{id}}"])->setWidth(4, 4);
                $form->date('RefDate', 'Ref Date')->rules('required')->setWidth(4, 4);
            
                $form->divider('Debit Account Information');
                $form->text('DebitAccountNo', 'Debit Account No')->rules('required|regex:/^\d+$/|min:14', 
                ['regex' => 'Account No must be numbers','min'   => 'Account No can not be less than 14 characters',])->setWidth(6, 4);
                $form->text('DebitAccountName', 'Debit Account Name')->rules('required')->setWidth(6, 4);
                $form->text('BranchName', 'Branch Name')->rules('required')->setWidth(6, 4);
                }
            );
          
            $form->column(1/2, function ($form) 
            {
                $form->divider();
                $form->divider('Ticket Information');
                $form->text('Amount', 'Amount')->rules('required')->setWidth(10, 2);
                $form->radio('DebitCurrency')
                ->options([
                1 =>'Inland Hauladge',
                2 =>'Foriegnt Charge',
                ])
                ->when(1, function (Form $form)
                {
           
                $form->radio('AccountType')
                ->options([
                4 =>'OTHER',
                ])->when(4, function (Form $form)
                {
                $form->text('CreditAccountNo', 'Credit Account No')->setWidth(6, 2);
                $form->text('CreditAccountName', 'CreditAccountName')->setWidth(6, 2);
                $form->text('CreditAmount', 'CreditAmount')->setWidth(6, 2); 
                $form->select('TicketType')->options(TicketTitle::where('ticketname','Inland Haulagde')->pluck('ticketname','id'))->rules('required')->setWidth(6, 2);
                });
                })
                ->when(2, function (Form $form) 
                {
                
                $form->radio('AccountType')
                ->options([
                1 =>'Diaspora',
                2 =>'FYC',
                3 =>'Awash',
                4 =>'Other',
                5 =>'Retention',
                6 =>'Retention Export',
                7 =>'Retention Floriculture',
                8 =>'Retention Horticulture',
                9 =>'Retention Manufacturing Exporter',

                ])->when('in', [1,2,5,6,7,6,7,8,9], function (Form $form)
                {
                $form->text('CreditAccountNo', 'Credit Account No')->setWidth(6, 2);
                $form->text('CreditAccountName', 'CreditAccountName')->setWidth(6, 2);
                $form->text('CreditAmount', 'CreditAmount')->setWidth(6, 2);
                $form->select('TicketType')->options(TicketTitle::whereNotIn('id', [3])->pluck('ticketname','id'))->rules('required')->setWidth(6, 2);
                })
                ->when('in', [4], function (Form $form)
                {
                $form->text('CreditAccountNo', 'Credit Account No')->setWidth(6, 2);
                $form->text('CreditAccountName', 'CreditAccountName')->setWidth(6, 2);
                $form->text('CreditAmount', 'CreditAmount')->setWidth(6, 2);
                $form->select('TicketType')->options(TicketTitle::whereIn('id', [2,4])->pluck('ticketname','id'))->rules('required')->setWidth(6, 2);
                })
                ->when('in', [3], function (Form $form)
                {
                $form->text('CreditAccountNo', 'Credit Account No')->setWidth(6, 2);
                $form->text('CreditAccountName', 'CreditAccountName')->setWidth(6, 2);
                $form->text('CreditAmount', 'CreditAmount')->setWidth(6, 2);
                $form->select('TicketType')->options(TicketTitle::whereIn('id', [1])->pluck('ticketname','id'))->rules('required')->setWidth(6, 2);
                });

                //3,4,
                });
            }
            );


            // 'in', [5, 6]


        // /////////////////IN Land////////
        // $form->select('AccountType')->options(AccountType::where('id',1)->pluck('accountname','id'))->rules('required')->setWidth(6, 2);
        // $form->select('TicketType')->options(TicketTitle::where('ticketname','Inland Haulagde')->pluck('ticketname','id'))->rules('required')->setWidth(6, 2);
        // $form->text('ServiceAccountNo', 'Service Account No')->setWidth(6, 2);
        // $form->text('ServiceAccountName', 'Service Account Name')->setWidth(6, 2);
        // $form->text('ServiceAmount', 'ServiceAmount')->setWidth(6, 2);
        // $form->text('ExRate', 'ExRate')->setWidth(6, 2);
        // $form->text('LocalEtb', 'Local ETB')->setWidth(6, 2);
        // $form->text('TotalEtb', 'Total ETB')->setWidth(6, 2);
        // $form->textarea('narration', 'Remarks')->setWidth(6, 2);
        // ////////////Frieght///////////////////
        // $form->text('ServiceAccountNo', 'Service Account No')->setWidth(6, 2);
        // $form->text('ServiceAccountName', 'ServiceAccountName')->setWidth(6, 2);
        // $form->text('ServiceAmount', 'ServiceAmount')->setWidth(6, 2);
        // $form->text('ExAccountNo', 'ExAccountNo')->setWidth(6, 2);
        // $form->text('ExAccountName', 'ExAccountName')->setWidth(6, 2);
        // $form->text('ExAmount', 'ExAmount')->setWidth(6, 2);
        // $form->text('ExRate', 'ExRate')->setWidth(6, 2);
        // $form->text('LocalEtb', 'Local ETB')->setWidth(6, 2);
        // $form->text('TotalEtb', 'Total ETB')->setWidth(6, 2);
        // $form->text('TotalUsd', 'Total USD')->setWidth(6, 2);
        // $form->textarea('narration', 'Remarks')->setWidth(6, 2);
        /////////////////////////////////
    $form->hidden('ticket_status');
    $form->hidden('user_id');
    
                    $form->saving(function ($form)
                    {
                    $error = new MessageBag(['title'   => 'Sorry Thier is Something Wrong', 'message' => 'Please Check Your Entry Data.',]);
                    return back()->with(compact('error'));
                    });

                    $form->saving(function ($form) 
                    {
                    dump($form->user_id);  
                    $form->user_id       = Admin::user()->name;
                    $form->CreditAmount  = $form->ticket_status*0.15;
                    $success = new MessageBag([  'title'   => 'Ticket Successfully Created', 'message' => 'Your Frieght Ticket is Succesfully Created!', ]);
                    return back()->with(compact('success'));
                    });
        return $form;
    }





    // $form->display('ID');
    // $form->text('transactioncode', 'transactioncode');
    // $form->text('user_id', 'user_id');
    // $form->text('ticket_status', 'ticket_status');
    // $form->display(trans('admin.created_at'));
    // $form->display(trans('admin.updated_at'));
    // $form->select('Currency')->options(Currency::all()->pluck('currencyname','id'))->rules('required');
    // $form->select('AccountType')->options(AccountType::all()->pluck('accountname','id'))->rules('required');
    // $form->select('TicketType')->options(TicketTitle::all()->pluck('ticketname','id'))->rules('required');
        // $form->text('ExAccountNo', 'ExAccountNo');
        // $form->text('ExAccountName', 'ExAccountName');
        // $form->text('ExAmount', 'ExAmount');



}
