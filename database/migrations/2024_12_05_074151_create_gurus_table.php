<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('gurus', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user');
            $table->string('name');
            $table->string('email');

            $table->string('nip')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->text('alamat')->nullable();
            $table->string('gelar_akademik')->nullable();
            $table->string('jurusan_akademik')->nullable();
            $table->enum('jenis_kelamin', ['laki_laki', 'perempuan'])->nullable();
            $table->string('universitas')->nullable();
            $table->enum('agama', ['islam', 'kristen', 'buddha', 'hindu', 'konguchu', 'lainnya'])->nullable();
            $table->boolean('wali_kelas')->default(false)->nullable();

            $table->string('created_by')->default('Admin Sekolah');
            $table->timestamps();

            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gurus');
    }
};
