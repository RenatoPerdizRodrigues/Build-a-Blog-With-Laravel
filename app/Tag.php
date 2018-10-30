<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function posts(){
        return $this->belongsToMany('App\Post');

        //Também pode ser belongsToMany(OutroModelo, nome da tabela, coluna do modelo atual, coluna do outro modeo);
        //('App\Post', 'name_of_table', 'tag_id', 'post_id');
        //Nome da tabela em ordem alfabética
    }
}
