<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateForeignKeys extends Migration {

//   eloquent relational model
	public function up()
	{
		Schema::table('events', function(Blueprint $table) {
			$table->foreign('userid')->references('id')->on('users')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('registrations', function(Blueprint $table) {
			$table->foreign('userid')->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
		});
		Schema::table('registrations', function(Blueprint $table) {
			$table->foreign('eventid')->references('id')->on('events')
                ->onDelete('cascade')
                ->onUpdate('cascade');
		});
		Schema::table('comments', function(Blueprint $table) {
			$table->foreign('userid')->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
		});
		Schema::table('comments', function(Blueprint $table) {
			$table->foreign('eventid')->references('id')->on('events')
                ->onDelete('cascade')
                ->onUpdate('cascade');
		});
	}

	public function down()
	{
		Schema::table('events', function(Blueprint $table) {
			$table->dropForeign('events_userid_foreign');
		});
		Schema::table('registrations', function(Blueprint $table) {
			$table->dropForeign('registrations_userid_foreign');
		});
		Schema::table('registrations', function(Blueprint $table) {
			$table->dropForeign('registrations_eventid_foreign');
		});
		Schema::table('comments', function(Blueprint $table) {
			$table->dropForeign('comments_userid_foreign');
		});
		Schema::table('comments', function(Blueprint $table) {
			$table->dropForeign('comments_eventid_foreign');
		});
	}
}