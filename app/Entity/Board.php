<?PHP
namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

class Board extends Model {
    //資料表名稱
    protected $table = 'board';

    //主鍵名稱
    protected $promaryKey = 'id';

    //可以大量指定異動的欄位(Mass Assignment)
    protected $fillable = [
        'user_id',
        'board_id',
        'email',
        'picture',
        'content',
        'enabled',
    ];

    public function User()
    {
        return $this->hasOne('App\Entity\User', 'id', 'user_id');
    }
}
?>