<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Member;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    public function index()
    {
        $client = new Client();

        $apiEndpoint = 'https://gorest.co.in/public-api/users';

        try {
            $response = Http::withoutVerifying()->get($apiEndpoint);
            //$response = $client->get($apiEndpoint);

            $data = $response->getBody()->getContents();

            $parsedData = json_decode($data, true);
             //dd($parsedData);
            //return response()->json($parsedData);
            return view('welcome', ['userData'=> $parsedData]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function getUser(Request $request){
        $client = new Client();

        $apiEndpoint = "https://gorest.co.in/public-api/users/$request->id";
        try {
            $response = Http::withoutVerifying()->get($apiEndpoint);
            //$response = $client->get($apiEndpoint);

            $data = $response->getBody()->getContents();

            $parsedData = json_decode($data, true);

            $member = new Member();
            $member->member_id = $parsedData['data']['id'];
            $member->name = $parsedData['data']['name'];
            $member->email = $parsedData['data']['email'];
            $member->gender = $parsedData['data']['gender'];
            $member->status = $parsedData['data']['status'];
            $member->save();
            //return response()->json($parsedData);
            return redirect()->route('users')->with('success', 'Data has been saved successfully!');
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function hideString($str, $start, $length = 3) {
        $visiblePart = substr($str, 0, $start);
        $hiddenPart = str_repeat('*', $length);
        $restPart = substr($str, $start + $length);
    
        return $visiblePart . $hiddenPart . $restPart;
    }

    public function chat(Request $request){
        $client = new Client();

        $apiEndpoint = "https://gorest.co.in/public-api/users/$request->id";
        try {
            $response = Http::withoutVerifying()->get($apiEndpoint);
            //$response = $client->get($apiEndpoint);

            $data = $response->getBody()->getContents();

            $parsedData = json_decode($data, true);

            $name = $parsedData['data']['name'];
            $email = $parsedData['data']['email'];
            $name = $this->hideString($name, 2, 6);
            $email = $this->hideString($email, 2, 6);

            $chat = new Chat();
            $chat->member_id = $parsedData['data']['id'];
            $chat->name = $name;
            $chat->email = $email;
            $chat->gender = $parsedData['data']['gender'];
            $chat->status = $parsedData['data']['status'];
            $chat->save();
            //return response()->json($parsedData);
            return redirect()->route('users')->with('success', 'Chat request sent to user');
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
