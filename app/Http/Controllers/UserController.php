    <?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\UserModel;

class UserController extends Controller
{
    public function loginUser(Request $req)(post)
    {
        $validator = Validator::make($req->all(), [
        'name' => 'required',
        'second_name' => 'required',
        'login' => 'required',
        'password' => 'required',
        'api_token' => 'nullable',
        ]); 

    if($validator->fails())
        return response()->json($validator->errors()); 

    User::create($req->all());
        return response()->json("Регистрация прошла успешна");
    } 

    public function autUser(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'login' => 'required',
            'password' => 'required',
        ]);

    $user = User::where("login",$req->login)->first(); 

    if($validator->fails())
    {
        if(!$user || $req->password != $user->password)
            return respoonse()->json("Неверный логин или пароль");
            return response()->json($validator->errors());
    } 

    $user->api_token = Str::random(50);
    $user->save();
    return response()->json($user->name.", вы вошли в систему! api_token".$user->api_token);
    } 

    public function addUser(Request $req)
    {
        User::create($req->all());
        return response()->json("Был добавлен пользователь");
    } 

    public function editUser(Request $req)
    {
        $validator = Validator::make($req->all(), [
        'id' => 'required',
        ]); 

    $user = User::where("id", $req->all())->first(); 

    if(!$user || $user->api_token == null)
        return response()->json("Пользователь не найден"); 

    $user->update($req->all());
    return response()->json("Сохраненные изменения");
    } 

    public function deleteUser(Request $req)
    {
        $validator = Validator::make($req->all(), [
        'id' => 'required',
    ]); 

    $user = User::where("id", $req->all())->first(); 

    if(!$user || $user->api_token == null)
    return response()->json("Пользователь не найден"); 

    $user->delete();
    return response()->json("Пользователь был удален"); 
    }
}
