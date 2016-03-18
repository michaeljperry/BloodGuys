<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('users', function(Blueprint $table)
		{
			// Rename Name to First Name
            $table->renameColumn('name', 'first_name');
            
            // Add a last name column
            $table->string('last_name', 50)->after('name');
            
            $table->boolean('admin')->after('remember_token')->change();
            
            // Add an active column to track users that can login
            $table->boolean('active')->default(true)->after('admin');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('users', function(Blueprint $table)
		{
            // Rename first name (need to populate with last name first)
            $table->renameColumn('first_name', 'name');
            
			// Drop active and last naem columns
            $table->dropColumn('active');
            $table->dropColumn('last_name');  
            
		});
	}

}
