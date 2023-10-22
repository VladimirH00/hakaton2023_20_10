<?php

namespace App\Http\Controllers\Specialist;

use App\Exceptions\NotFoundApiException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Specialist\StoreSpecialistRequest;
use App\Http\Requests\Specialist\UpdateSpecialistRequest;
use App\Models\Specialist\Specialist;

/**
 * Ресурсный контролле для CRUD операций с встречами
 */
class SpecialistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $specialists = Specialist::all();

        return response()->json($specialists, 201);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSpecialistRequest $request)
    {
        $model = new Specialist();
        $model->name = $request->get('name');
        $model->description = $request->get('description');
        $model->code = $request->get('code');
        $model->type_id= 1;
        $model->save();

        return response()->json('inserted', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $specialist)
    {
        /** @var Specialist $model */
        $model = Specialist::query()
            ->where('code', $specialist)
            ->first();

        if (!$model) {
            throw new NotFoundApiException('Данный специалист не найден', 404);
        }

        return response()->json($model);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSpecialistRequest $request, string $specialist)
    {
        /** @var Specialist $model */
        $model = Specialist::query()
            ->where('code', $specialist)
            ->first();

        if (!$model) {
            throw new NotFoundApiException('Данный специалист не найден', 404);
        }

        $model->name = $request->post('name');
        $model->description = $request->post('description');
        $model->code = $request->post('code');
        $model->type_id= 1;
        $model->save();

        return response()->json('modified', 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $specialist)
    {
        /** @var Specialist $model */
        $model = Specialist::query()
            ->where('code', $specialist)
            ->first();

        if (!$model) {
            throw new NotFoundApiException('Данный специалист не найден', 404);
        }

        $model->delete();

        return response()->json('deleted');
    }
}
