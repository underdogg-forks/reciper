<?php

namespace App\Http\ViewComposers\Footer;

use App\Models\Document;
use Illuminate\Database\QueryException;
use Illuminate\View\View;

class DocumentsComposer
{
    /**
     * Bind data to the view
     * @param  View  $view
     * @return void
     */
    public function compose(View $view): void
    {
        try {
            $view->with('documents_footer', cache()->rememberForever('documents_footer', function () {
                return Document::select('id', 'title_' . LANG() . ' as title')
                    ->isReady(1)
                    ->limit(10)
                    ->get()
                    ->toArray();
            }));
        } catch (QueryException $e) {
            $view->with('documents_footer', []);
            no_connection_error($e, __CLASS__);
        }
    }
}
