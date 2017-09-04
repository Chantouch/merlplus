<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AdvertiseType extends Model
{
    protected $fillable = ['name', 'slug', 'active', 'width', 'height'];

    //-------Validation-------//

    public static function rule()
    {
        return [
            'name' => 'required|max:255'
        ];
    }

    public static function message()
    {
        return [

        ];
    }



    //------------Relationship--------------//

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function advertising()
    {
        return $this->hasMany(Advertise::class);
    }
}
