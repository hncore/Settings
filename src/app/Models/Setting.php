<?php

namespace Backpack\Settings\app\Models;

use Backpack\CRUD\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class Setting extends Model
{
    use CrudTrait;

    protected $table = 'settings';
    protected $fillable = ['value'];


    public function setValueAttribute($value)
    {
        $attribute_name = "value";
        $disk = "public";
        $destination_path = $this->key;
        if ($value==null) {
            Storage::disk($disk)->delete($this->image);
            $this->attributes[$attribute_name] = null;
        }
        if (starts_with($value, 'data:image'))
        {
            $image = Image::make($value);
            $filename = md5($value.time()).'.jpg';
            Storage::disk($disk)->put($destination_path.'/'.$filename, $image->stream());
            $this->attributes[$attribute_name] = $destination_path.'/'.$filename;
        }else{
            $this->attributes[$attribute_name] = $value;
        }
    }
}
