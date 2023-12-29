<?php

namespace App\Http\Controllers;

use App\Models\Url;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UrlController extends Controller
{
    public function urlShort(Request $request)
    {
        $rules = [
            'full_link' => 'required|url'
        ];

        $validationMessage = [
            'full_link.required' => 'URL is required.',
            'full_link.url' => 'Link must be a valid url.'
        ];

        $this->validate($request, $rules, $validationMessage);

        try{
            if (Auth::check()) {
                $user = Auth::id();
    
                $letter = array_merge(range('a', 'z'), range('A', 'Z'));
                $randNumber = rand(0, 9);
    
                $hash = $letter[rand(0, 51)] . $randNumber . Str::random(5);
    
                $url = Url::create([
                    'user_id' => $user,
                    'full_link' => $request->full_link,
                    'hash' => $hash
                ]);
    
                return redirect()->back()->with([
                    'message' => 'Url generated successfully.',
                    'url' => $url,
                ]);
            } else {
                return redirect()->back()->with('warning', 'You must login to continue.');
            }
        }catch(\Exception $e){
            return redirect()->back()->with('Warning', $e);
        }
    }

    public function redirectUrl($redirectUrl)
    {
        try{
            if ($redirectUrl) {
                $url = Url::where('hash', $redirectUrl)->first();
    
                if ($url) {
                    $url->increment('url_access_count');
                    return redirect()->to($url->full_link);
                } else {
                    return redirect()->back()->with('message', 'Something went wrong! Try again please...');
                }
            }
        }catch(\Exception $e){
            return redirect()->back()->with('message', $e);
        }
    }

    public function removeUrl(Request $request){
        try{
            $url= URL::find($request->url_id);

            if($url){
                $url->delete();
            }

            return redirect()->back()->with('message', 'URL removed successfully.');
        }catch(\Exception $e){
            return redirect()->back()->with('errorMessage', $e);
        }
    }

    public function urlShortApi(Request $request)
    {
        $rules = [
            'full_link' => 'required|url'
        ];

        $validationMessage = [
            'full_link.required' => 'URL is required.',
            'full_link.url' => 'Link must be a valid url.'
        ];

        $this->validate($request, $rules, $validationMessage);

        try{
            if (Auth::check()) {
                $user = Auth::id();
    
                $letter = array_merge(range('a', 'z'), range('A', 'Z'));
                $randNumber = rand(0, 9);
    
                $hash = $letter[rand(0, 51)] . $randNumber . Str::random(5);
    
                $url = Url::create([
                    'user_id' => $user,
                    'full_link' => $request->full_link,
                    'hash' => $hash
                ]);
    
                return response()->json([
                    'message' => 'Url generated successfully.',
                    'url' => $url,
                ]);
            } else {
                return redirect()->back()->with('warning', 'You must login to continue.');
            }
        }catch(\Exception $e){
            return redirect()->back()->with('warning', $e);
        }
    }
}
