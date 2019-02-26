<?php
//level 4
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

use App\Contact;
use App\User;
use Carbon\Carbon;
use Image;

class ApiController extends Controller
{
    public function contact(Request $request)
    {
        $c = Contact::create([
            'names' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
        ]);

        return view('contact-received')
                ->with('c',$c);
    }
    
    public function verify($token, Request $request){

        $user = User::where('emailtoken',$token)->first();

        if(!$user || $user->email_verified_at != null)
        {
            die("Email verification failed");
        }

        $user->email_verified_at = Carbon::now()->toDateTimeString();
        $user->save();
        die("Email verified succesfully");
    }

    public function api($endpoint, Request $request){
    	switch($endpoint){
    		
            case "register":

                $validator = Validator::make($request->all(), [
                    'name' => 'required|string|max:50',
                    'email' => 'required|string|email|max:50|unique:users',
                    'gender' => 'required|string|max:10',
                    'phone' => 'required|max:50|unique:users',
                    'password' => 'required|string|min:6'
               ]);

                if ($validator->fails()) {
                    return $validator->messages();
                }

                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'gender' => $request->gender,
                    'phone' => $request->phone,
                    'password' => Hash::make($request->password),
                    'remember_token' => str_random(10),
                ]);

                if($user)
                {
                    $user->verifyEmail();
                    return 0;
                }
                return 1;
                
                break;

            case "login":

                $request->validate([
                    'email' => 'required|string|email',
                    'password' => 'required|string',
                    'remember_me' => 'boolean'
                ]);

                $credentials = request(['email', 'password']);

                if(!Auth::attempt($credentials))
                {
                    return 1;
                }
                    

                $user = $request->user();
                if($user->status != 'active')
                    return 1;
                $tokenResult = $user->createToken('Personal Access Token');
                $token = $tokenResult->token;
                $token->expires_at = Carbon::now()->addWeeks(4);
                $token->save();

                return response()->json([
                    'access_token' => $tokenResult->accessToken,
                    'token_type' => 'Bearer',
                    'expires_at' => Carbon::parse($tokenResult->token->expires_at)->toDateTimeString()
                ]);

                break;

            case "logout":
                $request->user()->token()->revoke();
                return 0;
                break;

            case "user":
                if(isset($request->user('api')->id))
                    return response()->json($request->user('api'));
                return 1;
                break;

            case "authenticated":
                return isset($request->user('api')->id) ? 0 : 1;
                break;

            case "updateProfileImage":

                if(!isset($request->user('api')->id))
                {
                    return -1;
                }

                if($request->hasFile('image')){
                    $user = $request->user('api');
                    $image = $request->file('image');
                    $filename = time() . '.' . $image->getClientOriginalExtension();
                    Image::make($image)->resize(400, 400)->save( public_path('images/profiles/' . $filename ) );

                    if(file_exists(public_path('images/profiles/'.$user->avatar)))
                    {
                        if($user->avatar !== 'avatar.jpg')
                            unlink(public_path('images/profiles/'.$user->avatar));
                    }

                    $user->avatar = $filename;
                    $user->save();

                    return 0;
                }

                return -2;
                
                break;

            case "updateProfile":
                if(isset($request->user('api')->id))
                {
                    $user = $request->user('api');
                    $user->name = $request->name;
                    $user->phone = $request->phone;
                    $user->save();
                    return 0;

                }
                return 1;
                break;

            case "contactUs":

                $c = Contact::create([
                    'names' => $request->name,
                    'email' => $request->email,
                    'message' => $request->message
                ]);

                if($c)
                    return 0;
                return 1;
                
                break;

            default:
            	return 1;
            	break;
        }
    }


}
