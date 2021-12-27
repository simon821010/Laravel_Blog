<?PHP
namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

class Mind extends Model {
    //資料表名稱
    protected $table = 'mind';

    //主鍵名稱
    protected $promaryKey = 'id';

    //可變動欄位
    protected $fillable = [
        'user_id',
        'content',
        'enabled',
    ];
}
?>