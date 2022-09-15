<?php

namespace App\Admin\Actions\AccountList;

use Encore\Admin\Actions\Action;
use Illuminate\Http\Request;

class ImportAccountList extends Action
{
    protected $selector = '.import-account-list';

    public function handle(Request $request)
    {
        // $request ...

        return $this->response()->success('Success message...')->refresh();
    }

    public function html()
    {
        return <<<HTML
        <a class="btn btn-sm btn-default import-account-list">import data</a>
HTML;
    }
}