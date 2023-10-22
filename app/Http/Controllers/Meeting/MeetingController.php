<?php

namespace App\Http\Controllers\Meeting;

use App\Exceptions\NotFoundApiException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Meeting\StoreMeetingRequest;
use App\Http\Requests\Meeting\UpdateMeetingRequest;
use App\Models\Meeting\Meeting;
use App\Exceptions\DuplicateApiException;

/**
 * Ресурсный контролле для CRUD операций с встречами
 */
class MeetingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $meetings = Meeting::all();

        return response()->json($meetings, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMeetingRequest $request)
    {
        $meeting = Meeting::query()->where('name', $request->get('name'))->first();
        if ($meeting) {
            throw new DuplicateApiException('Встреча с таким названием уже существует', 400);
        }

        $meeting = Meeting::query()->where('code', $request->get('code'))->first();
        if ($meeting) {
            throw new DuplicateApiException('Встреча с таким названием уже существует', 400);
        }

        $model = new Meeting();
        $model->name = $request->get('name');
        $model->code = $request->get('code');
        $model->ord = $request->get('ord');
        $model->save();

        return response()->json('inserted', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $meeting)
    {
        /** @var Meeting $model */
        $model = Meeting::query()
            ->where('code', $meeting)
            ->first();

        if (!$model) {
            throw new NotFoundApiException('Данная встреча не найдена', 404);
        }

        return response()->json($model, 200);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMeetingRequest $request, string $meeting)
    {
        /** @var Meeting $model */
        $model = Meeting::query()
            ->where('code', $meeting)
            ->first();

        if (!$model) {
            throw new NotFoundApiException('Данный специалист не найден', 404);
        }

        $model->name = $request->get('name');
        $model->code = $request->get('code');
        $model->ord = $request->get('ord');
        $model->save();

        return response()->json('modified', 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $meeting)
    {
        /** @var Meeting $model */
        $model = Meeting::query()
            ->where('code', $meeting)
            ->first();

        if (!$model) {
            throw new NotFoundApiException('Данный специалист не найден', 404);
        }

        $model->delete();

        return response()->json('deleted');
    }
}
