<?PHP
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Module\ShareData;
use App\Entity\User;
use App\Entity\Mind;
use App\Entity\Board;
use Validator;

class HomeController extends Controller
{
    public $page = "";
    //首頁
    public function indexPage()
    {
        $name = 'home';

        $userList = User::all();

        $binding = [
            'title' => ShareData::TITLE,
            'page' => $this->page,
            'name' => $name,
            'User' => $this->GetUserData(),
            'userList' => $userList,
        ];
        return view('home', $binding);
    }

    //自我介紹
    public function userPage($user_id)
    {
        $this->page = 'user';
        $name = 'user';

        $userData = User::where('id', $user_id)->first();

        if(!$userData)
            return redirect('/');

        $userData->sex = ShareData::GetSex($userData->sex);

        $binding = [
            'title' => ShareData::TITLE,
            'page' => $this->page,
            'name' => $name,
            'User' => $this->GetUserData(),
            'userData' => $userData,
        ];
        return view('blog.user', $binding);
    }

    //心情隨筆
    public function mindPage($user_id)
    {
        $this->page = 'user';
        $name = 'mind';

        $userData = User::where('id', $user_id)->first();

        if(!$userData)
            return redirect('/');

        $mindList = Mind::where('user_id', $user_id)->orderby('created_at', 'desc')->get();

        $binding = [
            'title' => ShareData::TITLE,
            'page' => $this->page,
            'name' => $name,
            'User' => $this->GetUserData(),
            'userData' => $userData,
            'mindList' => $mindList,
        ];
        return view('blog.mind', $binding);
    }

    public function boardPage($user_id)
    {
        $this->page = 'user';
        $name = 'board';

        $userData = User::where('id', $user_id)->first();

        if(!$userData)
            return redirect('/');

        $boardList = Board::where('board_id', $userData->id)->orderby('created_at', 'desc')->get();

        $binding = [
            'title' => ShareData::TITLE,
            'page' => $this->page,
            'name' => $name,
            'User' => $this->GetUserData(),
            'userData' => $userData,
            'boardList' => $boardList,
        ];
        return view('blog.board', $binding);
    }

    public function boardProcess($user_id)
    {
        $this->page = 'user';
        $name = 'board';

        $userData = User::where('id', $user_id)->first();

        if(!$userData)
            return redirect('/');

        $boardList = Board::where('board_id', $userData->id)->orderby('created_at', 'desc')->get();
        //接收輸入資料
        $input = request()->all();

        //驗證規則
        $rules = [
            //內容
            'content' => [
                'required',
                'max:400'
            ],
            //電子郵件
            'email' => [
                'required',
                'max:45'
            ],
        ];

        $User = $this->GetUserData();

        $binding = [
            'title' => ShareData::TITLE,
            'page' => $this->page,
            'name' => $name,
            'User' => $this->GetUserData(),
            'userData' => $userData,
            'boardList' => $boardList,
        ];

        //驗證資料
        $validator = Validator::make($input, $rules);

        //未登入的處理
        if(!$User)
        {
            //自定義錯誤訊息
            $validator->errors()->add('user', '請先登入才能留言');

            return view('blog.board', $binding)
                ->withErrors($validator)
                ->withInput($input);
        }

        if($validator->fails())
        {
            return view('blog.board', $binding)
                ->withErrors($validator)
                ->withInput($input);
        }

        $input['user_id'] = $User->id;
        $input['board_id'] = $user_id;
        Board::create($input);

        return redirect('/'.$user_id.'/board');
    }
}
?>