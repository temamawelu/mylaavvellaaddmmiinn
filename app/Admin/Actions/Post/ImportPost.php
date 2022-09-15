<?php

namespace App\Admin\Actions\Post;

use Encore\Admin\Actions\Action;
use Illuminate\Http\Request;

class \ImportPost extends Action
{
    protected $selector = '.import-post';

    public function handle(Request $request)
    {
        // $request ...

        return $this->response()->success('Success message...')->refresh();
    }

    public function html()
    {
        return <<<HTML
        <a class="btn btn-sm btn-default import-post">import data</a>
HTML;
    }
}