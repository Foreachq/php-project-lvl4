<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLabelRequest;
use App\Http\Requests\UpdateLabelRequest;
use App\Models\Label;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class LabelController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Label::class);
    }

    public function show(): void
    {
        abort(404);
    }

    public function index(): Application|Factory|View
    {
        $labels = Label::all()->sortBy('id');

        return view('labels.index', compact('labels'));
    }

    public function create(): Factory|View|Application
    {
        $label = new Label();

        return view('labels.create', compact('label'));
    }

    public function store(StoreLabelRequest $request): RedirectResponse
    {
        $label = new Label();
        $label->fill($request->all());
        $label->save();

        flash(__('messages.flash.label.success.create'))->success();

        return redirect()->route('labels.index');
    }

    public function edit(Label $label): Factory|View|Application
    {
        return view('labels.edit', compact('label'));
    }

    public function update(UpdateLabelRequest $request, Label $label): RedirectResponse
    {
        $label->fill($request->all());
        $label->save();
        flash(__('messages.flash.label.success.update'))->success();

        return redirect()->route('labels.index');
    }

    public function destroy(Label $label): RedirectResponse
    {
        if ($label->tasks()->count() === 0) {
            $label->delete();

            flash(__('messages.flash.label.success.delete'))->success();
        } else {
            flash(__('messages.flash.label.fail.delete'))->error();
        }

        return redirect()->route('labels.index');
    }
}
