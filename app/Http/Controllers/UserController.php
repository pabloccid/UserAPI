<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
/*
	protected $user;
 
	public function __construct(User $user)
	{
	  $this->user = $user;
	}

	public function index()
	{
	  $users = $this->user->all();

	  return View::make('users.index')
	      ->with('users', $users);
	}
*/
   	public function show(User $user)
    {
    	Log::info('Showing user profile for user: '.$user->id);
    	if ($user->image) {
    		$user->image = url('/images/'.$user->image);
    	}
        return $user->only(['id', 'name', 'email', 'image']);
    }

    public function storeImage(Request $request, User $user)
    {
    	Log::info('Uploading image for user: '.$user->id);
	    if ($request->hasFile('image')) {
	    	if ($user->image AND file_exists( public_path('images/') . $user->image)) {
	    		unlink (public_path('images/') . $user->image);
	    	}
	        $file = $request->file('image');
	        $filename = $user->id.'.'.$file->getClientOriginalExtension();

	        $file->move(public_path('images'), $filename);
	        $user->update(['image' => $filename]);

	        Log::info('Image '.$filename.' uploaded');
	        return response()->json($user->only(['id', 'name', 'email', 'image']), 200);
	    } else {
            $error_message = "No image found on request";
            $code = '404';
            Log::warning($error_message);
            return response(json_encode(['error' => $error_message, 'code' => $code]), $code);   
	    }
    }

    public function update(Request $request, User $user)
    {
    	Log::info('Updating user profile for user: '.$user->id);
        $user->update($request->only(['name', 'email']));
        return response()->json($user->only(['id', 'name', 'email', 'image']), 200);
    }

    public function delete(Request $request, User $user)
    {
    	Log::info('Deleting user profile for user: '.$user->id);
        $user->delete();
        return response()->json(null, 204);
    }
}


?>
