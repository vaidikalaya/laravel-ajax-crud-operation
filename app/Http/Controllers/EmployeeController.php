<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\{Employee};

class EmployeeController extends Controller
{

    public function index(){
        $employees=Employee::all();
        return view('welcome',compact('employees'));
    }

    public function addUpdateEmployee(Request $request){
        if($request->employeeId){
            return $this->updateEmployee($request);
        }
        else{
            return $this->addEmployee($request);
        }         
    }

    public function addEmployee($request){
        
        $validator = Validator::make($request->all(), [
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255','unique:employees'],
            'phone' => ['required', 'min:10', 'max:10'],
            'password' => ['required', 'string', 'min:4'],
        ]);
  
        if ($validator->fails()) {
            return  response()->json(['errors' => $validator->errors()->all(),'status'=>400],200);
        }

        $res=Employee::create([
            'firstname'=>$request->firstname,
            'lastname'=>$request->lastname,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'password'=>Hash::make($request->password)
        ]);

        if($res){
            return response()->json(['msg'=>'employee added','data'=>$res,'status'=>200]); 
        }
    }

    public function updateEmployee($request){
        
        $validator = Validator::make($request->all(), [
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'phone' => ['required','min:10','max:10'],
        ]);
  
        if ($validator->fails()) {
            return  response()->json(['errors' => $validator->errors(),'status'=>400],200);
        }

        $res=Employee::where('id',$request->employeeId)->update([
            'firstname'=>$request->firstname,
            'lastname'=>$request->lastname,
            'email'=>$request->email,
            'phone'=>$request->phone,
        ]);

        if($request->password){
            $res=Employee::where('id',$request->employeeId)->update([
                'password'=>Hash::make($request->password)
            ]);
        }

        if($res){
            return response()->json(['msg'=>'employee updated','data'=>$res,'status'=>200]); 
        }
    }

    public function editEmployee(Request $request){
        $data=Employee::find($request->employeeId);
        return response()->json(["data"=>$data,"status"=>200],200);
    }

    public function deleteEmployee(Request $request){
        if(Employee::where('id',$request->employeeId)->delete()){
            return response()->json(["msg"=>"employee deleted","status"=>200],200);
        }
    }
}
