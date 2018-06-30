<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSomelineReviewsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('someline_reviews', function (Blueprint $table) {
            $table->increments('someline_review_id');
            $table->unsignedInteger('user_id')->index();

            // Adding more table related fields here...
            $table->string('type')->nullable();
            $table->morphs('reviewable');
            $table->boolean('is_approved')->nullable();
            $table->string('review_result')->nullable();
            $table->text('review_text')->nullable();
            $table->text('remarks')->nullable();
            $table->text('data')->nullable();

            $table->softDeletes();
            $table->unsignedInteger('created_by')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->ipAddress('created_ip')->nullable();
            $table->unsignedInteger('updated_by')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->ipAddress('updated_ip')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('someline_reviews');
    }

}
