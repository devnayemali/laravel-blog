<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\District;
use App\Models\Division;
use App\Models\Profile;
use App\Models\Thana;
use App\Models\Union;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Str;

class ProfileController extends Controller
{

    public function index(): View
    {
        $divisions = Division::pluck('name', 'id');
        $profile = Profile::where('user_id', Auth::id())->first();
        return view('backend.modules.profile.profile', compact('divisions', 'profile'));
    }

    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'division_id' => 'required',
            'district_id' => 'required',
            'thana_id' => 'required',
            'union_id' => 'required',
            'address' => 'required',
            'address' => 'required',
            'gender' => 'required'
        ]);

        $data = $request->all();
        $data['user_id'] = Auth::id();
        $profile_exit = Profile::where('user_id', Auth::id())->first();
        if ($profile_exit) {
            $profile_exit->update($data);
        } else {
            Profile::create($data);
        }
        return redirect()->back();
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());
        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }
        $request->user()->save();
        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);
        $user = $request->user();
        Auth::logout();
        $user->delete();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    final public function getDistricts(int $division_id): JsonResponse
    {
        $districts = District::select('id', 'name')->where('division_id', $division_id)->get();
        return response()->json($districts);
    }

    final public function getThanas(int $district_id): JsonResponse
    {
        $thanas = Thana::select('id', 'name')->where('district_id', $district_id)->get();
        return response()->json($thanas);
    }

    final public function getUnions(int $thana_id): JsonResponse
    {
        $unions = Union::select('id', 'name')->where('thana_id', $thana_id)->get();
        return response()->json($unions);
    }

    final public function upload_photo(Request $request)
    {
        $file = $request->input('photo');
        $name = Str::slug(Auth::user()->name . Carbon::now());
        $height = 300;
        $width = 300;
        $path = 'image/user/';
        $profile = Profile::where('user_id', Auth::id())->first();
        if ($profile?->photo){
            PhotoUploadController::imageUnlink($path, $profile->photo);
        }
        $image_name = PhotoUploadController::imageUpload($name, $width, $height, $path, $file);
        $profile_data['photo'] = $image_name;
        if ($profile) {
            $profile->update($profile_data);
            return response()->json([
                'msg' => 'Profile Photo updated successfully',
                'cls' => 'success',
                'photo' => url($path.$profile->photo)
            ]);
        } else {
            return response()->json([
                'msg' => 'Please update profile first',
                'cls' => 'warning',
            ]);
        }
    }
}
