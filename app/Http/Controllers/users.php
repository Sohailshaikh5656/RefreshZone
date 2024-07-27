<?php


namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\user_tab;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use App\Models\contact;
use App\Models\products;
use App\Models\Brand;
use App\Models\order;
use App\Mail\mailExample;
use Illuminate\Support\Facades\Mail;
//use App\Models\CustomUser;

class users extends Controller
{

    function home(){
        if(session('user_id')){
            $data  = products::all();
            $brands = Brand::all();
            return view('User.index',['products'=>$data, 'brands' => $brands]);
        }
        else{
            return redirect('loginUser');
        }
    }
    function create_user(Request $req){
        try{
            if($req->pass == $req->cpass){
    
                $user = new user_tab;
        
                $user->name = $req->name;
        
                $user->email = $req->email;
        
                $user->password = $req->pass;
        
                $user->address = $req->address;
        
                $user->save();
        
                session(['register' => true]);
        
                // Redirect to a different route after successful user creation
                return redirect('SignUp');
        
            }
        
            else{
        
                // Redirect back to the sign-up page if passwords don't match
                session(['password'=>true]);
                return redirect('SignUp');
        
            }

        }catch(QueryException $e){

            session(['emailerror'=>true]);
            return redirect('SignUp');
        }
    }
    
    
    function login_auth(Request $request){
        // Validate login form fields
        $credentials = $request->only('email', 'password');

        // Validate user credentials
        $user = user_tab::where('email', $credentials['email'])->first();

        if ($user && $user->password === $credentials['password']) {
            // Authentication passed
            session(['user_id' => $user->id]);
            session()->put('user_id_for_session', $user->id);
            return redirect('/');
        } else {
            // Authentication failed
            return redirect()->back()->withErrors(['error' => 'Invalid credentials']);
        }
    }



    public function logout()
    {
        Auth::logout();

    // Flush all sessions
        session()->flush();

    // Regenerate CSRF token
        csrf_token();

        return redirect('/loginUser'); // Redirect to wherever you want after logout    
    }

    function contact(Request $req){
        $contact = new contact;
        $contact->name = $req->name;
        $contact->email = $req->email;
        $contact->phone = $req->phone;
        $contact->subject = $req->subject;
        $contact->message = $req->message;
        $contact->save();
        session(['Contact_saved'=>true]);
        return redirect('contact');

    }

    public function view_more_product($id){
        $products = products::findOrFail($id);
        return view('User.view_more_product', ['products' => $products]);
    }
    
    public function order_product($id) {
        if(session()->has('user_id_for_session')) {
            $products = products::findOrFail($id);
            $order = new order;
            if($products != NULL) {
                $order->product = $products->id;
                $order->user = session('user_id_for_session');
                $order->save();
                session()->put('order_stored', true);

                return redirect('/User/view_more_product/'.$id);
            }
        } else {
            return redirect("loginUser");
        }
    }
    public function sendMail($toEmail,$message,$subject){
        Mail::to($toEmail)->send(new mailExample($message,$subject));
    }


    public function forget_password_1(Request $req){
        $email = $req->email;
        $user = user_tab::findOrFail($email);
        if($user){
            $toEmail = $user->email;
            $message = 'Your Password is <b>'.$user->password.'</b> Class ';
            $subject = 'Forget Password';

            sendMail($toEmail,$message,$subject);
        }
    }
}
