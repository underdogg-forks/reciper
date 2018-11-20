<?php

namespace App\Http\Controllers;

use App\Http\Requests\HelpRequest;
use App\Models\Help;
use App\Models\HelpCategory;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HelpController extends Controller
{
    /**
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin')->except(['index', 'show']);
    }

    /**
     * @return \Illuminate\Http\View
     */
    public function index(): View
    {
        try {
            return view('help.index', [
                'help_list' => $this->getHelpList(),
                'help_categories' => $this->getHelpCategories(),
            ]);
        } catch (QueryException $e) {
            no_connection_error($e, __CLASS__);
            return view('help.index');
        }
    }

    /**
     * Show single help material with sidebar navigation
     *
     * @param \App\Models\Help $help
     * @return \Illuminate\View\View
     */
    public function show(Help $help): View
    {
        try {
            return view('help.show', [
                'help' => $help,
                'help_list' => $this->getHelpList(),
                'help_categories' => $this->getHelpCategories(),
            ]);
        } catch (QueryException $e) {
            no_connection_error($e, __CLASS__);
            return view('help.index');
        }
    }

    /**
     * Show create page
     *
     * @return \Illuminate\View\View
     */
    public function create(): View
    {
        $categories = HelpCategory
            ::select('id', 'title_' . LANG() . ' as title')
            ->get();

        return view('help.create', compact('categories'));
    }

    /**
     * Store data in database and clean cache
     *
     * @param \App\Http\Requests\HelpRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(HelpRequest $request): RedirectResponse
    {
        Help::create([
            'title_' . LANG() => request('title'),
            'text_' . LANG() => request('text'),
            'help_category_id' => request('category'),
        ]);

        cache()->forget('help_list');
        cache()->forget('help_categories');

        return redirect('/help')->withSuccess(
            trans('help.help_message_is_created')
        );
    }

    /**
     * Show edit page
     *
     * @param \App\Models\Help
     * @return \Illuminate\View\View
     */
    public function edit(Help $help): View
    {
        $categories = HelpCategory
            ::select('id', 'title_' . LANG() . ' as title')
            ->get();

        return view('help.edit', compact('categories', 'help'));
    }

    /**
     * Update existing help material
     *
     * @param \App\Http\Requests\HelpRequest $request
     * @param \App\Models\Help $help
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(HelpRequest $request, Help $help): RedirectResponse
    {
        $help->update([
            'title_' . LANG() => request('title'),
            'text_' . LANG() => request('text'),
            'help_category_id' => request('category'),
        ]);

        cache()->forget('help_list');
        cache()->forget('help_categories');

        return redirect("/help/{$help->id}/edit")->withSuccess(
            trans('help.help_updated')
        );
    }

    /**
     * Delete particular help material
     *
     * @param \App\Models\Help $help
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Help $help): RedirectResponse
    {
        $help->delete();

        cache()->forget('help_list');
        cache()->forget('help_categories');
        cache()->forget('trash_notif');

        return redirect('/help')->withSuccess(trans('help.help_deleted'));
    }

    /**
     * Helper that caches help list for 10 minutes
     *
     * @return array
     */
    public function getHelpList(): array
    {
        return cache()->remember('help_list', 10, function () {
            return Help::selectBasic()->orderBy('title')->get()->toArray();
        });
    }

    /**
     * Helper that caches help categories for 10 minutes
     *
     * @return array
     */
    public function getHelpCategories(): array
    {
        return cache()->remember('help_categories', 10, function () {
            return HelpCategory::selectBasic()->get()->toArray();
        });
    }
}
