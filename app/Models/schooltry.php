<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class schooltry extends Model
{ public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->string('schoolName');
        });
    }

}
