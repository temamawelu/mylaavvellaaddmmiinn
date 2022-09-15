<?php

namespace App\Admin\Actions\AccountType;

use Encore\Admin\Actions\Action;
use Illuminate\Http\Request;

class ImportAccontType extends Action
{
    protected $selector = '.import-accont-type';

    public function handle(Request $request)
    {
        // $request ...

        return $this->response()->success('Success message...')->refresh();
    }

    public function html()
    {
        return <<<HTML
        <a class="btn btn-sm btn-default import-accont-type">import data</a>
HTML;
    }
}