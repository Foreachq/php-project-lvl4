<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLabelRequest;
use App\Http\Requests\UpdateLabelRequest;
use App\Models\Label;

class LabelController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Label::class);
    }

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(StoreLabelRequest $request)
    {
        //
    }

    public function show(Label $label)
    {
        //
    }

    public function edit(Label $label)
    {
        //
    }

    public function update(UpdateLabelRequest $request, Label $label)
    {
        //
    }

    public function destroy(Label $label)
    {
        //
    }
}
