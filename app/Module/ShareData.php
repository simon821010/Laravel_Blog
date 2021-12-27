<?PHP
namespace App\Module;

class ShareData {
    const TITLE = 'Laravel部落格網站';

    public static function GetSex($sex)
    {
        switch ($sex) 
        {
            case 0:
                $sex = "無";
                break;
            case 1:
                $sex = "男";
                break;
            case 2:
                $sex = "女";
                break;
        }
        return $sex;
    }
}
?>