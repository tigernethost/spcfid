<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    //

    protected $fillable = ['rfid','firstname','middlename','lastname','department_id','image'];



    public function setImageAttribute($value)
    {
    
        $attribute_name = "image";
        $disk = "public";
        $destination_path = "uploads/members/";

        // if the image was erased
        if ($value==null) {
            // delete the image from disk
            \Storage::disk($disk)->delete($this->{$attribute_name});

            // set null in the database column
            $this->attributes[$attribute_name] = null;
        }

        // if a base64 was sent, store it in the db
        if (starts_with($value, 'data:image'))
        {
            // 0. Make the image
            $image = \Image::make($value);
            // 1. Generate a filename.
            $filename = md5($value.time()).'.jpg';
            // 2. Store the image on disk.
            \Storage::disk($disk)->put($destination_path.'/'.$filename, $image->stream());
            // 3. Save the path to the database
            $this->attributes[$attribute_name] = $destination_path.'/'.$filename;
        }
    }
}
