<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\user_tab;
use App\Models\brand;
use App\Models\products;
use App\Models\auth_admin;
use App\Models\order;
use App\Models\contact;
use Illuminate\Support\Facades\Auth;


// 
//

class admin_controller extends Controller
{

    function admin_index(){
        $totalOrders = Order::count(); // Count the total number of orders
        $totalUsers = user_tab::count();
        $totalProduct = products::count();
        $Brand = brand::count();
        return view('admin.index',['totalOrders'=>$totalOrders,'totalUsers'=>$totalUsers,'totalProduct'=>$totalProduct,'Brand'=>$Brand]);

    }
    function all_user(){
        $data  = user_tab::all();
        return view('admin.pages.alluser',['user_tab'=>$data]);
    }

    public function edit_user($id)
    {
        $member = user_tab::findOrFail($id);
        return view('admin.pages.edit_user', ['user_tab' => $member]);
    }

    public function update_user(Request $request, $id)
    {
        $member = user_tab::findOrFail($id);
        $member->name = $request->name;
        $member->email = $request->email;
        $member->address = $request->address;
        $member->save();
        session(['updated_user'=>true]);
        return redirect('alluser');
    }

    public function add_brand(Request $req){
        $brand = new Brand;
    $brand->Brand_Name = $req->name;
    $brand->contact = $req->contact;
    $brand->email = $req->email;

    // Handle file upload
    if ($req->hasFile('file')) {
        $file = $req->file('file');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $filePath = $file->storeAs('uploads', $fileName, 'public');
        $brand->logo = $filePath;
    }

    $brand->save();
    return redirect('brand');
    }

    function show_Brand(){
        $data  = brand::all();
        return view('admin.pages.show_brand',['brand'=>$data]);
    }


    public function edit_Brand($id)
    {
        $member = brand::findOrFail($id);
        return view('admin.pages.edit_brand', ['brand' => $member]);
    }

    public function update_Brand(Request $request, $id)
    {
        $member = brand::findOrFail($id);
        if($request->logo==NULL){
        $member->Brand_Name = $request->name;
        $member->contact=$request->contact;
        $member->email = $request->email;
        $member->save();
        session(['updated_company'=>true]);
        return redirect('show_Brand');
        }
        else{
            $brand->Brand_Name = $req->name;
            $brand->contact = $req->contact;
            $brand->email = $req->email;

    // Handle file upload
            if ($req->hasFile('file')) {
                $file = $req->file('file');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $filePath = $file->storeAs('uploads', $fileName, 'public');
                $brand->logo = $filePath;
                }

                $brand->save();
                session(['updated_company'=>true]);
                return redirect('show_brand');

        }
        //$member = brand::findOrFail($id);
        
    }

    public function Delete_Brand($id)
    {
        $member = brand::findOrFail($id);
        if($member){
            $member->delete();
            session(['brand_delete'=>true]);
            return redirect('show_Brand');
        }

        else{
            session(['error_in_deleted'=>true]);
            return redirect('show_Brand');
        }
        //$member = brand::findOrFail($id);
    }

        public function add_product()
    {
        $data = Brand::all();
        return view('admin.pages.add_product', ['brand' => $data]);
    }
    

    public function store_product(Request $req){
        $product = new products;
        $product->name = $req->name;
        $product->price = $req->price;
        $product->pack = $req->packs;
        $product->table_company_id = $req->Company_id;
        $product->description=$req->description;

    // Handle file upload
            if ($req->hasFile('file')) {
            $file = $req->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads/product', $fileName, 'public');
            $product->image = $filePath;
            }
            
    $product->save();
    return redirect('Add_Product');
    }

    function all_product(){
        $product = products::all();
        return view('admin.pages.all_product', ['products' => $product]);

    }


    function viewmore_product($id){
        $products = products::findOrFail($id);
        return view('admin.pages.view_more_product', ['products' => $products]);
    }

    public function edit_product($id)
    {
        $product = products::findOrFail($id);
        $brands = Brand::all(); // Fetch all brands from the database
        return view('admin.pages.edit_product', ['products' => $product, 'brands' => $brands]);
    }

    public function update_product(Request $request,$id){
        $member = products::findOrFail($id);
        if($request->logo==NULL){
        $member->name = $request->name;
        $member->description=$request->description;
        $member->price = $request->price;
        $member->pack = $request->packs;
        $member->table_company_id = $request->Company_id;
        $member->save();
        session(['updated_company'=>true]);
        return redirect('/all_product');
        }
        else{
            $member->name = $request->name;
            $member->description=$request->description;
            $member->price = $request->price;
            $member->pack = $request->packs;
            $member->table_company_id = $request->Company_id;
    // Handle file upload
            if ($req->hasFile('file')) {
                $file = $req->file('file');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $filePath = $file->storeAs('uploads', $fileName, 'public');
                $member->image = $filePath;
                }

                $member->save();
                session(['updated_company'=>true]);
                return redirect('/all_product');

        }

        
    }

    public function delete_product($id)
    {
        $member = products::findOrFail($id);
        if($member){
            $member->delete();
            session(['brand_delete'=>true]);
            return redirect('/all_product');
        }

        else{
            session(['error_in_deleted'=>true]);
            return redirect('/all_product');
        }
        //$member = brand::findOrFail($id);
    }


    public function new_admin(Request $req){
        $new = new auth;
        if($req->password==$req->cpassword){
            $new->email = $req->email;
            $new->password = $req->password;
            $new->save();
            session(['newadmin'=>true]);
            return redirect('/Admin_SignUp');    
        }
        else{
            session(['mismatch'=>true]);
            return redirect('/Admin_SignUp'); 

        }
        
    }


    function admin_auth(Request $request){
        // Validate login form fields
        $credentials = $request->only('email', 'password');

        // Validate user credentials
        $user = auth_admin::where('email', $credentials['email'])->first();

        if ($user && $user->password == $credentials['password']) {
            // Authentication passed
            session(['admin_id' => $user->id]);
            return redirect('/adminPannel');
        } else {
            // Authentication failed
            // return redirect()->back()->withErrors(['error' => 'Invalid credentials']);
            session(['error' => true]);
            return redirect('/Admin_Login');
        }
    }

    public function logout()
    {
        Auth::logout();

    // Flush all sessions
        session()->flush();

    // Regenerate CSRF token
        csrf_token();

        return redirect('/Admin_Login'); // Redirect to wherever you want after logout    
    }

    public function all_orders()
    {
        $data = order::all();
        return view('admin.pages.all_order', ['order' => $data]);
    }


    function all_inquiry(){
        if(session('admin_id')){
            $data  = contact::all();
            return view('admin.pages.all_inquiry',['contact'=>$data]);
        }

        else{
            return redirect('Admin_Login');
        }
        
    }

    function viewmore_inquiry($id){
        $contact = contact::findOrFail($id);
        return view('admin.pages.viewmore_inquiry', ['contact' => $contact]);
    }
    

    public function delete_inquiry($id)
    {
        
        //$member = brand::findOrFail($id);

        if(session('admin_id')){
            $member = contact::findOrFail($id);
            if($member){
                $member->delete();
                session(['brand_delete'=>true]);
                return redirect('/all_inquiry');
            }

            else{
                session(['error_in_deleted'=>true]);
                return redirect('/all_inquiry');
            }
        }

        else{
            return redirect('Admin_Login');
        }
    }



    public function delete_user($id)
    {
        
        //$member = brand::findOrFail($id);

        if(session('admin_id')){
            $member = user_tab::findOrFail($id);
            if($member){
                $member->delete();
                session(['brand_delete'=>true]);
                return redirect('/alluser');
            }

            else{
                session(['error_in_deleted'=>true]);
                return redirect('/alluser');
            }
        }

        else{
            return redirect('Admin_Login');
        }
    }

}
