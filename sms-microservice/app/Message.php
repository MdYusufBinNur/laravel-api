<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Message extends Model
{
    const PROVIDERS = [
        ['id' => 1, 'name' => 'onnorokomsms']
    ];

    const STATUS_SUCCESS = 'success';
    const STATUS_BOUNCED = 'bounced';
    const STATUS_FAILED = 'failed';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'numbers', 'text', 'status', 'appId', 'provider', 'date'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'date' => 'datetime',
    ];

    /**
     * get the providers id array lists
     *
     * @var array
     */
    public static function extractName($array = [])
    {
        $ids = [];
        foreach ($array as $object) {
            $ids[] = $object['name'];
        }
        return $ids;
    }
}
