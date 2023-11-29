<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        schema::table('employees', function (Blueprint $table){
            $table->renameColumn('Email', 'email');
            $table->renameColumn('Password', 'password');
            $table->renameColumn('Active', 'active');
        });

        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        schema::table('employees', function (Blueprint $table){
            $table->renameColumn('Email', 'email');
            $table->renameColumn('Password', 'password');
            $table->renameColumn('Active', 'active');
        });
    }
};
