<?php
/**
 * 2016_12_22_150431_changes_for_v430.php
 * Copyright (c) 2017 thegrumpydictator@gmail.com
 *
 * This file is part of Firefly III.
 *
 * Firefly III is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Firefly III is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Firefly III. If not, see <http://www.gnu.org/licenses/>.
 */
declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

/**
 * Class ChangesForV430
 */
class ChangesForV430 extends Migration
{
    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('available_budgets');
    }

    /**
     * Run the migrations.
     *
     * @SuppressWarnings(PHPMD.ShortMethodName)
     */
    public function up()
    {
        Schema::create(
            'available_budgets',
            function (Blueprint $table) {
                $table->increments('id');
                $table->timestamps();
                $table->softDeletes();
                $table->integer('user_id', false, true);
                $table->integer('transaction_currency_id', false, true);
                $table->decimal('amount', 22, 12);
                $table->date('start_date');
                $table->date('end_date');

                $table->foreign('transaction_currency_id')->references('id')->on('transaction_currencies')->onDelete('cascade');
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            }
        );
    }
}