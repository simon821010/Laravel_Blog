<?PHP
namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

class User extends Model {
    //資料表名稱
    protected $table = 'users';

    //主鍵名稱
    protected $promaryKey = 'id';

    //可變動欄位
    protected $fillable = [
        'name',
        'account',
        'password',
        'type',
        'sex',
        'height',
        'weight',
        'interest',
        'introduce',
        'picture',
        'enabled',
    ];
}
?>