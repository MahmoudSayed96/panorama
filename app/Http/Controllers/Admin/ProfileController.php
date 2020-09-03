<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Profile\ProfileRequest;
use App\Traits\ErrorHandlerTrait;
use App\Traits\UploadImageTrait;
use App\User;

class ProfileController extends Controller
{
    use ErrorHandlerTrait, UploadImageTrait;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show()
    {
        return view('admin.profiles.show');
    }

    public function update(ProfileRequest $request)
    {
        try {
            $user = User::find(currentUser()->id);
            $user->update([
                'name' => $request->name,
                'email' => $request->email
            ]);
            if ($request->has('photo')) {
                $old_photo = $user->getPhoto();
                if (isset($old_photo)) {
                    // Remove old
                    $this->removeImage($old_photo);
                }
                // Update photo
                $photo_path = $this->uploadImage('users', $request->photo);
                $user->update([
                    'photo' => $photo_path,
                ]);
            }
            return $this->redirectIfSuccess('admin.profile.show', 'تم تعديل البيانات بنجاح');
        } catch (\Exception $ex) {
            return $this->redirectIfError('admin.profile.show');
        }
    }
}
