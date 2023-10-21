<?php

namespace App\Http\Controllers\User;

use App\Exceptions\DuplicateApiException;
use App\Exceptions\NotFoundApiException;
use App\Extensions\GoogleAuth\WrapperGoogleAuth;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreUserRequest;
use App\Mail\StoreUserMail;
use App\Models\Spr\SprProfile;
use App\Models\User\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();

        $usersBeauty = [];
        /** @var User $user */
        foreach ($users as $user) {
            $usersBeauty[] = [
                'firstName' => $user->firstname,
                'surname' => $user->surname,
                'patronymic' => $user->patronymic,
                'birthday' => $user->firstname,
                'profile' => $user->profile->name,
                'created_at' => $user->created_at,
                'updated_at' => $user->updated_at,
            ];
        }

        return response()->json($usersBeauty);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $user = User::query()->where('email', $request->get('email'))->first();
        if ($user) {
            throw new DuplicateApiException('Пользователь с таким именем уже зарегистрирован', 400);
        }

        $google = new WrapperGoogleAuth($request->get('email'));

        $profile = SprProfile::query()
            ->where('code', $request->get('profileCode'))
            ->first();

        $model = new User();
        $model->firstname = $request->get('firstname');
        $model->surname = $request->get('surname');
        $model->patronymic = $request->get('code');
        $model->birthday = $request->get('birthday');
        $model->profile_id = $profile->id;
        $model->email = $request->get('email');
        $model->google_secret_key = $google->getSecretKey();
        $model->save();

        Mail::to($model->email)->send(new StoreUserMail($google->generateQrCode(), $google->getSecretKey()));

        return response()->json('inserted', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $user)
    {
        /** @var User $model */
        $model = User::query()
            ->where('email', $user)
            ->first();

        if (!$model) {
            throw new NotFoundApiException('Данный специалист не найден', 404);
        }

        return response()->json($model);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $user)
    {
        /** @var User $model */
        $model = User::query()
            ->where('email', $user)
            ->first();

        if (!$model) {
            throw new NotFoundApiException('Данный специалист не найден', 404);
        }

        $model->delete();

        return response()->json('deleted');
    }
}
